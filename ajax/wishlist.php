<?php
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');
$action = $_POST['action'] ?? $_GET['action'] ?? 'view';
$token = $_POST['csrf_token'] ?? $_GET['csrf_token'] ?? null;

if (!in_array($action, ['view'], true) && !verifyCsrf($token)) {
    http_response_code(403);
    echo json_encode(['message' => 'Invalid CSRF token.']);
    exit;
}

$_SESSION['wishlist'] = $_SESSION['wishlist'] ?? [];

if ($action === 'add') {
    $productId = (int) ($_POST['product_id'] ?? 0);
    $product = getProductById($productId);
    if ($product) {
        $_SESSION['wishlist'][$productId] = $product;
    }
}

if ($action === 'remove') {
    $productId = (int) ($_POST['product_id'] ?? 0);
    unset($_SESSION['wishlist'][$productId]);
}

ob_start();
if (empty($_SESSION['wishlist'])): ?>
    <div class="empty-state text-center py-5">
        <i class="bi bi-heart text-danger fs-1"></i>
        <p class="mt-3 mb-0">No wishlist items yet. Save favorites for later.</p>
    </div>
<?php else: ?>
    <div class="d-flex flex-column gap-3">
        <?php foreach ($_SESSION['wishlist'] as $item): ?>
            <div class="mini-card d-flex gap-3 align-items-center">
                <img src="<?= htmlspecialchars($item['image']); ?>" alt="<?= htmlspecialchars($item['name']); ?>" class="mini-thumb">
                <div class="flex-grow-1">
                    <h6 class="mb-1"><?= htmlspecialchars($item['name']); ?></h6>
                    <div class="text-muted small mb-2"><?= formatPrice((float) $item['price']); ?></div>
                    <button class="btn btn-sm btn-outline-danger remove-wishlist-btn" data-id="<?= (int) $item['id']; ?>">Remove</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif;
$html = ob_get_clean();

echo json_encode([
    'html' => $html,
    'count' => wishlistCount(),
    'message' => 'Wishlist updated successfully.',
]);
