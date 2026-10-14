<?php

function loginUser(PDO $pdo, string $login, string $password): bool
{
    $stmt = $pdo->prepare("
        SELECT user_id, user_email, user_username, user_password, user_role
        FROM users
        WHERE user_username = ? OR user_email = ?
        LIMIT 1
    ");
    $stmt->execute([$login, $login]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['user_password'])) {
        return false;
    }

    session_regenerate_id(true);

    $_SESSION['user_id']    = $user['user_id'];
    $_SESSION['user_email'] = $user['user_email'];
    $_SESSION['user_role']  = $user['user_role'];

    startUserSession($pdo);

    return true;
}