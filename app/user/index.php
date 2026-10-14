<?php
require_once __DIR__ . '/../../config/config.php';
requireRole('user');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User</title>
</head>
<body>
    <h1>Hello User</h1>
    <a href="../auth/signout.php">Sign Out</a>
</body>
</html>