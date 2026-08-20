<?php
require_once('config/config.php');

$user_id = "root" ?? null;
$user_Email = "root" ?? null;

$success = logActivity($pdo,$user_id,$user_Email,'test_activity','success');

if($success){
    echo "Acitivty log inserted successfully";
} else {
    echo "Failed to insert activity log";
}
?>

//on config
// require_once(__DIR_ ./../includes/activity-logger.php)