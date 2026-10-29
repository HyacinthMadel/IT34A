<?php

function logActivity(PDO $pdo, $userId, $email, string $action, string $status): void
{
    $stmt = $pdo->prepare("
        INSERT INTO activity_logs
            (user_id, user_email, activity_log_action, activity_log_status,
             activity_log_ip_address, activity_log_user_agent)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $userId,
        $email,
        $action,
        $status,
        $_SERVER['REMOTE_ADDR'] ?? null,
        substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255),
    ]);
}