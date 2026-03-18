<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

if (!verifyCsrf($_POST['csrf_token'] ?? null)) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Invalid CSRF token.']);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$password = trim($_POST['password'] ?? '');

if ($name === '' || !$email || strlen($password) < 6) {
    echo json_encode(['status' => 'error', 'message' => 'Please complete all required fields with valid values.']);
    exit;
}

if (!$pdo) {
    $_SESSION['user'] = ['name' => $name, 'email' => $email];
    echo json_encode(['status' => 'success', 'message' => 'Registered successfully in demo mode.']);
    exit;
}

$check = $pdo->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
$check->execute([$email]);
if ($check->fetch()) {
    echo json_encode(['status' => 'error', 'message' => 'Email already registered.']);
    exit;
}

$stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)');
$stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);
$_SESSION['user'] = ['id' => $pdo->lastInsertId(), 'name' => $name, 'email' => $email];

echo json_encode(['status' => 'success', 'message' => 'Account created successfully.']);
