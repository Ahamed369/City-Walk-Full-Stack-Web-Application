<?php
/**
 * Generate Fresh Password Hash for Admin
 * Place in: C:\xampp\htdocs\city-walk\generate-hash.php
 * Access: http://localhost/city-walk/generate-hash.php
 */

echo "<h1>Generate Fresh Admin Password</h1>";

$password = 'admin123';
$newHash = password_hash($password, PASSWORD_DEFAULT);

echo "<h2>New Password Hash Generated:</h2>";
echo "<p><strong>Password:</strong> admin123</p>";
echo "<p><strong>New Hash:</strong></p>";
echo "<textarea style='width: 100%; height: 100px; font-family: monospace;'>" . $newHash . "</textarea>";

echo "<h2>SQL Query to Update:</h2>";
echo "<p>Copy this query and run it in phpMyAdmin:</p>";
echo "<textarea style='width: 100%; height: 150px; font-family: monospace;'>";
echo "UPDATE users \n";
echo "SET password_hash = '" . $newHash . "'\n";
echo "WHERE username = 'admin';";
echo "</textarea>";

echo "<h2>Test the Hash:</h2>";
if (password_verify($password, $newHash)) {
    echo "<p style='color: green; font-size: 18px;'>✓ Hash verification SUCCESSFUL!</p>";
    echo "<p>This hash will work for password: <strong>admin123</strong></p>";
} else {
    echo "<p style='color: red;'>✗ Hash verification failed (this should not happen)</p>";
}

echo "<hr>";
echo "<h2>Instructions:</h2>";
echo "<ol>";
echo "<li>Copy the SQL query above</li>";
echo "<li>Open phpMyAdmin</li>";
echo "<li>Select 'city_walk_db' database</li>";
echo "<li>Click 'SQL' tab</li>";
echo "<li>Paste and run the query</li>";
echo "<li>Try logging in with: admin@citywalk.lk / admin123</li>";
echo "</ol>";
?>