<?php
/**
 * City Walk - Customers Management
 * Author: M.R. Ahamed
 */

require_once '../auth.php';
require_once '../database.php';

requireAdmin();

$db = getDB();

// Get all customers
$search = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT u.*, 
          (SELECT COUNT(*) FROM orders WHERE user_id = u.user_id) as total_orders,
          (SELECT SUM(total_amount) FROM orders WHERE user_id = u.user_id AND payment_status = 'paid') as total_spent
          FROM users u
          WHERE u.user_type = 'customer'";

$params = [];

if ($search) {
    $query .= " AND (u.username LIKE ? OR u.email LIKE ? OR u.first_name LIKE ? OR u.last_name LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$query .= " ORDER BY u.created_at DESC";

$stmt = $db->prepare($query);
$stmt->execute($params);
$customers = $stmt->fetchAll();

$pageTitle = "Customers Management";
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
                <h1><i class="fas fa-users"></i> Customers Management</h1>
            </div>
            
            <!-- Search -->
            <div class="admin-card">
                <form method="GET" class="filters-form">
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" name="search" placeholder="Search customers..." value="<?php echo htmlspecialchars($search); ?>">
                        </div>
                        <button type="submit" class="btn-primary-small">
                            <i class="fas fa-search"></i> Search
                        </button>
                        <a href="customers.php" class="btn-secondary">Clear</a>
                    </div>
                </form>
            </div>
            
            <!-- Customers Table -->
            <div class="admin-card">
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Total Orders</th>
                                <th>Total Spent</th>
                                <th>Joined</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($customers)): ?>
                                <tr>
                                    <td colspan="7" class="text-center">No customers found</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($customers as $customer): ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($customer['first_name'] . ' ' . $customer['last_name']); ?></strong><br>
                                            <small>@<?php echo htmlspecialchars($customer['username']); ?></small>
                                        </td>
                                        <td><?php echo htmlspecialchars($customer['email']); ?></td>
                                        <td><?php echo htmlspecialchars($customer['phone'] ?: 'N/A'); ?></td>
                                        <td><?php echo $customer['total_orders']; ?></td>
                                        <td>LKR <?php echo number_format($customer['total_spent'] ?: 0, 2); ?></td>
                                        <td><?php echo date('M d, Y', strtotime($customer['created_at'])); ?></td>
                                        <td>
                                            <span class="status-badge status-<?php echo $customer['status']; ?>">
                                                <?php echo ucfirst($customer['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="edit-customer.php?id=<?php echo $customer['user_id']; ?>" class="btn-action" title="Edit">
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
                    <p>Total Customers: <strong><?php echo count($customers); ?></strong></p>
                </div>
            </div>
        </div>
    </main>
    
    <script src="../js/admin-scripts.js"></script>
</body>
</html>