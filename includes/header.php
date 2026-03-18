<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/functions.php';
$summary = cartSummary();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME; ?> | Natural Flours & Non-Dairy Goodness</title>
    <meta name="description" content="Modern e-commerce storefront for Nath Enterprises with responsive layout, product filters, cart, wishlist, blog, and secure forms.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="index.php">
            <span class="brand-mark">N</span>
            <span>
                <span class="d-block brand-title"><?= APP_NAME; ?></span>
                <small class="text-muted">Healthy pantry essentials</small>
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#categories">Category</a></li>
                <li class="nav-item"><a class="nav-link" href="#products">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="#blog">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact Us</a></li>
            </ul>
            <div class="d-flex align-items-center gap-2 nav-icons">
                <button class="btn icon-btn" data-bs-toggle="offcanvas" data-bs-target="#cartDrawer" aria-label="View cart">
                    <i class="bi bi-cart3"></i>
                    <span class="badge rounded-pill bg-success cart-count"><?= $summary['count']; ?></span>
                </button>
                <button class="btn icon-btn" data-bs-toggle="offcanvas" data-bs-target="#wishlistDrawer" aria-label="View wishlist">
                    <i class="bi bi-heart"></i>
                    <span class="badge rounded-pill bg-danger wishlist-count"><?= wishlistCount(); ?></span>
                </button>
                <a class="btn icon-btn" href="#auth" aria-label="Login or profile">
                    <i class="bi bi-person"></i>
                </a>
            </div>
        </div>
    </div>
</nav>
