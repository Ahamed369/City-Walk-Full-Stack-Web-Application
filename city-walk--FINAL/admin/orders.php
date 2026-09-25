<?php
/**
 * City Walk - Orders Management
 * Author: M.R. Ahamed
 */

require_once '../auth.php';
require_once '../database.php';

requireAdmin();

$db = getDB();

// Handle status update
if (isset($_POST['update_status'])) {
    $orderId = $_POST['order_id'];
    $newStatus = $_POST['order_status'];
    
    try {
        $stmt = $db->prepare("UPDATE orders SET order_status = ?, updated_at = NOW() WHERE order_id = ?");
        $stmt->execute([$newStatus, $orderId]);
        logActivity($_SESSION['user_id'], 'update_order', "Updated order #$orderId to $newStatus");
        $success = "Order status updated successfully!";
    } catch (Exception $e) {
        $error = "Error updating order: " . $e->getMessage();
    }
}

// Get orders with filters
$status = isset($_GET['status']) ? $_GET['status'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT o.*, u.username, u.email 
          FROM orders o 
          LEFT JOIN users u ON o.user_id = u.user_id 
          WHERE 1=1";

$params = [];

if ($status) {
    $query .= " AND o.order_status = ?";
    $params[] = $status;
}

if ($search) {
    $query .= " AND (o.order_number LIKE ? OR o.customer_name LIKE ? OR o.customer_email LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$query .= " ORDER BY o.created_at DESC";

$stmt = $db->prepare($query);
$stmt->execute($params);
$orders = $stmt->fetchAll();

$pageTitle = "Orders Management";
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
                <h1><i class="fas fa-shopping-cart"></i> Orders Management</h1>
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
                            <input type="text" name="search" placeholder="Search by order #, customer..." value="<?php echo htmlspecialchars($search); ?>">
                        </div>
                        <div class="form-group">
                            <select name="status">
                                <option value="">All Status</option>
                                <option value="pending" <?php echo $status == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="confirmed" <?php echo $status == 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                <option value="processing" <?php echo $status == 'processing' ? 'selected' : ''; ?>>Processing</option>
                                <option value="shipped" <?php echo $status == 'shipped' ? 'selected' : ''; ?>>Shipped</option>
                                <option value="delivered" <?php echo $status == 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                                <option value="cancelled" <?php echo $status == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-primary-small">
                            <i class="fas fa-search"></i> Search
                        </button>
                        <a href="orders.php" class="btn-secondary">Clear</a>
                    </div>
                </form>
            </div>
            
            <!-- Orders Table -->
            <div class="admin-card">
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($orders)): ?>
                                <tr>
                                    <td colspan="7" class="text-center">No orders found</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <td><strong><?php echo htmlspecialchars($order['order_number']); ?></strong></td>
                                        <td>
                                            <?php echo htmlspecialchars($order['customer_name']); ?><br>
                                            <small><?php echo htmlspecialchars($order['customer_email']); ?></small>
                                        </td>
                                        <td>LKR <?php echo number_format($order['total_amount'], 2); ?></td>
                                        <td>
                                            <form method="POST" style="display: inline;">
                                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                                <select name="order_status" onchange="this.form.submit()" class="status-select">
                                                    <option value="pending" <?php echo $order['order_status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                                    <option value="confirmed" <?php echo $order['order_status'] == 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                                    <option value="processing" <?php echo $order['order_status'] == 'processing' ? 'selected' : ''; ?>>Processing</option>
                                                    <option value="shipped" <?php echo $order['order_status'] == 'shipped' ? 'selected' : ''; ?>>Shipped</option>
                                                    <option value="delivered" <?php echo $order['order_status'] == 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                                                    <option value="cancelled" <?php echo $order['order_status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                                </select>
                                                <input type="hidden" name="update_status" value="1">
                                            </form>
                                        </td>
                                        <td>
                                            <span class="status-badge status-<?php echo $order['payment_status']; ?>">
                                                <?php echo ucfirst($order['payment_status']); ?>
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
                
                <div class="table-footer">
                    <p>Total Orders: <strong><?php echo count($orders); ?></strong></p>
                </div>
            </div>
        </div>
    </main>
    
    <style>
    .status-select {
        padding: 6px 12px;
        border: 1px solid #d2d2d7;
        border-radius: 6px;
        font-size: 13px;
        cursor: pointer;
    }
    .alert {
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    </style>
    
    <script src="../js/admin-scripts.js"></script>
</body>
</html>