<?php
require_once '../auth.php';
require_once '../database.php';
requireAdmin();

$db = getDB();
$customerId = $_GET['id'] ?? 0;

if (!$customerId) {
    header('Location: customers.php');
    exit();
}

$stmt = $db->prepare("SELECT * FROM users WHERE user_id = ? AND user_type = 'customer'");
$stmt->execute([$customerId]);
$customer = $stmt->fetch();

if (!$customer) {
    header('Location: customers.php?error=not_found');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $status = $_POST['status'];
    
    $db->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, phone = ?, status = ? WHERE user_id = ?")->execute([$firstName, $lastName, $email, $phone, $status, $customerId]);
    
    logActivity($_SESSION['user_id'], 'update_customer', "Updated customer: $email");
    header('Location: customers.php?success=updated');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer - City Walk Admin</title>
    <link rel="stylesheet" href="../css/admin-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    
    <main class="admin-main">
        <div class="admin-container">
            <div class="page-header">
                <h1><i class="fas fa-user-edit"></i> Edit Customer</h1>
                <a href="customers.php" class="btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
            
            <div class="admin-card">
                <form method="POST" class="admin-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" value="<?php echo htmlspecialchars($customer['username']); ?>" disabled>
                            <small style="color: #86868b; font-size: 13px;">Username cannot be changed</small>
                        </div>
                        
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name *</label>
                            <input type="text" name="first_name" value="<?php echo htmlspecialchars($customer['first_name']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Last Name *</label>
                            <input type="text" name="last_name" value="<?php echo htmlspecialchars($customer['last_name']); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" value="<?php echo htmlspecialchars($customer['phone'] ?? ''); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Status *</label>
                            <select name="status" required>
                                <option value="active" <?php echo $customer['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo $customer['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                <option value="suspended" <?php echo $customer['status'] == 'suspended' ? 'selected' : ''; ?>>Suspended</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Member Since</label>
                            <input type="text" value="<?php echo date('F d, Y', strtotime($customer['created_at'])); ?>" disabled>
                        </div>
                        
                        <div class="form-group">
                            <label>Last Login</label>
                            <input type="text" value="<?php echo $customer['last_login'] ? date('F d, Y H:i', strtotime($customer['last_login'])) : 'Never'; ?>" disabled>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-primary-small"><i class="fas fa-save"></i> Update Customer</button>
                        <a href="customers.php" class="btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="../js/admin-scripts.js"></script>
</body>
</html>
