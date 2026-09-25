<?php
require_once '../auth.php';
require_once '../database.php';
requireAdmin();

$db = getDB();
$adminId = $_GET['id'] ?? 0;

if (!$adminId) {
    header('Location: admins.php');
    exit();
}

$stmt = $db->prepare("SELECT * FROM users WHERE user_id = ? AND user_type = 'admin'");
$stmt->execute([$adminId]);
$admin = $stmt->fetch();

if (!$admin) {
    header('Location: admins.php?error=not_found');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $status = $_POST['status'];
    
    $db->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, phone = ?, status = ? WHERE user_id = ?")->execute([$firstName, $lastName, $email, $phone, $status, $adminId]);
    
    logActivity($_SESSION['user_id'], 'update_admin', "Updated admin: $email");
    header('Location: admins.php?success=updated');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Administrator - City Walk Admin</title>
    <link rel="stylesheet" href="../css/admin-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    
    <main class="admin-main">
        <div class="admin-container">
            <div class="page-header">
                <h1><i class="fas fa-user-shield"></i> Edit Administrator</h1>
                <a href="admins.php" class="btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
            
            <div class="admin-card">
                <form method="POST" class="admin-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" value="<?php echo htmlspecialchars($admin['username']); ?>" disabled>
                            <small style="color: #86868b; font-size: 13px;">Username cannot be changed</small>
                        </div>
                        
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" value="<?php echo htmlspecialchars($admin['email']); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name *</label>
                            <input type="text" name="first_name" value="<?php echo htmlspecialchars($admin['first_name']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Last Name *</label>
                            <input type="text" name="last_name" value="<?php echo htmlspecialchars($admin['last_name']); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" value="<?php echo htmlspecialchars($admin['phone'] ?? ''); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Status *</label>
                            <select name="status" required>
                                <option value="active" <?php echo $admin['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo $admin['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Account Type</label>
                            <input type="text" value="Administrator" disabled>
                        </div>
                        
                        <div class="form-group">
                            <label>Created</label>
                            <input type="text" value="<?php echo date('F d, Y', strtotime($admin['created_at'])); ?>" disabled>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-primary-small"><i class="fas fa-save"></i> Update Administrator</button>
                        <a href="admins.php" class="btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="../js/admin-scripts.js"></script>
</body>
</html>
