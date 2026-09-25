<?php
/**
 * City Walk - Logout API
 * Author: M.H. Aazim - SA25610227
 * Module: Web Application Development - IT1201
 */

header('Content-Type: application/json');
require_once '../auth.php';

if (isLoggedIn()) {
    $userId = $_SESSION['user_id'];
    logActivity($userId, 'logout', 'User logged out');
}

$result = logoutUser();
echo json_encode($result);
?>
