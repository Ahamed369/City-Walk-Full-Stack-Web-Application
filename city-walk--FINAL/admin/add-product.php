<?php
/**
 * City Walk - Add Product (With Image Upload)
 * Author: M.R. Ahamed
 */

require_once '../auth.php';
require_once '../database.php';

requireAdmin();

$db = getDB();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['product_name'] ?? '';
    $categoryId = $_POST['category_id'] ?? '';
    $subCategory = $_POST['sub_category'] ?? '';
    $brandId = $_POST['brand_id'] ?? '';
    $price = $_POST['price'] ?? 0;
    $description = $_POST['description'] ?? '';
    $features = $_POST['features'] ?? '';
    $stockQuantity = $_POST['stock_quantity'] ?? 0;
    $rating = $_POST['rating'] ?? 0;
    $badge = $_POST['badge'] ?? '';
    $heelHeight = $_POST['heel_height'] ?? 'flat';
    $isFeatured = isset($_POST['is_featured']) ? 1 : 0;
    $isNew = isset($_POST['is_new']) ? 1 : 0;
    
    try {
        // Create slug
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $productName)));
        
        // Insert product
        $stmt = $db->prepare("INSERT INTO products (product_name, slug, category_id, sub_category, brand_id, price, description, features, stock_quantity, rating, badge, heel_height, is_featured, is_new, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'active')");
        
        $stmt->execute([
            $productName,
            $slug,
            $categoryId,
            $subCategory,
            $brandId,
            $price,
            $description,
            $features,
            $stockQuantity,
            $rating,
            $badge,
            $heelHeight,
            $isFeatured,
            $isNew
        ]);
        
        $productId = $db->lastInsertId();
        
        // Handle sizes
        if (isset($_POST['sizes']) && is_array($_POST['sizes'])) {
            $sizes = $_POST['sizes'];
            $sizeStocks = $_POST['size_stock'] ?? [];
            
            for ($i = 0; $i < count($sizes); $i++) {
                if (!empty($sizes[$i])) {
                    $size = trim($sizes[$i]);
                    $stock = isset($sizeStocks[$i]) ? (int)$sizeStocks[$i] : 0;
                    
                    $sizeStmt = $db->prepare("INSERT INTO product_sizes (product_id, size, stock_quantity) VALUES (?, ?, ?)");
                    $sizeStmt->execute([$productId, $size, $stock]);
                }
            }
        }
        
        // Handle colors
        if (isset($_POST['colors']) && is_array($_POST['colors'])) {
            $colors = $_POST['colors'];
            $colorCodes = $_POST['color_codes'] ?? [];
            $colorStocks = $_POST['color_stock'] ?? [];
            
            for ($i = 0; $i < count($colors); $i++) {
                if (!empty($colors[$i])) {
                    $color = trim($colors[$i]);
                    $colorCode = isset($colorCodes[$i]) ? $colorCodes[$i] : null;
                    $stock = isset($colorStocks[$i]) ? (int)$colorStocks[$i] : 0;
                    
                    $colorStmt = $db->prepare("INSERT INTO product_colors (product_id, color_name, color_code, stock_quantity) VALUES (?, ?, ?, ?)");
                    $colorStmt->execute([$productId, $color, $colorCode, $stock]);
                }
            }
        }
        
        // Handle image upload
        if (isset($_FILES['product_images']) && !empty($_FILES['product_images']['name'][0])) {
            $uploadDir = '../uploads/products/';
            
            // Create directory if it doesn't exist
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $imageCount = count($_FILES['product_images']['name']);
            
            for ($i = 0; $i < $imageCount; $i++) {
                if ($_FILES['product_images']['error'][$i] === UPLOAD_ERR_OK) {
                    $fileName = $_FILES['product_images']['name'][$i];
                    $fileTmp = $_FILES['product_images']['tmp_name'][$i];
                    $fileSize = $_FILES['product_images']['size'][$i];
                    $fileType = $_FILES['product_images']['type'][$i];
                    
                    // Validate file type
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                    if (!in_array($fileType, $allowedTypes)) {
                        continue;
                    }
                    
                    // Validate file size (5MB max)
                    if ($fileSize > 5242880) {
                        continue;
                    }
                    
                    // Generate unique filename
                    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $newFileName = 'product_' . $productId . '_' . time() . '_' . $i . '.' . $fileExt;
                    $uploadPath = $uploadDir . $newFileName;
                    
                    // Move uploaded file
                    if (move_uploaded_file($fileTmp, $uploadPath)) {
                        // Save to database
                        $imageUrl = 'uploads/products/' . $newFileName;
                        $altText = $productName . ' - Image ' . ($i + 1);
                        $isPrimary = ($i === 0) ? 1 : 0; // First image is primary
                        
                        $imgStmt = $db->prepare("INSERT INTO product_images (product_id, image_url, alt_text, is_primary, display_order) VALUES (?, ?, ?, ?, ?)");
                        $imgStmt->execute([$productId, $imageUrl, $altText, $isPrimary, $i]);
                    }
                }
            }
        }
        
        logActivity($_SESSION['user_id'], 'add_product', "Added product: $productName");
        
        header('Location: products.php?success=1');
        exit();
    } catch (Exception $e) {
        $error = "Error adding product: " . $e->getMessage();
    }
}

