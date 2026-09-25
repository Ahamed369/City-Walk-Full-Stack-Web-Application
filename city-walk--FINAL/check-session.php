<?php
/**
 * City Walk - Check Session API
 * Author: M.R. Ahamed
 * Module: Web Application Development - IT1201
 */

header('Content-Type: application/json');
require_once '../auth.php';

if (isLoggedIn()) {
    echo json_encode([
        'success' => true,
        'user' => getCurrentUser()
    ]);
} else {
    echo json_encode([
        'success' => false,
        'user' => null
    ]);
}
?>
