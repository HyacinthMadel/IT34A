<?php

function startUserSession(PDO $pdo): bool
{
    if (!isset($_SESSION['user_id'])) {
        return false;
    }

    $stmt = $pdo->prepare("
        INSERT INTO user_sessions (user_id, session_start)
        VALUES (:user_id, NOW())
    ");
    $stmt->execute([':user_id' => $_SESSION['user_id']]);

    $_SESSION['db_session_id'] = (int) $pdo->lastInsertId();

    return true;
}

function endUserSession(PDO $pdo): bool
{
    if (!isset($_SESSION['db_session_id'])) {
        return false;
    }

    $stmt = $pdo->prepare("
        UPDATE user_sessions
        SET session_end = NOW(),
            session_duration = TIMESTAMPDIFF(SECOND, session_start, NOW())
        WHERE session_id = :session_id
    ");
    $stmt->execute([':session_id' => $_SESSION['db_session_id']]);

    return true;
}