// Get categories and brands
$categories = $db->query("SELECT * FROM categories WHERE parent_category IS NULL ORDER BY category_name")->fetchAll();
$brands = $db->query("SELECT * FROM brands ORDER BY brand_name")->fetchAll();

$pageTitle = "Add Product";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - City Walk Admin</title>
    <link rel="stylesheet" href="../css/admin-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .image-upload-section, .sizes-colors-section {
            margin: 24px 0;
            padding: 20px;
            background: #f5f5f7;
            border-radius: 8px;
        }
        
        .size-row, .color-row {
            display: flex;
            gap: 12px;
            margin-bottom: 12px;
            align-items: center;
        }
        
        .size-row input, .color-row input {
            padding: 12px;
            border: 1px solid #d2d2d7;
            border-radius: 6px;
            font-size: 14px;
        }
        
        .image-preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 16px;
            margin-top: 16px;
        }
        
        .image-preview {
            position: relative;
            width: 100%;
            height: 150px;
            border: 2px solid #d2d2d7;
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
        }
        
        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .image-preview .remove-image {
            position: absolute;
            top: 8px;
            right: 8px;
            background: #ff3b30;
            color: white;
            border: none;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .image-preview .primary-badge {
            position: absolute;
            top: 8px;
            left: 8px;
            background: #34C759;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }
        
        .file-input-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }
        
        .file-input-wrapper input[type="file"] {
            position: absolute;
            left: -9999px;
        }
        
        .file-input-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: var(--accent-color);
            color: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .file-input-label:hover {
            background: var(--accent-hover);
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    
    <main class="admin-main">
        <div class="admin-container">
            <div class="page-header">
                <h1><i class="fas fa-plus-circle"></i> Add New Product</h1>
                <a href="products.php" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <div class="admin-card">
                <form method="POST" enctype="multipart/form-data" class="admin-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Product Name *</label>
                            <input type="text" name="product_name" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Category *</label>
                            <select name="category_id" required>
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?php echo $cat['category_id']; ?>">
                                        <?php echo htmlspecialchars($cat['category_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Sub Category</label>
                            <input type="text" name="sub_category" placeholder="e.g., formal, casual, athletic">
                        </div>
                        
                        <div class="form-group">
                            <label>Brand</label>
                            <select name="brand_id">
                                <option value="">Select Brand</option>
                                <?php foreach ($brands as $brand): ?>
                                    <option value="<?php echo $brand['brand_id']; ?>">
                                        <?php echo htmlspecialchars($brand['brand_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Price (LKR) *</label>
                            <input type="number" name="price" step="0.01" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Stock Quantity *</label>
                            <input type="number" name="stock_quantity" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" rows="4"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Features (JSON format)</label>
                        <textarea name="features" rows="3" placeholder='["Feature 1", "Feature 2", "Feature 3"]'></textarea>
                    </div>
                    
                    <!-- IMAGE UPLOAD SECTION -->
                    <div class="image-upload-section">
                        <h3><i class="fas fa-images"></i> Product Images</h3>
                        <p style="color: #86868b; font-size: 14px; margin-bottom: 16px;">
                            Upload product images (JPEG, PNG, WebP, GIF). First image will be the primary image. Max 5MB per image.
                        </p>
                        
                        <div class="file-input-wrapper">
                            <input type="file" 
                                   id="product_images" 
                                   name="product_images[]" 
                                   accept="image/jpeg,image/png,image/webp,image/gif" 
                                   multiple 
                                   onchange="previewImages(event)">
                            <label for="product_images" class="file-input-label">
                                <i class="fas fa-cloud-upload-alt"></i>
                                Choose Images
                            </label>
                        </div>
                        
                        <div id="image-preview-container" class="image-preview-container"></div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Rating (0-5)</label>
                            <input type="number" name="rating" step="0.1" min="0" max="5" value="0">
                        </div>
                        
                        <div class="form-group">
                            <label>Badge</label>
                            <input type="text" name="badge" placeholder="e.g., Best Seller, New Arrival">
                        </div>
                    </div>
                    
                    <!-- SIZES SECTION -->
                    <div class="sizes-colors-section">
                        <h3><i class="fas fa-ruler"></i> Product Sizes & Stock</h3>
                        <p style="color: #86868b; font-size: 14px; margin-bottom: 16px;">
                            Add available sizes and their stock quantities
                        </p>
                        <div id="sizes-container">
                            <div class="size-row">
                                <input type="text" name="sizes[]" placeholder="Size (e.g., 7, 8, 9)" style="flex: 1;">
                                <input type="number" name="size_stock[]" placeholder="Stock Qty" min="0" style="flex: 1;">
                                <button type="button" class="btn-remove-size" onclick="removeRow(this)" style="background: #ff3b30; color: white; border: none; padding: 10px 16px; border-radius: 6px; cursor: pointer;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" onclick="addSizeRow()" class="btn-secondary" style="margin-top: 12px;">
                            <i class="fas fa-plus"></i> Add Size
                        </button>
                    </div>
                    
                    <!-- COLORS SECTION -->
                    <div class="sizes-colors-section">
                        <h3><i class="fas fa-palette"></i> Product Colors & Stock</h3>
                        <p style="color: #86868b; font-size: 14px; margin-bottom: 16px;">
                            Add available colors and their stock quantities
                        </p>
                        <div id="colors-container">
                            <div class="color-row">
                                <input type="text" name="colors[]" placeholder="Color name (e.g., Black, White)" style="flex: 1;">
                                <input type="color" name="color_codes[]" title="Color code" style="width: 60px;">
                                <input type="number" name="color_stock[]" placeholder="Stock Qty" min="0" style="flex: 1;">
                                <button type="button" class="btn-remove-color" onclick="removeRow(this)" style="background: #ff3b30; color: white; border: none; padding: 10px 16px; border-radius: 6px; cursor: pointer;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" onclick="addColorRow()" class="btn-secondary" style="margin-top: 12px;">
                            <i class="fas fa-plus"></i> Add Color
                        </button>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Heel Height</label>
                            <select name="heel_height">
                                <option value="flat">Flat</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_featured" value="1">
                                Featured Product
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_new" value="1">
                                New Product
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-primary-small">
                            <i class="fas fa-save"></i> Add Product
                        </button>
                        <a href="products.php" class="btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
    <script>
        function addSizeRow() {
            const container = document.getElementById('sizes-container');
            const newRow = document.createElement('div');
            newRow.className = 'size-row';
            newRow.innerHTML = `
                <input type="text" name="sizes[]" placeholder="Size (e.g., 7, 8, 9)" style="flex: 1;">
                <input type="number" name="size_stock[]" placeholder="Stock Qty" min="0" style="flex: 1;">
                <button type="button" class="btn-remove-size" onclick="removeRow(this)" style="background: #ff3b30; color: white; border: none; padding: 10px 16px; border-radius: 6px; cursor: pointer;">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            container.appendChild(newRow);
        }
        
        function addColorRow() {
            const container = document.getElementById('colors-container');
            const newRow = document.createElement('div');
            newRow.className = 'color-row';
            newRow.innerHTML = `
                <input type="text" name="colors[]" placeholder="Color name (e.g., Black, White)" style="flex: 1;">
                <input type="color" name="color_codes[]" title="Color code" style="width: 60px;">
                <input type="number" name="color_stock[]" placeholder="Stock Qty" min="0" style="flex: 1;">
                <button type="button" class="btn-remove-color" onclick="removeRow(this)" style="background: #ff3b30; color: white; border: none; padding: 10px 16px; border-radius: 6px; cursor: pointer;">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            container.appendChild(newRow);
        }
        
        function removeRow(button) {
            button.parentElement.remove();
        }
        
        function previewImages(event) {
            const container = document.getElementById('image-preview-container');
            container.innerHTML = '';
            
            const files = event.target.files;
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                
                // Validate file type
                if (!file.type.match('image.*')) {
                    continue;
                }
                
                // Validate file size (5MB)
                if (file.size > 5242880) {
                    alert(file.name + ' is too large. Maximum size is 5MB.');
                    continue;
                }
                
                const reader = new FileReader();
                
                reader.onload = (function(index) {
                    return function(e) {
                        const div = document.createElement('div');
                        div.className = 'image-preview';
                        div.innerHTML = `
                            <img src="${e.target.result}" alt="Preview ${index + 1}">
                            ${index === 0 ? '<span class="primary-badge">Primary</span>' : ''}
                        `;
                        container.appendChild(div);
                    };
                })(i);
                
                reader.readAsDataURL(file);
            }
        }
    </script>
    <script src="../js/admin-scripts.js"></script>
</body>
</html>