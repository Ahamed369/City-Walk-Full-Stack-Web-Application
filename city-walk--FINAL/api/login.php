<?php
/**
 * City Walk - Login API
 * Author: M.R. Ahamed
 * Module: Web Application Development - IT1201
 */

header('Content-Type: application/json');
require_once '../auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    // Try form data
    $input = $_POST;
}

$username = $input['username'] ?? '';
$password = $input['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Username and password are required']);
    exit();
}

$result = loginUser($username, $password);

if ($result['success']) {
    // Log activity
    logActivity($result['user']['user_id'], 'login', 'User logged in');
    
    // Add redirect URL for admin users
    if ($result['user']['user_type'] === 'admin') {
        $result['redirect'] = 'admin/index.php';
        $result['isAdmin'] = true;
    } else {
        $result['isAdmin'] = false;
    }
}

echo json_encode($result);
?>