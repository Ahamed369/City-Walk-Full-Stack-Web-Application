<?php
require_once '../auth.php';
require_once '../database.php';
requireAdmin();

$db = getDB();
$orderId = $_GET['id'] ?? 0;

if (!$orderId) {
    header('Location: orders.php');
    exit();
}

// Get order with customer info
$stmt = $db->prepare("SELECT o.*, u.username FROM orders o LEFT JOIN users u ON o.user_id = u.user_id WHERE o.order_id = ?");
$stmt->execute([$orderId]);
$order = $stmt->fetch();

if (!$order) {
    header('Location: orders.php?error=not_found');
    exit();
}

// Get order items
$itemsStmt = $db->prepare("SELECT oi.*, pi.image_url FROM order_items oi LEFT JOIN products p ON oi.product_id = p.product_id LEFT JOIN product_images pi ON p.product_id = pi.product_id AND pi.is_primary = 1 WHERE oi.order_id = ?");
$itemsStmt->execute([$orderId]);
$items = $itemsStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - City Walk Admin</title>
    <link rel="stylesheet" href="../css/admin-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    
    <main class="admin-main">
        <div class="admin-container">
            <div class="page-header">
                <h1><i class="fas fa-receipt"></i> Order #<?php echo $order['order_number']; ?></h1>
                <a href="orders.php" class="btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
            
            <div class="form-row" style="gap: 24px;">
                <div class="admin-card" style="flex: 2;">
                    <h3 style="margin-bottom: 20px;">Order Items</h3>
                    <?php foreach ($items as $item): ?>
                    <div style="display: flex; gap: 16px; padding: 16px; border-bottom: 1px solid #f0f0f0;">
                        <div style="width: 60px; height: 60px; background: #f5f5f7; border-radius: 8px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                            <?php if (!empty($item['image_url'])): ?>
                                <img src="../<?php echo htmlspecialchars($item['image_url']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <i class="fas fa-box" style="color: #86868b;"></i>
                            <?php endif; ?>
                        </div>
                        <div style="flex: 1;">
                            <strong><?php echo htmlspecialchars($item['product_name']); ?></strong>
                            <div style="color: #86868b; font-size: 14px;">Qty: <?php echo $item['quantity']; ?> × LKR <?php echo number_format($item['unit_price'], 2); ?></div>
                        </div>
                        <div style="font-weight: 600;">LKR <?php echo number_format($item['subtotal'], 2); ?></div>
                    </div>
                    <?php endforeach; ?>
                    <div style="padding: 20px; background: #f5f5f7; margin-top: 16px; border-radius: 8px;">
                        <div style="display: flex; justify-content: space-between; font-size: 18px; font-weight: 700;">
                            <span>Total Amount:</span>
                            <span>LKR <?php echo number_format($order['total_amount'], 2); ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="admin-card" style="flex: 1;">
                    <h3 style="margin-bottom: 20px;">Order Information</h3>
                    <div style="margin-bottom: 16px;">
                        <div style="font-size: 12px; color: #86868b; margin-bottom: 4px;">Status</div>
                        <span class="status-badge status-<?php echo $order['order_status']; ?>"><?php echo ucfirst($order['order_status']); ?></span>
                    </div>
                    <div style="margin-bottom: 16px;">
                        <div style="font-size: 12px; color: #86868b; margin-bottom: 4px;">Payment</div>
                        <span class="status-badge status-<?php echo $order['payment_status']; ?>"><?php echo ucfirst($order['payment_status']); ?></span>
                    </div>
                    <div style="margin-bottom: 16px;">
                        <div style="font-size: 12px; color: #86868b; margin-bottom: 4px;">Payment Method</div>
                        <div><?php echo $order['payment_method']; ?></div>
                    </div>
                    <div style="margin-bottom: 16px;">
                        <div style="font-size: 12px; color: #86868b; margin-bottom: 4px;">Order Date</div>
                        <div><?php echo date('M d, Y H:i', strtotime($order['created_at'])); ?></div>
                    </div>
                    
                    <h3 style="margin: 24px 0 16px 0;">Customer Details</h3>
                    <div style="margin-bottom: 12px;">
                        <div style="font-size: 12px; color: #86868b;">Name</div>
                        <div><?php echo htmlspecialchars($order['customer_name']); ?></div>
                    </div>
                    <div style="margin-bottom: 12px;">
                        <div style="font-size: 12px; color: #86868b;">Email</div>
                        <div><?php echo htmlspecialchars($order['customer_email']); ?></div>
                    </div>
                    <div style="margin-bottom: 12px;">
                        <div style="font-size: 12px; color: #86868b;">Phone</div>
                        <div><?php echo htmlspecialchars($order['customer_phone'] ?: 'N/A'); ?></div>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: #86868b;">Address</div>
                        <div><?php echo htmlspecialchars($order['shipping_address'] ?: 'N/A'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../js/admin-scripts.js"></script>
</body>
</html>
