<?php
/**
 * City Walk - Edit Product (With Image Upload)
 */

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../auth.php';
require_once '../database.php';

requireAdmin();

$db = getDB();

// Get product ID
$productId = $_GET['id'] ?? 0;

if (!$productId) {
    header('Location: products.php');
    exit();
}

// Get product data
$stmt = $db->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->execute([$productId]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: products.php?error=not_found');
    exit();
}

// Get existing product images
$imgStmt = $db->prepare("SELECT * FROM product_images WHERE product_id = ? ORDER BY display_order");
$imgStmt->execute([$productId]);
$existingImages = $imgStmt->fetchAll();

// Get existing sizes
$sizeStmt = $db->prepare("SELECT * FROM product_sizes WHERE product_id = ? ORDER BY size");
$sizeStmt->execute([$productId]);
$existingSizes = $sizeStmt->fetchAll();

// Get existing colors
$colorStmt = $db->prepare("SELECT * FROM product_colors WHERE product_id = ? ORDER BY color_name");
$colorStmt->execute([$productId]);
$existingColors = $colorStmt->fetchAll();

// Handle image deletion
if (isset($_POST['delete_image'])) {
    $imageId = $_POST['delete_image'];
    
    // Get image info
    $delStmt = $db->prepare("SELECT image_url FROM product_images WHERE image_id = ? AND product_id = ?");
    $delStmt->execute([$imageId, $productId]);
    $imageToDelete = $delStmt->fetch();
    
    if ($imageToDelete) {
        // Delete file
        $filePath = '../' . $imageToDelete['image_url'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        
        // Delete from database
        $delStmt = $db->prepare("DELETE FROM product_images WHERE image_id = ?");
        $delStmt->execute([$imageId]);
        
        header('Location: edit-product.php?id=' . $productId . '&image_deleted=1');
        exit();
    }
}

// Handle set primary image
if (isset($_POST['set_primary'])) {
    $imageId = $_POST['set_primary'];
    
    // Remove primary from all images
    $db->prepare("UPDATE product_images SET is_primary = 0 WHERE product_id = ?")->execute([$productId]);
    
    // Set new primary
    $db->prepare("UPDATE product_images SET is_primary = 1 WHERE image_id = ?")->execute([$imageId]);
    
    header('Location: edit-product.php?id=' . $productId . '&primary_updated=1');
    exit();
}

// Handle form submission for product update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_product'])) {
    
    // Log for debugging
    error_log("=== UPDATE PRODUCT TRIGGERED ===");
    error_log("Product ID: " . $productId);
    
    try {
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
        
        error_log("Product name: " . $productName);
        
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $productName)));
        
        $stmt = $db->prepare("UPDATE products SET 
            product_name = ?, slug = ?, category_id = ?, sub_category = ?, brand_id = ?,
            price = ?, description = ?, features = ?, stock_quantity = ?, rating = ?,
            badge = ?, heel_height = ?, is_featured = ?, is_new = ?
            WHERE product_id = ?");
        
        $result = $stmt->execute([
            $productName, $slug, $categoryId, $subCategory, $brandId,
            $price, $description, $features, $stockQuantity, $rating,
            $badge, $heelHeight, $isFeatured, $isNew, $productId
        ]);
        
        error_log("Product update result: " . ($result ? "SUCCESS" : "FAILED"));
        
        // Handle sizes - Delete all and re-insert
        $db->prepare("DELETE FROM product_sizes WHERE product_id = ?")->execute([$productId]);
        
        if (isset($_POST['sizes']) && is_array($_POST['sizes'])) {
            $sizes = $_POST['sizes'];
            $sizeStocks = $_POST['size_stock'] ?? [];
            
            error_log("Sizes count: " . count($sizes));
            
            for ($i = 0; $i < count($sizes); $i++) {
                if (!empty($sizes[$i])) {
                    $size = trim($sizes[$i]);
                    $stock = isset($sizeStocks[$i]) ? (int)$sizeStocks[$i] : 0;
                    
                    $sizeStmt = $db->prepare("INSERT INTO product_sizes (product_id, size, stock_quantity) VALUES (?, ?, ?)");
                    $sizeStmt->execute([$productId, $size, $stock]);
                }
            }
        }
        
        // Handle colors - Delete all and re-insert
        $db->prepare("DELETE FROM product_colors WHERE product_id = ?")->execute([$productId]);
        
        if (isset($_POST['colors']) && is_array($_POST['colors'])) {
            $colors = $_POST['colors'];
            $colorCodes = $_POST['color_codes'] ?? [];
            $colorStocks = $_POST['color_stock'] ?? [];
            
            error_log("Colors count: " . count($colors));
            
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
        
        // Handle new image uploads
        if (isset($_FILES['product_images']) && !empty($_FILES['product_images']['name'][0])) {
            $uploadDir = '../uploads/products/';
            
            error_log("Processing image uploads");
            
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            // Get current max display order
            $maxOrderStmt = $db->prepare("SELECT COALESCE(MAX(display_order), -1) as max_order FROM product_images WHERE product_id = ?");
            $maxOrderStmt->execute([$productId]);
            $maxOrder = $maxOrderStmt->fetch()['max_order'];
            
            $imageCount = count($_FILES['product_images']['name']);
            
            // Check if this is the first image (should be primary)
            $hasExistingImages = !empty($existingImages);
            
            for ($i = 0; $i < $imageCount; $i++) {
                if ($_FILES['product_images']['error'][$i] === UPLOAD_ERR_OK) {
                    $fileName = $_FILES['product_images']['name'][$i];
                    $fileTmp = $_FILES['product_images']['tmp_name'][$i];
                    $fileSize = $_FILES['product_images']['size'][$i];
                    $fileType = $_FILES['product_images']['type'][$i];
                    
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
                    if (!in_array($fileType, $allowedTypes)) {
                        continue;
                    }
                    
                    if ($fileSize > 5242880) {
                        continue;
                    }
                    
                    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $newFileName = 'product_' . $productId . '_' . time() . '_' . $i . '.' . $fileExt;
                    $uploadPath = $uploadDir . $newFileName;
                    
                    if (move_uploaded_file($fileTmp, $uploadPath)) {
                        $imageUrl = 'uploads/products/' . $newFileName;
                        $altText = $productName . ' - Image ' . ($maxOrder + $i + 2);
                        $isPrimary = (!$hasExistingImages && $i === 0) ? 1 : 0;
                        
                        $imgStmt = $db->prepare("INSERT INTO product_images (product_id, image_url, alt_text, is_primary, display_order) VALUES (?, ?, ?, ?, ?)");
                        $imgStmt->execute([$productId, $imageUrl, $altText, $isPrimary, $maxOrder + $i + 1]);
                        
                        error_log("Image uploaded: " . $newFileName);
                    }
                }
            }
        }
        
        logActivity($_SESSION['user_id'], 'update_product', "Updated product: $productName");
        
        error_log("=== UPDATE COMPLETED SUCCESSFULLY ===");
        
        header('Location: products.php?success=updated');
        exit();
        
    } catch (Exception $e) {
        $error = "Error updating product: " . $e->getMessage();
        error_log("=== UPDATE FAILED ===");
        error_log("Error: " . $e->getMessage());
        error_log("Stack trace: " . $e->getTraceAsString());
    }
}

