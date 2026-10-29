<?php

function requireRole(string $role): void
{
    if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== $role) {
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }
}