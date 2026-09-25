<?php
/**
 * City Walk - Database Configuration
 * Author: M.R. Ahamed
 * Module: Web Application Development - IT1201
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'citywalk_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Application Configuration
define('BASE_URL', 'http://localhost/city-walk/');
define('ADMIN_EMAIL', 'admin@citywalk.lk');
define('SITE_NAME', 'City Walk');

// Session Configuration
define('SESSION_LIFETIME', 3600); // 1 hour in seconds

// Security
define('PASSWORD_HASH_ALGO', PASSWORD_DEFAULT);
define('PASSWORD_MIN_LENGTH', 8);

// Pagination
define('PRODUCTS_PER_PAGE', 12);
define('ORDERS_PER_PAGE', 20);

// Upload Configuration
define('UPLOAD_DIR', __DIR__ . '/uploads/');
define('MAX_FILE_SIZE', 5242880); // 5MB in bytes
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/webp', 'image/gif']);

// Error Reporting (Change in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Timezone
date_default_timezone_set('Asia/Colombo');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
