<?php $summary = cartSummary(); ?>
<footer class="footer-section py-5 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5><?= APP_NAME; ?></h5>
                <p class="text-muted mb-3">Premium flours and non-dairy essentials crafted for modern Indian households.</p>
                <div class="d-flex gap-3 social-links">
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-4">
                <h6>Contact</h6>
                <ul class="list-unstyled text-muted small">
                    <li><?= CONTACT_PHONE; ?></li>
                    <li><?= CONTACT_EMAIL; ?></li>
                    <li><?= CONTACT_ADDRESS; ?></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h6>Quick facts</h6>
                <div class="footer-card">
                    <div><strong>Cart Items:</strong> <span class="cart-count"><?= $summary['count']; ?></span></div>
                    <div><strong>Wishlist:</strong> <span class="wishlist-count"><?= wishlistCount(); ?></span></div>
                    <div><strong>Support:</strong> Mon-Sat, 9 AM - 7 PM</div>
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex flex-column flex-md-row justify-content-between gap-2 text-muted small">
            <span>© <?= date('Y'); ?> <?= APP_NAME; ?>. All rights reserved.</span>
            <span>Built with PHP, AJAX, Bootstrap, JavaScript, HTML, and CSS.</span>
        </div>
    </div>
</footer>

<div class="offcanvas offcanvas-end" tabindex="-1" id="cartDrawer" aria-labelledby="cartDrawerLabel">
    <div class="offcanvas-header">
        <h5 id="cartDrawerLabel">Shopping Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <div id="cart-items"></div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="wishlistDrawer" aria-labelledby="wishlistDrawerLabel">
    <div class="offcanvas-header">
        <h5 id="wishlistDrawerLabel">Wishlist</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <div id="wishlist-items"></div>
    </div>
</div>

<script>
    window.APP = {
        csrfToken: '<?= csrfToken(); ?>'
    };
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
