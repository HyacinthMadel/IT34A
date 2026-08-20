<?php
session_start();
require_once 'includes/activity-logger.php';

//defiine('','');
define('BASE_URL','http://localhost/Activity-Logger/');

define('DB_HOST','localhost');
define('DB_NAME','it34a_lab_db');
define('DB_USER','root');
define('DB_PASS','');

$user_id = "root" ?? null;
$email = "root@example" ?? null;

try{
    $pdo = new PDO(
        "mysql:host=".DB_HOST.";dbname=".DB_NAME,
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
   // echo ("Connected successfully");
   // logActivity($pdo,$user_id,$email,'connection_db','success');

} catch (PDOException $e) {
    die("connection failed: " . $e->getMessage());

}
?>