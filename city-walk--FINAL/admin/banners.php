<?php
require_once '../auth.php';
require_once '../database.php';
requireAdmin();

$db = getDB();

// Handle delete
if (isset($_GET['delete'])) {
    $db->prepare("DELETE FROM banners WHERE banner_id = ?")->execute([$_GET['delete']]);
    header('Location: banners.php?success=deleted');
    exit();
}

// Get all banners
$banners = $db->query("SELECT * FROM banners ORDER BY display_order ASC, banner_id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banners - City Walk Admin</title>
    <link rel="stylesheet" href="../css/admin-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    
    <main class="admin-main">
        <div class="admin-container">
            <div class="page-header">
                <h1><i class="fas fa-image"></i> Homepage Banners</h1>
                <button class="btn-primary-small" onclick="showAddBanner()">
                    <i class="fas fa-plus"></i> Add Banner
                </button>
            </div>
            
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">
                    <?php 
                    if ($_GET['success'] == 'deleted') echo 'Banner deleted successfully!';
                    if ($_GET['success'] == 'updated') echo 'Banner updated successfully!';
                    ?>
                </div>
            <?php endif; ?>
            
            <div class="admin-card">
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th style="width: 80px;">Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Link</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th style="width: 120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($banners)): ?>
                                <tr>
                                    <td colspan="7" class="text-center">
                                        No banners found. Click "Add Banner" to create your first banner.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($banners as $banner): ?>
                                    <tr>
                                        <td>
                                            <?php if ($banner['image_url']): ?>
                                                <img src="../<?php echo htmlspecialchars($banner['image_url']); ?>" 
                                                     style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;">
                                            <?php else: ?>
                                                <div style="width: 60px; height: 40px; background: #f5f5f7; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-image" style="color: #86868b;"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td><strong><?php echo htmlspecialchars($banner['title']); ?></strong></td>
                                        <td style="max-width: 300px;">
                                            <?php echo htmlspecialchars(substr($banner['description'], 0, 60)); ?>
                                            <?php if (strlen($banner['description']) > 60) echo '...'; ?>
                                        </td>
                                        <td>
                                            <?php if ($banner['link_url']): ?>
                                                <a href="<?php echo htmlspecialchars($banner['link_url']); ?>" target="_blank" style="color: #007AFF; font-size: 13px;">
                                                    View Link <i class="fas fa-external-link-alt"></i>
                                                </a>
                                            <?php else: ?>
                                                <span style="color: #86868b;">No link</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $banner['display_order']; ?></td>
                                        <td>
                                            <span class="status-badge status-<?php echo $banner['status']; ?>">
                                                <?php echo ucfirst($banner['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="edit-banner.php?id=<?php echo $banner['banner_id']; ?>" class="btn-action" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="banners.php?delete=<?php echo $banner['banner_id']; ?>" 
                                               class="btn-action btn-danger" 
                                               title="Delete" 
                                               onclick="return confirm('Are you sure you want to delete this banner?')">
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
                    <p>Total Banners: <strong><?php echo count($banners); ?></strong></p>
                </div>
            </div>
            
            <div class="admin-card" style="margin-top: 24px; background: #f5f5f7;">
                <h3 style="margin-bottom: 16px; color: #1d1d1f;">
                    <i class="fas fa-info-circle"></i> About Homepage Banners
                </h3>
                <p style="color: #86868b; margin-bottom: 12px;">
                    Homepage banners appear in the hero slider on the main page. They are displayed in order based on the display order value.
                </p>
                <p style="color: #86868b; margin: 0;">
                    <strong>Recommended image size:</strong> 1920x600 pixels for best results across all devices.
                </p>
            </div>
        </div>
    </main>
    
    <script src="../js/admin-scripts.js"></script>
    <script>
    function showAddBanner() {
        alert('Create add-banner.php page for this functionality');
    }
    </script>
</body>
</html>
