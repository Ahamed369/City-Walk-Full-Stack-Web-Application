<?php
/**
 * City Walk - FAQs Management
 */

require_once '../auth.php';
require_once '../database.php';

requireAdmin();

$db = getDB();

// Get all FAQs
$stmt = $db->query("SELECT * FROM faqs ORDER BY display_order ASC, faq_id DESC");
$faqs = $stmt->fetchAll();

$pageTitle = "FAQs Management";
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
                <h1><i class="fas fa-question-circle"></i> FAQs Management</h1>
                <button class="btn-primary-small" onclick="showAddFAQ()">
                    <i class="fas fa-plus"></i> Add FAQ
                </button>
            </div>
            
            <div class="admin-card">
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">Order</th>
                                <th>Question</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th style="width: 120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($faqs)): ?>
                                <tr>
                                    <td colspan="5" class="text-center">
                                        No FAQs found. Click "Add FAQ" to create your first FAQ.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($faqs as $faq): ?>
                                    <tr>
                                        <td><?php echo $faq['display_order']; ?></td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($faq['question']); ?></strong><br>
                                            <small style="color: #86868b;">
                                                <?php echo substr(htmlspecialchars($faq['answer']), 0, 100); ?>...
                                            </small>
                                        </td>
                                        <td><?php echo htmlspecialchars($faq['category'] ?: 'General'); ?></td>
                                        <td>
                                            <span class="status-badge status-<?php echo $faq['status'] ?? 'active'; ?>">
                                                <?php echo ucfirst($faq['status'] ?? 'active'); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn-action" title="Edit" onclick="editFAQ(<?php echo $faq['faq_id']; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn-action btn-danger" title="Delete" onclick="deleteFAQ(<?php echo $faq['faq_id']; ?>)">
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
                    <p>Total FAQs: <strong><?php echo count($faqs); ?></strong></p>
                </div>
            </div>
            
            <div class="admin-card" style="margin-top: 24px; background: #f5f5f7;">
                <h3 style="margin-bottom: 16px; color: #1d1d1f;">
                    <i class="fas fa-info-circle"></i> About FAQs
                </h3>
                <p style="color: #86868b; margin-bottom: 12px;">
                    Frequently Asked Questions help customers find answers quickly. Organize them by category and display order for better user experience.
                </p>
                <p style="color: #86868b; margin: 0;">
                    <strong>Note:</strong> This is a basic FAQ management interface. Full CRUD operations can be added by creating add-faq.php and edit-faq.php pages.
                </p>
            </div>
        </div>
    </main>
    
    <script src="../js/admin-scripts.js"></script>
    <script>
    function showAddFAQ() {
        alert('Create add-faq.php page for this functionality');
    }
    
    function editFAQ(id) {
        window.location.href = 'edit-faq.php?id=' + id;
    }
    
    function deleteFAQ(id) {
        if (confirm('Are you sure you want to delete this FAQ?')) {
            alert('Create delete FAQ API endpoint for this functionality');
        }
    }
    </script>
</body>
</html>