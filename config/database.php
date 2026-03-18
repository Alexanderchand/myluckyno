<?php
require_once __DIR__ . '/config.php';

// Update these credentials to match your local MySQL setup.
$host = 'localhost';
$dbname = 'nath_enterprises';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $exception) {
    // In production, log this instead of displaying it directly.
    $pdo = null;
}
