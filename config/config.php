<?php
session_start();

// Load activity logger
require_once __DIR__ . '/../function/activity.php';
require_once __DIR__ . '/../function/auth.php';
require_once __DIR__ . '/../function/redirect.php';
require_once __DIR__ . '/../function/sessions.php';
require_once __DIR__ . '/../function/csv.php';


require_once __DIR__ . '/../vendor/autoload.php';
$dotev = Dotenv\Dotenv: : createImmutable(__DIR__ . '/../');
$dotev -> load();

define('DB_HOST', $_ENV['DB_HOST'] ?? '');
define('DB_NAME', $_ENV['DB_NAME'] ?? '');
define('DB_USER', $_ENV['DB_USER'] ?? '');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');

// Application URL
define('BASE_URL', 'http://localhost/IT34A');



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