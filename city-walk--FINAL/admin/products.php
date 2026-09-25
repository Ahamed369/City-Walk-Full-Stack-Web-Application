<?php
/**
 * City Walk - Admin Products Management
 * Author: M.H. Aazim - SA25610227
 * Module: Web Application Development - IT1201
 */

require_once '../auth.php';
require_once '../database.php';

// Require admin access
requireAdmin();

$db = getDB();

// Handle delete product
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $productId = (int)$_GET['delete'];
    try {
        $stmt = $db->prepare("UPDATE products SET status = 'inactive' WHERE product_id = ?");
        $stmt->execute([$productId]);
        logActivity($_SESSION['user_id'], 'delete_product', "Deleted product ID: $productId");
        $success = "Product deleted successfully!";
    } catch (Exception $e) {
        $error = "Error deleting product: " . $e->getMessage();
    }
}

// Get all products
$search = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

$query = "SELECT p.*, c.category_name, b.brand_name, 
          (SELECT image_url FROM product_images WHERE product_id = p.product_id AND is_primary = 1 LIMIT 1) as image
          FROM products p
          LEFT JOIN categories c ON p.category_id = c.category_id
          LEFT JOIN brands b ON p.brand_id = b.brand_id
          WHERE p.status = 'active'";

$params = [];

if ($search) {
    $query .= " AND (p.product_name LIKE ? OR p.description LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if ($category) {
    $query .= " AND p.category_id = ?";
    $params[] = $category;
}

$query .= " ORDER BY p.product_id DESC";

$stmt = $db->prepare($query);
$stmt->execute($params);
$products = $stmt->fetchAll();

// Get categories for filter
$categoriesStmt = $db->query("SELECT * FROM categories WHERE parent_category IS NULL ORDER BY category_name");
$categories = $categoriesStmt->fetchAll();

$pageTitle = "Products Management";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - City Walk Admin</title>
    <link rel="stylesheet" href="../css/admin-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    
    <main class="admin-main">
        <div class="admin-container">
            <div class="page-header">
                <h1><i class="fas fa-box"></i> Products Management</h1>
                <a href="add-product.php" class="btn-primary-small">
                    <i class="fas fa-plus"></i> Add New Product
                </a>
            </div>
            
            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <!-- Filters -->
            <div class="admin-card">
                <form method="GET" class="filters-form">
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" name="search" placeholder="Search products..." value="<?php echo htmlspecialchars($search); ?>">
                        </div>
                        <div class="form-group">
                            <select name="category">
                                <option value="">All Categories</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?php echo $cat['category_id']; ?>" <?php echo $category == $cat['category_id'] ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($cat['category_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn-primary-small">
                            <i class="fas fa-search"></i> Search
                        </button>
                        <a href="products.php" class="btn-secondary">Clear</a>
                    </div>
                </form>
            </div>
            
            <!-- Products Table -->
            <div class="admin-card">
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($products)): ?>
                                <tr>
                                    <td colspan="8" class="text-center">No products found</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td>
                                            <?php if ($product['image']): ?>
                                                <img src="../<?php echo htmlspecialchars($product['image']); ?>" alt="Product" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                            <?php else: ?>
                                                <div style="width: 50px; height: 50px; background: #f0f0f0; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-image" style="color: #ccc;"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($product['product_name']); ?></strong>
                                        </td>
                                        <td><?php echo htmlspecialchars($product['category_name']); ?></td>
                                        <td><?php echo htmlspecialchars($product['brand_name']); ?></td>
                                        <td>LKR <?php echo number_format($product['price'], 2); ?></td>
                                        <td>
                                            <span class="stock-badge <?php echo $product['stock_quantity'] < 10 ? 'low-stock' : 'in-stock'; ?>">
                                                <?php echo $product['stock_quantity']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="status-badge status-<?php echo $product['status']; ?>">
                                                <?php echo ucfirst($product['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="edit-product.php?id=<?php echo $product['product_id']; ?>" class="btn-action" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="products.php?delete=<?php echo $product['product_id']; ?>" 
                                               class="btn-action btn-danger" 
                                               onclick="return confirm('Are you sure you want to delete this product?')" 
                                               title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="table-footer">
                    <p>Total Products: <strong><?php echo count($products); ?></strong></p>
                </div>
            </div>
        </div>
    </main>
    
    <script src="../js/admin-scripts.js"></script>
</body>
</html>