// Refresh existing images after any changes
$imgStmt = $db->prepare("SELECT * FROM product_images WHERE product_id = ? ORDER BY display_order");
$imgStmt->execute([$productId]);
$existingImages = $imgStmt->fetchAll();

// Refresh existing sizes
$sizeStmt = $db->prepare("SELECT * FROM product_sizes WHERE product_id = ? ORDER BY size");
$sizeStmt->execute([$productId]);
$existingSizes = $sizeStmt->fetchAll();

// Refresh existing colors
$colorStmt = $db->prepare("SELECT * FROM product_colors WHERE product_id = ? ORDER BY color_name");
$colorStmt->execute([$productId]);
$existingColors = $colorStmt->fetchAll();

// Get categories and brands
$categories = $db->query("SELECT * FROM categories WHERE parent_category IS NULL ORDER BY category_name")->fetchAll();
$brands = $db->query("SELECT * FROM brands ORDER BY brand_name")->fetchAll();

$pageTitle = "Edit Product";
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
        
        .existing-images {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }
        
        .image-preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 16px;
            margin-top: 16px;
        }
        
        .image-preview, .existing-image {
            position: relative;
            width: 100%;
            height: 150px;
            border: 2px solid #d2d2d7;
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
        }
        
        .image-preview img, .existing-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .existing-image .image-actions {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            padding: 8px;
            display: flex;
            gap: 4px;
            justify-content: center;
        }
        
        .existing-image .image-actions button {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            color: white;
            transition: all 0.3s ease;
        }
        
        .btn-delete-img {
            background: #ff3b30;
        }
        
        .btn-delete-img:hover {
            background: #d32f2f;
        }
        
        .btn-primary-img {
            background: #34C759;
        }
        
        .btn-primary-img:hover {
            background: #28a745;
        }
        
        .btn-primary-img:disabled {
            background: #86868b;
            cursor: not-allowed;
        }
        
        .primary-badge {
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
        
        .no-images {
            text-align: center;
            padding: 20px;
            color: #86868b;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    
    <main class="admin-main">
        <div class="admin-container">
            <div class="page-header">
                <h1><i class="fas fa-edit"></i> Edit Product</h1>
                <a href="products.php" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <?php if (isset($_GET['image_deleted'])): ?>
                <div class="alert alert-success">Image deleted successfully!</div>
            <?php endif; ?>
            
            <?php if (isset($_GET['primary_updated'])): ?>
                <div class="alert alert-success">Primary image updated successfully!</div>
            <?php endif; ?>
            
            <div class="admin-card">
                <form method="POST" id="edit-product-form" action="edit-product.php?id=<?php echo $productId; ?>" enctype="multipart/form-data">
    <input type="hidden" name="update_product" value="1">
    
    <div class="form-row">
        <div class="form-group">
            <label>Product Name *</label>
            <input type="text" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Category *</label>
            <select name="category_id" required>
                <option value="">Select Category</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat['category_id']; ?>" <?php echo $product['category_id'] == $cat['category_id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($cat['category_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label>Sub Category</label>
            <input type="text" name="sub_category" value="<?php echo htmlspecialchars($product['sub_category'] ?? ''); ?>">
        </div>
        
        <div class="form-group">
            <label>Brand</label>
            <select name="brand_id">
                <option value="">Select Brand</option>
                <?php foreach ($brands as $brand): ?>
                    <option value="<?php echo $brand['brand_id']; ?>" <?php echo $product['brand_id'] == $brand['brand_id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($brand['brand_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label>Price (LKR) *</label>
            <input type="number" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>
        </div>
        
        <div class="form-group">
            <label>Stock Quantity *</label>
            <input type="number" name="stock_quantity" value="<?php echo $product['stock_quantity']; ?>" required>
        </div>
    </div>
    
    <div class="form-group">
        <label>Description</label>
        <textarea name="description" rows="4"><?php echo htmlspecialchars($product['description'] ?? ''); ?></textarea>
    </div>
    
    <div class="form-group">
        <label>Features (JSON format)</label>
        <textarea name="features" rows="3"><?php echo htmlspecialchars($product['features'] ?? ''); ?></textarea>
    </div>
    
    <!-- EXISTING IMAGES SECTION -->
    <div class="image-upload-section">
        <h3><i class="fas fa-images"></i> Product Images</h3>
        
        <?php if (!empty($existingImages)): ?>
            <h4 style="margin-top: 16px; color: #1d1d1f;">Existing Images</h4>
            <div class="existing-images">
                <?php foreach ($existingImages as $img): ?>
                    <div class="existing-image">
                        <img src="../<?php echo htmlspecialchars($img['image_url']); ?>" 
                            alt="<?php echo htmlspecialchars($img['alt_text']); ?>">
                        <?php if ($img['is_primary']): ?>
                            <span class="primary-badge">Primary</span>
                        <?php endif; ?>
                        <div class="image-actions">
                            <button type="button" class="btn-delete-img" onclick="deleteImage(<?php echo $img['image_id']; ?>, <?php echo $productId; ?>)">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                            <button type="button" class="btn-primary-img" onclick="setPrimaryImage(<?php echo $img['image_id']; ?>, <?php echo $productId; ?>)" <?php echo $img['is_primary'] ? 'disabled' : ''; ?>>
                                <i class="fas fa-star"></i> <?php echo $img['is_primary'] ? 'Primary' : 'Set Primary'; ?>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-images">
                <i class="fas fa-image" style="font-size: 48px; margin-bottom: 12px; display: block;"></i>
                <p>No images uploaded yet. Add images below.</p>
            </div>
        <?php endif; ?>
        
        <h4 style="margin-top: 24px; color: #1d1d1f;">Add New Images</h4>
        <p style="color: #86868b; font-size: 14px; margin-bottom: 16px;">
            Upload additional product images (JPEG, PNG, WebP, GIF). Max 5MB per image.
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
    
    <!-- SIZES SECTION -->
    <div class="sizes-colors-section">
        <h3><i class="fas fa-ruler"></i> Product Sizes & Stock</h3>
        <p style="color: #86868b; font-size: 14px; margin-bottom: 16px;">
            Manage available sizes and their stock quantities
        </p>
        <div id="sizes-container">
            <?php if (!empty($existingSizes)): ?>
                <?php foreach ($existingSizes as $size): ?>
                    <div class="size-row">
                        <input type="text" name="sizes[]" value="<?php echo htmlspecialchars($size['size']); ?>" placeholder="Size" style="flex: 1;">
                        <input type="number" name="size_stock[]" value="<?php echo $size['stock_quantity']; ?>" placeholder="Stock Qty" min="0" style="flex: 1;">
                        <button type="button" class="btn-remove-size" onclick="removeRow(this)" style="background: #ff3b30; color: white; border: none; padding: 10px 16px; border-radius: 6px; cursor: pointer;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="size-row">
                    <input type="text" name="sizes[]" placeholder="Size (e.g., 7, 8, 9)" style="flex: 1;">
                    <input type="number" name="size_stock[]" placeholder="Stock Qty" min="0" style="flex: 1;">
                    <button type="button" class="btn-remove-size" onclick="removeRow(this)" style="background: #ff3b30; color: white; border: none; padding: 10px 16px; border-radius: 6px; cursor: pointer;">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            <?php endif; ?>
        </div>
        <button type="button" onclick="addSizeRow()" class="btn-secondary" style="margin-top: 12px;">
            <i class="fas fa-plus"></i> Add Size
        </button>
    </div>
    
    <!-- COLORS SECTION -->
    <div class="sizes-colors-section">
        <h3><i class="fas fa-palette"></i> Product Colors & Stock</h3>
        <p style="color: #86868b; font-size: 14px; margin-bottom: 16px;">
            Manage available colors and their stock quantities
        </p>
        <div id="colors-container">
            <?php if (!empty($existingColors)): ?>
                <?php foreach ($existingColors as $color): ?>
                    <div class="color-row">
                        <input type="text" name="colors[]" value="<?php echo htmlspecialchars($color['color_name']); ?>" placeholder="Color name" style="flex: 1;">
                        <input type="color" name="color_codes[]" value="<?php echo htmlspecialchars($color['color_code'] ?? '#000000'); ?>" title="Color code" style="width: 60px;">
                        <input type="number" name="color_stock[]" value="<?php echo $color['stock_quantity']; ?>" placeholder="Stock Qty" min="0" style="flex: 1;">
                        <button type="button" class="btn-remove-color" onclick="removeRow(this)" style="background: #ff3b30; color: white; border: none; padding: 10px 16px; border-radius: 6px; cursor: pointer;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="color-row">
                    <input type="text" name="colors[]" placeholder="Color name (e.g., Black, White)" style="flex: 1;">
                    <input type="color" name="color_codes[]" title="Color code" style="width: 60px;">
                    <input type="number" name="color_stock[]" placeholder="Stock Qty" min="0" style="flex: 1;">
                    <button type="button" class="btn-remove-color" onclick="removeRow(this)" style="background: #ff3b30; color: white; border: none; padding: 10px 16px; border-radius: 6px; cursor: pointer;">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            <?php endif; ?>
        </div>
        <button type="button" onclick="addColorRow()" class="btn-secondary" style="margin-top: 12px;">
            <i class="fas fa-plus"></i> Add Color
        </button>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>Rating (0-5)</label>
                    <input type="number" name="rating" step="0.1" min="0" max="5" value="<?php echo $product['rating']; ?>">
                </div>
                
                <div class="form-group">
                    <label>Badge</label>
                    <input type="text" name="badge" value="<?php echo htmlspecialchars($product['badge'] ?? ''); ?>">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>Heel Height</label>
                    <select name="heel_height">
                        <option value="flat" <?php echo $product['heel_height'] == 'flat' ? 'selected' : ''; ?>>Flat</option>
                        <option value="low" <?php echo $product['heel_height'] == 'low' ? 'selected' : ''; ?>>Low</option>
                        <option value="medium" <?php echo $product['heel_height'] == 'medium' ? 'selected' : ''; ?>>Medium</option>
                        <option value="high" <?php echo $product['heel_height'] == 'high' ? 'selected' : ''; ?>>High</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="is_featured" value="1" <?php echo $product['is_featured'] ? 'checked' : ''; ?>>
                        Featured Product
                    </label>
                </div>
                
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="is_new" value="1" <?php echo $product['is_new'] ? 'checked' : ''; ?>>
                        New Product
                    </label>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-primary-small" id="submit-btn">
                    <i class="fas fa-save"></i> Update Product
                </button>
                <a href="products.php" class="btn-secondary">Cancel</a>
            </div>
        </form>
        </div>
        </div>
    </main>
    <script>
    // OVERRIDE admin-scripts.js validation - DO NOT use class="admin-form"
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('edit-product-form');
        const submitBtn = document.getElementById('submit-btn');
        
        if (!form) {
            console.error('ERROR: Form with id="edit-product-form" not found!');
            return;
        }
        
        console.log('✓ Form found and script initialized');
        
        // Stop any event propagation from admin-scripts.js
        form.addEventListener('submit', function(e) {
            console.log('=== FORM SUBMIT EVENT TRIGGERED ===');
            console.log('Form action:', form.action);
            console.log('Form method:', form.method);
            
            // Prevent double submission
            if (submitBtn.disabled) {
                console.log('⚠ Submit already in progress - blocking');
                e.preventDefault();
                e.stopPropagation();
                return false;
            }
            
            // Validate required fields
            const productName = form.querySelector('[name="product_name"]').value.trim();
            const categoryId = form.querySelector('[name="category_id"]').value;
            const price = form.querySelector('[name="price"]').value;
            const stockQuantity = form.querySelector('[name="stock_quantity"]').value;
            
            console.log('Validation check:');
            console.log('  Product Name:', productName ? '✓' : '✗', productName);
            console.log('  Category ID:', categoryId ? '✓' : '✗', categoryId);
            console.log('  Price:', price ? '✓' : '✗', price);
            console.log('  Stock:', stockQuantity ? '✓' : '✗', stockQuantity);
            
            if (!productName || !categoryId || !price || !stockQuantity) {
                console.log('❌ VALIDATION FAILED - missing required fields');
                alert('Please fill in all required fields:\n- Product Name\n- Category\n- Price\n- Stock Quantity');
                e.preventDefault();
                e.stopPropagation();
                return false;
            }
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
            
            console.log('✓ VALIDATION PASSED - Form submitting to:', form.action);
            // Form will submit naturally - DO NOT prevent default here
            return true;
        }, true); // Use capture phase to run before other handlers
    });

    // Handle image deletion via AJAX (no nested forms!)
    function deleteImage(imageId, productId) {
        if (!confirm('Are you sure you want to delete this image?')) {
            return;
        }
        
        const formData = new FormData();
        formData.append('delete_image', imageId);
        
        fetch('edit-product.php?id=' + productId, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                window.location.href = 'edit-product.php?id=' + productId + '&image_deleted=1';
            } else {
                alert('Failed to delete image');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the image');
        });
    }

    // Handle set primary via AJAX (no nested forms!)
    function setPrimaryImage(imageId, productId) {
        const formData = new FormData();
        formData.append('set_primary', imageId);
        
        fetch('edit-product.php?id=' + productId, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                window.location.href = 'edit-product.php?id=' + productId + '&primary_updated=1';
            } else {
                alert('Failed to update primary image');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the primary image');
        });
    }

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
            
            if (!file.type.match('image.*')) {
                continue;
            }
            
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
                        <span class="primary-badge" style="background: #007AFF;">New</span>
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