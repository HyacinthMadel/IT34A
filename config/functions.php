<?php

function redirect($path)
{
    header("Location: " . BASE_URL . $path);
    exit;
}

function loginUser($pdo, $login, $password)
{
    $sql = "
        SELECT
            id AS user_id,
            email AS user_email,
            username AS user_username,
            password AS user_password,
            role AS user_role
        FROM users
        WHERE email = :email
           OR username = :username
        LIMIT 1
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':email' => $login,
        ':username' => $login
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        return false;
    }

    // Plain-text password comparison
    if ($password !== $user['user_password']) {
        return false;
    }

    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['user_email'] = $user['user_email'];
    $_SESSION['user_username'] = $user['user_username'];
    $_SESSION['user_role'] = $user['user_role'];

    return true;
}

function requireLogin()
{
    if (!isset($_SESSION['user_id'])) {
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }
}

function requireRole($role)
{
    requireLogin();

    if ($_SESSION['user_role'] !== $role) {
        http_response_code(403);
        die('Access Denied');
    }
}