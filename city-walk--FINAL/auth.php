<?php
/**
 * City Walk - Authentication Helper Functions
 * Author: M.R. Ahamed
 * Module: Web Application Development - IT1201
 */

require_once 'database.php';

/**
 * Register a new user
 */
function registerUser($username, $email, $password, $firstName, $lastName, $phone = null) {
    try {
        $db = getDB();
        
        // Validate password length
        if (strlen($password) < PASSWORD_MIN_LENGTH) {
            return ['success' => false, 'message' => 'Password must be at least ' . PASSWORD_MIN_LENGTH . ' characters'];
        }
        
        // Check if username or email already exists
        $stmt = $db->prepare("SELECT user_id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            return ['success' => false, 'message' => 'Username or email already exists'];
        }
        
        // Hash password
        $passwordHash = password_hash($password, PASSWORD_HASH_ALGO);
        
        // Insert user
        $stmt = $db->prepare("INSERT INTO users (username, email, password_hash, first_name, last_name, phone, user_type) VALUES (?, ?, ?, ?, ?, ?, 'customer')");
        $stmt->execute([$username, $email, $passwordHash, $firstName, $lastName, $phone]);
        
        return ['success' => true, 'message' => 'Registration successful', 'user_id' => $db->lastInsertId()];
        
    } catch (Exception $e) {
        return ['success' => false, 'message' => 'Registration failed: ' . $e->getMessage()];
    }
}

/**
 * Login user
 */
function loginUser($username, $password) {
    try {
        $db = getDB();
        
        // Get user by username or email
        $stmt = $db->prepare("SELECT * FROM users WHERE (username = ? OR email = ?) AND status = 'active'");
        $stmt->execute([$username, $username]);
        $user = $stmt->fetch();
        
        if (!$user) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }
        
        // Verify password
        if (!password_verify($password, $user['password_hash'])) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }
        
        // Update last login
        $updateStmt = $db->prepare("UPDATE users SET last_login = NOW() WHERE user_id = ?");
        $updateStmt->execute([$user['user_id']]);
        
        // Set session
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['user_type'] = $user['user_type'];
        $_SESSION['logged_in'] = true;
        
        return [
            'success' => true,
            'message' => 'Login successful',
            'user' => [
                'user_id' => $user['user_id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'user_type' => $user['user_type']
            ]
        ];
        
    } catch (Exception $e) {
        return ['success' => false, 'message' => 'Login failed: ' . $e->getMessage()];
    }
}

/**
 * Logout user
 */
function logoutUser() {
    session_unset();
    session_destroy();
    return ['success' => true, 'message' => 'Logged out successfully'];
}

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

/**
 * Check if user is admin
 */
function isAdmin() {
    return isLoggedIn() && isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin';
}

/**
 * Get current user info
 */
function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    
    return [
        'user_id' => $_SESSION['user_id'],
        'username' => $_SESSION['username'],
        'email' => $_SESSION['email'],
        'first_name' => $_SESSION['first_name'],
        'last_name' => $_SESSION['last_name'],
        'user_type' => $_SESSION['user_type']
    ];
}

/**
 * Require login (redirect if not logged in)
 */
function requireLogin($redirectUrl = 'login.php') {
    if (!isLoggedIn()) {
        header('Location: ' . $redirectUrl);
        exit();
    }
}

/**
 * Require admin (redirect if not admin)
 */
function requireAdmin($redirectUrl = 'index.php') {
    if (!isAdmin()) {
        header('Location: ' . $redirectUrl);
        exit();
    }
}

/**
 * Change password
 */
function changePassword($userId, $oldPassword, $newPassword) {
    try {
        $db = getDB();
        
        // Validate new password length
        if (strlen($newPassword) < PASSWORD_MIN_LENGTH) {
            return ['success' => false, 'message' => 'Password must be at least ' . PASSWORD_MIN_LENGTH . ' characters'];
        }
        
        // Get current password hash
        $stmt = $db->prepare("SELECT password_hash FROM users WHERE user_id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch();
        
        if (!$user) {
            return ['success' => false, 'message' => 'User not found'];
        }
        
        // Verify old password
        if (!password_verify($oldPassword, $user['password_hash'])) {
            return ['success' => false, 'message' => 'Current password is incorrect'];
        }
        
        // Hash new password
        $newPasswordHash = password_hash($newPassword, PASSWORD_HASH_ALGO);
        
        // Update password
        $updateStmt = $db->prepare("UPDATE users SET password_hash = ?, updated_at = NOW() WHERE user_id = ?");
        $updateStmt->execute([$newPasswordHash, $userId]);
        
        return ['success' => true, 'message' => 'Password changed successfully'];
        
    } catch (Exception $e) {
        return ['success' => false, 'message' => 'Failed to change password: ' . $e->getMessage()];
    }
}

/**
 * Log admin activity
 */
function logActivity($userId, $actionType, $description, $ipAddress = null) {
    try {
        $db = getDB();
        
        if ($ipAddress === null) {
            $ipAddress = $_SERVER['REMOTE_ADDR'] ?? null;
        }
        
        $stmt = $db->prepare("INSERT INTO activity_log (user_id, action_type, action_description, ip_address) VALUES (?, ?, ?, ?)");
        $stmt->execute([$userId, $actionType, $description, $ipAddress]);
        
        return true;
    } catch (Exception $e) {
        error_log("Failed to log activity: " . $e->getMessage());
        return false;
    }
}
?>
