<?php
/**
 * City Walk - Change Password
 */

require_once '../auth.php';
require_once '../database.php';

requireAdmin();

$db = getDB();
$userId = $_SESSION['user_id'];

// Handle password change
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
        $error = "All fields are required";
    } elseif (strlen($newPassword) < 6) {
        $error = "New password must be at least 6 characters";
    } elseif ($newPassword !== $confirmPassword) {
        $error = "New passwords do not match";
    } else {
        // Verify current password
        $stmt = $db->prepare("SELECT password_hash FROM users WHERE user_id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch();
        
        if (!password_verify($currentPassword, $user['password_hash'])) {
            $error = "Current password is incorrect";
        } else {
            // Update password
            $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateStmt = $db->prepare("UPDATE users SET password_hash = ? WHERE user_id = ?");
            $updateStmt->execute([$newHash, $userId]);
            
            logActivity($userId, 'change_password', 'Changed password');
            $success = "Password changed successfully!";
        }
    }
}

$pageTitle = "Change Password";
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
                <h1><i class="fas fa-key"></i> Change Password</h1>
                <a href="profile.php" class="btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Profile
                </a>
            </div>
            
            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <div class="admin-card" style="max-width: 600px;">
                <form method="POST" class="admin-form">
                    <div class="form-group">
                        <label>Current Password *</label>
                        <input type="password" name="current_password" required autofocus>
                    </div>
                    
                    <div class="form-group">
                        <label>New Password *</label>
                        <input type="password" name="new_password" required minlength="6">
                        <small style="color: #86868b; font-size: 13px;">Minimum 6 characters</small>
                    </div>
                    
                    <div class="form-group">
                        <label>Confirm New Password *</label>
                        <input type="password" name="confirm_password" required minlength="6">
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-primary-small">
                            <i class="fas fa-save"></i> Change Password
                        </button>
                        <a href="profile.php" class="btn-secondary">Cancel</a>
                    </div>
                </form>
                
                <div style="margin-top: 24px; padding: 16px; background: #f5f5f7; border-radius: 8px;">
                    <h4 style="margin-bottom: 8px; color: #1d1d1f;">Password Requirements:</h4>
                    <ul style="margin: 0; padding-left: 20px; color: #86868b; font-size: 14px;">
                        <li>At least 6 characters long</li>
                        <li>Use a strong, unique password</li>
                        <li>Don't reuse old passwords</li>
                        <li>Consider using a mix of letters, numbers, and symbols</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    
    <script src="../js/admin-scripts.js"></script>
</body>
</html>