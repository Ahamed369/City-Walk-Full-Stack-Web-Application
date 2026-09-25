<?php
/**
 * City Walk - Administrators Management
 */

require_once '../auth.php';
require_once '../database.php';

requireAdmin();

$db = getDB();

// Get all admin users
$stmt = $db->query("SELECT user_id, username, email, first_name, last_name, phone, status, created_at, last_login FROM users WHERE user_type = 'admin' ORDER BY created_at DESC");
$admins = $stmt->fetchAll();

$pageTitle = "Administrators";
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
                <h1><i class="fas fa-user-shield"></i> Administrators</h1>
            </div>
            
            <div class="admin-card">
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Administrator</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Created</th>
                                <th>Last Login</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($admins)): ?>
                                <tr>
                                    <td colspan="6" class="text-center">No administrators found</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($admins as $admin): ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($admin['first_name'] . ' ' . $admin['last_name']); ?></strong><br>
                                            <small>@<?php echo htmlspecialchars($admin['username']); ?></small>
                                        </td>
                                        <td><?php echo htmlspecialchars($admin['email']); ?></td>
                                        <td><?php echo htmlspecialchars($admin['phone'] ?: 'N/A'); ?></td>
                                        <td><?php echo date('M d, Y', strtotime($admin['created_at'])); ?></td>
                                        <td><?php echo $admin['last_login'] ? date('M d, Y H:i', strtotime($admin['last_login'])) : 'Never'; ?></td>
                                        <td>
                                            <span class="status-badge status-<?php echo $admin['status']; ?>">
                                                <?php echo ucfirst($admin['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="edit-admin.php?id=<?php echo $admin['user_id']; ?>" class="btn-action" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="table-footer">
                    <p>Total Administrators: <strong><?php echo count($admins); ?></strong></p>
                </div>
            </div>
        </div>
    </main>
    
    <script src="../js/admin-scripts.js"></script>
</body>
</html>