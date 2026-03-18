<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/database.php';

header('Content-Type: application/json');

if (!verifyCsrf($_POST['csrf_token'] ?? null)) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Invalid CSRF token.']);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$phone = preg_replace('/[^0-9+]/', '', $_POST['phone'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || !$email || strlen($message) < 10) {
    echo json_encode(['status' => 'error', 'message' => 'Please provide valid contact details and a longer message.']);
    exit;
}

if ($pdo) {
    $stmt = $pdo->prepare('INSERT INTO contact_messages (name, email, phone, message) VALUES (?, ?, ?, ?)');
    $stmt->execute([$name, $email, $phone, $message]);
}

echo json_encode(['status' => 'success', 'message' => 'Thanks for contacting Nath Enterprises. We will reach out shortly.']);
