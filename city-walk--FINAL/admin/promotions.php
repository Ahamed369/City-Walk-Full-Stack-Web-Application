<?php
require_once '../auth.php';
require_once '../database.php';
requireAdmin();

$db = getDB();

// Handle delete
if (isset($_GET['delete'])) {
    $db->prepare("DELETE FROM promotions WHERE promotion_id = ?")->execute([$_GET['delete']]);
    header('Location: promotions.php?success=deleted');
    exit();
}

// Get all promotions
$promotions = $db->query("SELECT * FROM promotions ORDER BY start_date DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promotions - City Walk Admin</title>
    <link rel="stylesheet" href="../css/admin-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    
    <main class="admin-main">
        <div class="admin-container">
            <div class="page-header">
                <h1><i class="fas fa-tag"></i> Promotions & Discounts</h1>
                <button class="btn-primary-small" onclick="showAddPromotion()">
                    <i class="fas fa-plus"></i> Add Promotion
                </button>
            </div>
            
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">
                    <?php 
                    if ($_GET['success'] == 'deleted') echo 'Promotion deleted successfully!';
                    if ($_GET['success'] == 'updated') echo 'Promotion updated successfully!';
                    ?>
                </div>
            <?php endif; ?>
            
            <div class="admin-card">
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Promotion Name</th>
                                <th>Code</th>
                                <th>Discount</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Usage</th>
                                <th>Status</th>
                                <th style="width: 120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($promotions)): ?>
                                <tr>
                                    <td colspan="8" class="text-center">
                                        No promotions found. Click "Add Promotion" to create your first promotion.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($promotions as $promo): ?>
                                    <?php
                                    $now = date('Y-m-d H:i:s');
                                    $isActive = ($promo['start_date'] <= $now && $promo['end_date'] >= $now && $promo['status'] == 'active');
                                    $isUpcoming = ($promo['start_date'] > $now);
                                    $isExpired = ($promo['end_date'] < $now);
                                    ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($promo['promotion_name']); ?></strong>
                                            <?php if ($isActive): ?>
                                                <span class="status-badge" style="background: #34C759; color: white; font-size: 11px; margin-left: 8px;">LIVE</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <code style="background: #f5f5f7; padding: 4px 8px; border-radius: 4px; font-weight: 600;">
                                                <?php echo htmlspecialchars($promo['promo_code']); ?>
                                            </code>
                                        </td>
                                        <td>
                                            <?php if ($promo['discount_type'] == 'percentage'): ?>
                                                <span style="color: #FF9500; font-weight: 600;">
                                                    <?php echo $promo['discount_value']; ?>% OFF
                                                </span>
                                            <?php else: ?>
                                                <span style="color: #FF9500; font-weight: 600;">
                                                    LKR <?php echo number_format($promo['discount_value'], 2); ?> OFF
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo date('M d, Y', strtotime($promo['start_date'])); ?></td>
                                        <td><?php echo date('M d, Y', strtotime($promo['end_date'])); ?></td>
                                        <td>
                                            <div style="font-size: 13px;">
                                                <span style="font-weight: 600;"><?php echo $promo['usage_count']; ?></span> / 
                                                <?php echo $promo['usage_limit'] ? $promo['usage_limit'] : '∞'; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if ($isExpired): ?>
                                                <span class="status-badge" style="background: #FF3B30;">Expired</span>
                                            <?php elseif ($isUpcoming): ?>
                                                <span class="status-badge" style="background: #007AFF;">Upcoming</span>
                                            <?php elseif ($isActive): ?>
                                                <span class="status-badge status-active">Active</span>
                                            <?php else: ?>
                                                <span class="status-badge status-inactive">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="edit-promotion.php?id=<?php echo $promo['promotion_id']; ?>" class="btn-action" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="promotions.php?delete=<?php echo $promo['promotion_id']; ?>" 
                                               class="btn-action btn-danger" 
                                               title="Delete" 
                                               onclick="return confirm('Are you sure you want to delete this promotion?')">
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
                    <p>Total Promotions: <strong><?php echo count($promotions); ?></strong></p>
                </div>
            </div>
            
            <div class="admin-card" style="margin-top: 24px; background: #f5f5f7;">
                <h3 style="margin-bottom: 16px; color: #1d1d1f;">
                    <i class="fas fa-info-circle"></i> About Promotions
                </h3>
                <p style="color: #86868b; margin-bottom: 12px;">
                    Create promotional campaigns with discount codes for your customers. Promotions can be percentage-based or fixed amount discounts.
                </p>
                <p style="color: #86868b; margin: 0;">
                    <strong>Discount Types:</strong> Percentage (e.g., 20% OFF) or Fixed Amount (e.g., LKR 500 OFF)
                </p>
            </div>
        </div>
    </main>
    
    <script src="../js/admin-scripts.js"></script>
    <script>
    function showAddPromotion() {
        alert('Create add-promotion.php page for this functionality');
    }
    </script>
</body>
</html>
