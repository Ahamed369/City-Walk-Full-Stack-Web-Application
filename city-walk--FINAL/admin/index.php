<?php
/**
 * City Walk - Admin Dashboard
 * Author: M.H. Aazim - SA25610227
 * Module: Web Application Development - IT1201
 */

require_once '../auth.php';
require_once '../database.php';

// Require admin access
requireAdmin();

$db = getDB();

// Get dashboard statistics
$stats = [];

// Total products
$stmt = $db->query("SELECT COUNT(*) as count FROM products WHERE status = 'active'");
$stats['total_products'] = $stmt->fetch()['count'];

// Total orders
$stmt = $db->query("SELECT COUNT(*) as count FROM orders");
$stats['total_orders'] = $stmt->fetch()['count'];

// Pending orders
$stmt = $db->query("SELECT COUNT(*) as count FROM orders WHERE order_status = 'pending'");
$stats['pending_orders'] = $stmt->fetch()['count'];

// Total customers
$stmt = $db->query("SELECT COUNT(*) as count FROM users WHERE user_type = 'customer'");
$stats['total_customers'] = $stmt->fetch()['count'];

// Total revenue
$stmt = $db->query("SELECT COALESCE(SUM(total_amount), 0) as revenue FROM orders WHERE payment_status = 'paid'");
$stats['total_revenue'] = $stmt->fetch()['revenue'];

// Recent orders
$stmt = $db->prepare("SELECT o.*, u.username, u.email FROM orders o LEFT JOIN users u ON o.user_id = u.user_id ORDER BY o.created_at DESC LIMIT 10");
$stmt->execute();
$recent_orders = $stmt->fetchAll();

// Low stock products
$stmt = $db->prepare("SELECT * FROM products WHERE stock_quantity < 10 AND stock_quantity > 0 ORDER BY stock_quantity ASC LIMIT 10");
$stmt->execute();
$low_stock_products = $stmt->fetchAll();

$pageTitle = "Dashboard";
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
                <h1><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
                <p>Welcome back, <?php echo htmlspecialchars($_SESSION['first_name']); ?>!</p>
            </div>
            
            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo number_format($stats['total_products']); ?></h3>
                        <p>Total Products</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo number_format($stats['total_orders']); ?></h3>
                        <p>Total Orders</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon" >
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo number_format($stats['pending_orders']); ?></h3>
                        <p>Pending Orders</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon" >
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo number_format($stats['total_customers']); ?></h3>
                        <p>Total Customers</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon" >
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-info">
                        <h3>LKR <?php echo number_format($stats['total_revenue'], 2); ?></h3>
                        <p>Total Revenue</p>
                    </div>
                </div>
            </div>
            
            <!-- Recent Orders -->
            <div class="admin-card">
                <div class="card-header">
                    <h2><i class="fas fa-list"></i> Recent Orders</h2>
                    <a href="orders.php" class="btn-primary-small">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($recent_orders)): ?>
                                <tr>
                                    <td colspan="6" class="text-center">No orders found</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($recent_orders as $order): ?>
                                    <tr>
                                        <td><strong><?php echo htmlspecialchars($order['order_number']); ?></strong></td>
                                        <td><?php echo htmlspecialchars($order['username'] ?? 'Guest'); ?></td>
                                        <td>LKR <?php echo number_format($order['total_amount'], 2); ?></td>
                                        <td>
                                            <span class="status-badge status-<?php echo $order['order_status']; ?>">
                                                <?php echo ucfirst($order['order_status']); ?>
                                            </span>
                                        </td>
                                        <td><?php echo date('M d, Y', strtotime($order['created_at'])); ?></td>
                                        <td>
                                            <a href="order-details.php?id=<?php echo $order['order_id']; ?>" class="btn-action" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Low Stock Products -->
            <?php if (!empty($low_stock_products)): ?>
            <div class="admin-card">
                <div class="card-header">
                    <h2><i class="fas fa-exclamation-triangle"></i> Low Stock Alert</h2>
                    <a href="products.php" class="btn-primary-small">Manage Products</a>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($low_stock_products as $product): ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($product['product_name']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($product['sub_category']); ?></td>
                                    <td>
                                        <span class="stock-badge <?php echo $product['stock_quantity'] < 5 ? 'low-stock' : 'medium-stock'; ?>">
                                            <?php echo $product['stock_quantity']; ?> units
                                        </span>
                                    </td>
                                    <td>LKR <?php echo number_format($product['price'], 2); ?></td>
                                    <td>
                                        <a href="edit-product.php?id=<?php echo $product['product_id']; ?>" class="btn-action" title="Edit Product">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </main>
    
    <script src="../js/admin-scripts.js"></script>
</body>
</html>
