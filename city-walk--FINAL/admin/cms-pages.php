<?php
/**
 * City Walk - CMS Pages Management
 */

require_once '../auth.php';
require_once '../database.php';

requireAdmin();

$db = getDB();

// Get all CMS pages
$stmt = $db->query("SELECT * FROM cms_pages ORDER BY page_title ASC");
$pages = $stmt->fetchAll();

$pageTitle = "CMS Pages";
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
                <h1><i class="fas fa-file-alt"></i> CMS Pages</h1>
                <button class="btn-primary-small" onclick="showAddPage()">
                    <i class="fas fa-plus"></i> Add Page
                </button>
            </div>
            
            <div class="admin-card">
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Page Title</th>
                                <th>Slug</th>
                                <th>Meta Title</th>
                                <th>Last Updated</th>
                                <th>Status</th>
                                <th style="width: 120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($pages)): ?>
                                <tr>
                                    <td colspan="6" class="text-center">
                                        No CMS pages found. Click "Add Page" to create your first page.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($pages as $page): ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($page['page_title']); ?></strong>
                                        </td>
                                        <td>
                                            <code style="background: #f5f5f7; padding: 4px 8px; border-radius: 4px; font-size: 13px;">
                                                /<?php echo htmlspecialchars($page['slug'] ?? 'no-slug'); ?>
                                            </code>
                                        </td>
                                        <td><?php echo htmlspecialchars($page['meta_title'] ?? ''); ?></td>
                                        <td><?php echo date('M d, Y', strtotime($page['updated_at'])); ?></td>
                                        <td>
                                            <span class="status-badge status-<?php echo $page['status'] ?? 'active'; ?>">
                                                <?php echo ucfirst($page['status'] ?? 'active'); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn-action" title="Edit" onclick="editPage(<?php echo $page['page_id']; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-action btn-danger" title="Delete" onclick="deletePage(<?php echo $page['page_id']; ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="table-footer">
                    <p>Total Pages: <strong><?php echo count($pages); ?></strong></p>
                </div>
            </div>
            
            <div class="admin-card" style="margin-top: 24px; background: #f5f5f7;">
                <h3 style="margin-bottom: 16px; color: #1d1d1f;">
                    <i class="fas fa-info-circle"></i> About CMS Pages
                </h3>
                <p style="color: #86868b; margin-bottom: 12px;">
                    Content Management System pages allow you to create and manage static pages like About Us, Privacy Policy, Terms & Conditions, etc.
                </p>
                <p style="color: #86868b; margin: 0;">
                    <strong>Common pages:</strong> About Us, Contact, Shipping Policy, Return Policy, Terms of Service, Privacy Policy
                </p>
            </div>
        </div>
    </main>
    
    <script src="../js/admin-scripts.js"></script>
    <script>
    function showAddPage() {
        alert('Create add-cms-page.php for this functionality');
    }
    
    function editPage(id) {
        window.location.href = 'edit-cms-page.php?id=' + id;
    }
    
    function deletePage(id) {
        if (confirm('Are you sure you want to delete this page?')) {
            alert('Create delete CMS page API endpoint for this functionality');
        }
    }
    </script>
</body>
</html>