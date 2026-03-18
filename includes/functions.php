<?php
require_once __DIR__ . '/data.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function getProducts(?string $category = null): array
{
    global $products;

    if (!$category || $category === 'all') {
        return $products;
    }

    return array_values(array_filter($products, fn ($product) => $product['category'] === $category));
}

function getProductById(int $productId): ?array
{
    foreach (getProducts() as $product) {
        if ($product['id'] === $productId) {
            return $product;
        }
    }

    return null;
}

function formatPrice(float $price): string
{
    return '₹' . number_format($price, 2);
}

function cartSummary(): array
{
    $cart = $_SESSION['cart'] ?? [];
    $count = 0;
    $total = 0;

    foreach ($cart as $item) {
        $count += $item['quantity'];
        $total += $item['price'] * $item['quantity'];
    }

    return [
        'count' => $count,
        'total' => $total,
    ];
}

function wishlistCount(): int
{
    return count($_SESSION['wishlist'] ?? []);
}

function csrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
    }

    return $_SESSION['csrf_token'];
}

function verifyCsrf(?string $token): bool
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], (string) $token);
}
