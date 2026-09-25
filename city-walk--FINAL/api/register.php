<?php
/**
 * City Walk - Registration API
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
$email = $input['email'] ?? '';
$password = $input['password'] ?? '';
$firstName = $input['firstName'] ?? '';
$lastName = $input['lastName'] ?? '';
$phone = $input['phone'] ?? null;

// Validate required fields
if (empty($username) || empty($email) || empty($password) || empty($firstName) || empty($lastName)) {
    echo json_encode(['success' => false, 'message' => 'All fields except phone are required']);
    exit();
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email format']);
    exit();
}

$result = registerUser($username, $email, $password, $firstName, $lastName, $phone);

echo json_encode($result);
?>
