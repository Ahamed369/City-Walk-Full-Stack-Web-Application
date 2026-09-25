<?php
/**
 * City Walk - Test Admin Login
 * Place this file in your city-walk root folder
 * Access: http://localhost/city-walk/test-admin-login.php
 */

require_once 'config.php';
require_once 'database.php';

echo "<h1>Admin Login Test</h1>";

// Test 1: Check if admin user exists
echo "<h2>Test 1: Check Admin User</h2>";
try {
    $db = getDB();
    $stmt = $db->prepare("SELECT user_id, username, email, user_type, status FROM users WHERE username = 'admin'");
    $stmt->execute();
    $admin = $stmt->fetch();
    
    if ($admin) {
        echo "<p style='color: green;'>✓ Admin user exists:</p>";
        echo "<pre>" . print_r($admin, true) . "</pre>";
    } else {
        echo "<p style='color: red;'>✗ Admin user NOT found in database!</p>";
        echo "<p>Run the complete-admin-setup.sql file to create admin user.</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>Database Error: " . $e->getMessage() . "</p>";
}

// Test 2: Verify password hash
echo "<h2>Test 2: Test Password</h2>";
$testPassword = 'admin123';
$correctHash = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

if (password_verify($testPassword, $correctHash)) {
    echo "<p style='color: green;'>✓ Password 'admin123' matches the hash correctly!</p>";
} else {
    echo "<p style='color: red;'>✗ Password verification failed!</p>";
}

// Test 3: Get actual password hash from database
echo "<h2>Test 3: Check Database Password Hash</h2>";
try {
    $stmt = $db->prepare("SELECT password_hash FROM users WHERE username = 'admin'");
    $stmt->execute();
    $result = $stmt->fetch();
    
    if ($result) {
        echo "<p>Current hash in database:</p>";
        echo "<code>" . htmlspecialchars($result['password_hash']) . "</code>";
        
        if (password_verify($testPassword, $result['password_hash'])) {
            echo "<p style='color: green;'>✓ Database password hash is correct for 'admin123'!</p>";
        } else {
            echo "<p style='color: red;'>✗ Database password hash does NOT match 'admin123'</p>";
            echo "<p>Expected hash: <code>$correctHash</code></p>";
        }
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}

// Test 4: Test full login
echo "<h2>Test 4: Simulate Login</h2>";
require_once 'auth.php';

$loginResult = loginUser('admin@citywalk.lk', 'admin123');

if ($loginResult['success']) {
    echo "<p style='color: green;'>✓ Login SUCCESSFUL!</p>";
    echo "<pre>" . print_r($loginResult, true) . "</pre>";
} else {
    echo "<p style='color: red;'>✗ Login FAILED!</p>";
    echo "<p>Message: " . $loginResult['message'] . "</p>";
}

echo "<hr>";
echo "<h2>Login Credentials:</h2>";
echo "<p><strong>Username/Email:</strong> admin@citywalk.lk (or just 'admin')</p>";
echo "<p><strong>Password:</strong> admin123</p>";
?>