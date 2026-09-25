<?php
/**
 * City Walk - Create Order API
 * Author: M.R. Ahamed
 */

header('Content-Type: application/json');
require_once '../database.php';
require_once '../auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

// Check if user is logged in
if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'Please login to place order']);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true);

$userId = $_SESSION['user_id'];
$items = $input['items'] ?? [];
$totalAmount = $input['total'] ?? 0;
$customerName = $input['customerName'] ?? $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
$customerEmail = $input['customerEmail'] ?? $_SESSION['email'];
$customerPhone = $input['customerPhone'] ?? '';
$shippingAddress = $input['shippingAddress'] ?? '';
$shippingCity = $input['shippingCity'] ?? '';
$shippingPostalCode = $input['shippingPostalCode'] ?? '';

if (empty($items) || $totalAmount <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid order data']);
    exit();
}

try {
    $db = getDB();
    $db->beginTransaction();
    
    // Generate order number
    $orderNumber = 'CW' . date('YmdHis') . rand(100, 999);
    
    // Insert order
    $stmt = $db->prepare("INSERT INTO orders (
    user_id, order_number, customer_name, customer_email, customer_phone,
    shipping_address, total_amount, payment_method, payment_status, order_status
    ) VALUES (?, ?, ?, ?, ?, ?, ?, 'Cash on Delivery', 'pending', 'pending')");

    $stmt->execute([
    $userId, $orderNumber, $customerName, $customerEmail, $customerPhone,
    $shippingAddress, $totalAmount
    ]);
    
    $orderId = $db->lastInsertId();
    
    // Insert order items
    $itemStmt = $db->prepare("INSERT INTO order_items (
    order_id, product_id, product_name, quantity, unit_price, subtotal
    ) VALUES (?, ?, ?, ?, ?, ?)");
    
    foreach ($items as $item) {
        $subtotal = $item['price'] * $item['quantity'];
        $itemStmt->execute([
            $orderId,
            $item['id'],
            $item['name'],
            $item['quantity'],
            $item['price'],
            $subtotal
        ]);
        
        // Update product stock
        $updateStock = $db->prepare("UPDATE products SET stock_quantity = stock_quantity - ? WHERE product_id = ?");
        $updateStock->execute([$item['quantity'], $item['id']]);
    }
    
    $db->commit();
    
    // Log activity
    logActivity($userId, 'place_order', "Placed order: $orderNumber");
    
    echo json_encode([
        'success' => true,
        'message' => 'Order placed successfully',
        'orderNumber' => $orderNumber,
        'orderId' => $orderId
    ]);
    
} catch (Exception $e) {
    $db->rollBack();
    echo json_encode([
        'success' => false,
        'message' => 'Failed to place order: ' . $e->getMessage()
    ]);
}
?>