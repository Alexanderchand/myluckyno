<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

if (!verifyCsrf($_POST['csrf_token'] ?? null)) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Invalid CSRF token.']);
    exit;
}

$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$password = trim($_POST['password'] ?? '');

if (!$email || strlen($password) < 6) {
    echo json_encode(['status' => 'error', 'message' => 'Please enter a valid email and password.']);
    exit;
}

// Demo-friendly fallback for local testing without a database.
if (!$pdo) {
    $_SESSION['user'] = ['name' => 'Demo User', 'email' => $email];
    echo json_encode(['status' => 'success', 'message' => 'Logged in using demo mode.']);
    exit;
}

$stmt = $pdo->prepare('SELECT id, name, email, password_hash FROM users WHERE email = ? LIMIT 1');
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password_hash'])) {
    $_SESSION['user'] = ['id' => $user['id'], 'name' => $user['name'], 'email' => $user['email']];
    echo json_encode(['status' => 'success', 'message' => 'Login successful.']);
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Incorrect credentials.']);
