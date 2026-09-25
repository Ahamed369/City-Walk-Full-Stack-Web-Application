<?php
require_once '../auth.php';
require_once '../database.php';
requireAdmin();

$db = getDB();

// Handle delete
if (isset($_GET['delete'])) {
    $db->prepare("DELETE FROM categories WHERE category_id = ?")->execute([$_GET['delete']]);
    header('Location: categories.php?success=deleted');
    exit();
}

$categories = $db->query("SELECT c.*, COUNT(p.product_id) as product_count FROM categories c LEFT JOIN products p ON c.category_id = p.category_id GROUP BY c.category_id ORDER BY c.display_order")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - City Walk Admin</title>
    <link rel="stylesheet" href="../css/admin-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    
    <main class="admin-main">
        <div class="admin-container">
            <div class="page-header">
                <h1><i class="fas fa-tags"></i> Categories</h1>
            </div>
            
            <div class="admin-card">
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Slug</th>
                                <th>Products</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $cat): ?>
                            <tr>
                                <td><strong><?php echo htmlspecialchars($cat['category_name']); ?></strong></td>
                                <td><code style="background: #f5f5f7; padding: 4px 8px; border-radius: 4px;"><?php echo $cat['slug']; ?></code></td>
                                <td><?php echo $cat['product_count']; ?></td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>
                                    <a href="categories.php?delete=<?php echo $cat['category_id']; ?>" class="btn-action btn-danger" onclick="return confirm('Delete category?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script src="../js/admin-scripts.js"></script>
</body>
</html>
