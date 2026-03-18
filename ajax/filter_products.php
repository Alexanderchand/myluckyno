<?php
require_once __DIR__ . '/../includes/functions.php';

$category = $_GET['category'] ?? 'all';
$filteredProducts = getProducts($category);

ob_start();
foreach ($filteredProducts as $product): ?>
    <div class="col-md-6 col-xl-4">
        <div class="product-card h-100">
            <div class="product-image-wrap">
                <img src="<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" class="img-fluid product-image">
                <span class="badge bg-light text-success product-badge"><?= htmlspecialchars($product['badge']); ?></span>
            </div>
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                    <div>
                        <h5 class="mb-1"><?= htmlspecialchars($product['name']); ?></h5>
                        <p class="text-muted small mb-0 text-capitalize"><?= htmlspecialchars(str_replace('-', ' ', $product['category'])); ?></p>
                    </div>
                    <button class="btn btn-sm btn-outline-danger wishlist-btn" data-id="<?= $product['id']; ?>"><i class="bi bi-heart"></i></button>
                </div>
                <p class="text-muted small"><?= htmlspecialchars($product['description']); ?></p>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <strong class="price-tag"><?= formatPrice((float) $product['price']); ?></strong>
                        <span class="text-muted small d-block">Per <?= htmlspecialchars($product['unit']); ?></span>
                    </div>
                    <span class="stock-pill">Fresh stock</span>
                </div>
                <button class="btn btn-success w-100 add-cart-btn" data-id="<?= $product['id']; ?>">Add to Cart</button>
            </div>
        </div>
    </div>
<?php endforeach;
$html = ob_get_clean();

header('Content-Type: application/json');
echo json_encode([
    'html' => $html,
    'count' => count($filteredProducts),
]);
