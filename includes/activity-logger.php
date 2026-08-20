<?php

function logActivity($pdo, $user_id, $user_Email, $action, $status = 'success')
{
    try {

        // Get client IP address
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR']
            ?? $_SERVER['REMOTE_ADDR']
            ?? 'UNKNOWN';

        // If multiple IPs exist, get the first one
        if (strpos($ip, ',') !== false) {
            $ip = trim(explode(',', $ip)[0]);
        }

        // Get user agent / browser information
        $user_agent = $_SERVER['HTTP_USER_AGENT']
            ?? 'Unknown';

        // Insert activity into database
        $stmt = $pdo->prepare("
            INSERT INTO activity_logs (
                user_id,
                user_email,
                activity_log_action,
                activity_log_status,
                activity_log_ip_address,
                activity_log_user_agent
            )
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $user_id,
            $user_Email,
            $action,
            $status,
            $ip,
            $user_agent
        ]);

        return $success

    } catch (PDOException $e) {

        error_log("Activity Log Error: " . $e->getMessage());

        return false;
    }

    return true;
}