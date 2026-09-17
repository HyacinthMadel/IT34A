<?php
session_start();

// Load activity logger
require_once __DIR__ . '/../includes/activity-logger.php';


// Application URL
define('BASE_URL', 'http://localhost/IT34A');

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'IT34A');
define('DB_USER', 'root');
define('DB_PASS', '');

$user_id = "root" ?? null;
$user_email = "root" ?? null;

try {

    // Create PDO connection
    $pdo = new PDO(
        "mysql:host=" . DB_HOST .
        ";dbname=" . DB_NAME,

        DB_USER,
        DB_PASS,

        [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );

    $success = logActivity(
        $pdo,
        $user_id,
        $user_email,
        'db_connect',
        'success'
    );

} catch (PDOException $e) {

    die("Database connection failed: " . $e->getMessage());

}
?>