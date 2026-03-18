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

$_SESSION['cart'] = $_SESSION['cart'] ?? [];

if ($action === 'add') {
    $productId = (int) ($_POST['product_id'] ?? 0);
    $product = getProductById($productId);

    if ($product) {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity']++;
        } else {
            $_SESSION['cart'][$productId] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => 1,
            ];
        }
    }
}

if ($action === 'update') {
    $productId = (int) ($_POST['product_id'] ?? 0);
    $quantity = max(1, (int) ($_POST['quantity'] ?? 1));
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] = $quantity;
    }
}

if ($action === 'remove') {
    $productId = (int) ($_POST['product_id'] ?? 0);
    unset($_SESSION['cart'][$productId]);
}

$summary = cartSummary();

ob_start();
if (empty($_SESSION['cart'])): ?>
    <div class="empty-state text-center py-5">
        <i class="bi bi-bag text-success fs-1"></i>
        <p class="mt-3 mb-0">Your cart is empty. Add fresh essentials to get started.</p>
    </div>
<?php else: ?>
    <div class="d-flex flex-column gap-3">
        <?php foreach ($_SESSION['cart'] as $item): ?>
            <div class="mini-card d-flex gap-3 align-items-center">
                <img src="<?= htmlspecialchars($item['image']); ?>" alt="<?= htmlspecialchars($item['name']); ?>" class="mini-thumb">
                <div class="flex-grow-1">
                    <h6 class="mb-1"><?= htmlspecialchars($item['name']); ?></h6>
                    <div class="text-muted small mb-2"><?= formatPrice((float) $item['price']); ?></div>
                    <div class="d-flex gap-2 align-items-center">
                        <input type="number" min="1" value="<?= (int) $item['quantity']; ?>" class="form-control form-control-sm cart-qty" data-id="<?= (int) $item['id']; ?>">
                        <button class="btn btn-sm btn-outline-danger remove-cart-btn" data-id="<?= (int) $item['id']; ?>">Remove</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="cart-total-box">
            <strong>Total: <?= formatPrice((float) $summary['total']); ?></strong>
            <p class="small text-muted mb-0">Shipping calculated at checkout.</p>
        </div>
    </div>
<?php endif;
$html = ob_get_clean();

echo json_encode([
    'html' => $html,
    'count' => $summary['count'],
    'total' => formatPrice((float) $summary['total']),
    'message' => 'Cart updated successfully.',
]);
