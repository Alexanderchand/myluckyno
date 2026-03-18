<?php
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/data.php';
$featuredProducts = array_slice($products, 0, 6);
$userName = $_SESSION['user']['name'] ?? 'Guest';
?>
<main>
    <section class="section-padding" id="home">
        <div class="container">
            <div class="hero-card">
                <div class="row align-items-center g-4">
                    <div class="col-lg-7">
                        <span class="hero-chip mb-3"><i class="bi bi-stars"></i> Clean ingredients, modern convenience</span>
                        <h1 class="hero-title mb-3">Healthy pantry shopping made elegant, fast, and fully responsive.</h1>
                        <p class="lead text-muted mb-4">Nath Enterprises brings premium flours and non-dairy products to your doorstep with seamless category filters, AJAX-powered cart updates, and secure customer forms.</p>
                        <div class="d-flex flex-wrap gap-3 mb-4">
                            <a href="#products" class="btn btn-success btn-lg">Shop Products</a>
                            <a href="#contact" class="btn btn-outline-secondary btn-lg rounded-4">Contact Sales</a>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-4"><div class="metric-card"><strong>9+</strong><div class="text-muted small">Featured products</div></div></div>
                            <div class="col-sm-4"><div class="metric-card"><strong>2</strong><div class="text-muted small">Core categories</div></div></div>
                            <div class="col-sm-4"><div class="metric-card"><strong>100%</strong><div class="text-muted small">Responsive layout</div></div></div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="hero-visual h-100 d-flex flex-column justify-content-center">
                            <div class="floating-note mb-3">
                                <strong>Welcome, <?= htmlspecialchars($userName); ?>!</strong>
                                <p class="mb-0 text-muted small">Explore nutritious flour blends, dairy-free drinks, tofu variants, and a warm shopping experience tailored for desktop, tablet, and mobile.</p>
                            </div>
                            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=1000&q=80" alt="Healthy grocery items arranged on a counter" class="img-fluid rounded-4 shadow-sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding pt-0" id="categories">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4">
                <div>
                    <span class="text-success fw-semibold">Categories</span>
                    <h2 class="mb-1">Curated essentials for every kitchen</h2>
                </div>
                <p class="text-muted mb-0">Choose from traditional flours and modern non-dairy alternatives.</p>
            </div>
            <div class="row g-4">
                <?php foreach ($categories as $category): ?>
                    <div class="col-md-6">
                        <div class="category-card h-100">
                            <div class="d-flex justify-content-between align-items-start gap-3">
                                <div>
                                    <span class="hero-chip mb-3 text-capitalize"><?= htmlspecialchars($category['slug']); ?></span>
                                    <h3><?= htmlspecialchars($category['name']); ?></h3>
                                    <p class="text-muted mb-0"><?= htmlspecialchars($category['description']); ?></p>
                                </div>
                                <button class="btn btn-outline-success rounded-pill filter-btn" data-category="<?= htmlspecialchars($category['slug']); ?>">View Products</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section-padding pt-0" id="products">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4">
                <div>
                    <span class="text-success fw-semibold">Products</span>
                    <h2 class="mb-1">Popular picks from Nath Enterprises</h2>
                    <p class="text-muted mb-0"><span id="product-count"><?= count($featuredProducts); ?></span> products currently visible.</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <button class="filter-btn active" data-category="all">All</button>
                    <button class="filter-btn" data-category="flours">Flours</button>
                    <button class="filter-btn" data-category="non-dairy">Non-Dairy</button>
                </div>
            </div>
            <div class="row g-4" id="product-list">
                <?php foreach ($featuredProducts as $product): ?>
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
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section-padding pt-0" id="blog">
        <div class="container">
            <div class="row g-4 align-items-stretch">
                <div class="col-lg-4">
                    <div class="info-card h-100">
                        <span class="text-success fw-semibold">Why choose us</span>
                        <h2 class="mt-2">Built for conversion, trust, and easy deployment</h2>
                        <p class="text-muted">This starter e-commerce project uses a deployment-friendly PHP structure, AJAX interactions, Bootstrap components, and backend validation so you can extend it quickly on XAMPP or WAMP.</p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <article class="blog-card h-100">
                                <span class="text-success small fw-semibold">Blog</span>
                                <h5 class="mt-3">5 smart ways to use gram flour beyond pakoras</h5>
                                <p class="text-muted small mb-0">From breakfast chilla to protein-rich baking, gram flour is one of the most versatile pantry staples.</p>
                            </article>
                        </div>
                        <div class="col-md-4">
                            <article class="blog-card h-100">
                                <span class="text-success small fw-semibold">Nutrition</span>
                                <h5 class="mt-3">Why soy tofu belongs in every high-protein meal plan</h5>
                                <p class="text-muted small mb-0">Tofu absorbs flavors beautifully, cooks fast, and offers a reliable plant-based protein option.</p>
                            </article>
                        </div>
                        <div class="col-md-4">
                            <article class="blog-card h-100">
                                <span class="text-success small fw-semibold">Trends</span>
                                <h5 class="mt-3">How non-dairy beverages are transforming daily routines</h5>
                                <p class="text-muted small mb-0">Consumers increasingly seek lighter, dairy-free options that still feel indulgent and familiar.</p>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding pt-0" id="about">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="info-card h-100">
                        <span class="text-success fw-semibold">About Nath Enterprises</span>
                        <h2 class="mt-2">Locally rooted, quality focused</h2>
                        <p class="text-muted">Nath Enterprises serves households and businesses with flour and non-dairy products presented through a clean, modern digital storefront. The experience emphasizes fast browsing, soft visual design, secure forms, and accessible shopping flows.</p>
                        <ul class="text-muted ps-3 mb-0">
                            <li>Responsive Bootstrap layout for every screen size</li>
                            <li>AJAX category filtering without page reloads</li>
                            <li>Session-based cart and wishlist with PHP handling</li>
                            <li>Prepared-database ready structure with sample schema included</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6" id="auth">
                    <div class="auth-card h-100">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h4>Login</h4>
                                <form id="login-form" novalidate>
                                    <input type="hidden" name="csrf_token" value="<?= csrfToken(); ?>">
                                    <div class="mb-3">
                                        <input type="email" name="email" class="form-control" placeholder="Email address" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="password" class="form-control" placeholder="Password" minlength="6" required>
                                    </div>
                                    <button class="btn btn-success w-100" type="submit">Login</button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <h4>Register</h4>
                                <form id="register-form" novalidate>
                                    <input type="hidden" name="csrf_token" value="<?= csrfToken(); ?>">
                                    <div class="mb-3">
                                        <input type="text" name="name" class="form-control" placeholder="Full name" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" name="email" class="form-control" placeholder="Email address" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="password" class="form-control" placeholder="Create password" minlength="6" required>
                                    </div>
                                    <button class="btn btn-success w-100" type="submit">Create Account</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding pt-0" id="contact">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="contact-panel h-100">
                        <span class="text-success fw-semibold">Contact Us</span>
                        <h2 class="mt-2">Let’s talk wholesale, retail, or distribution</h2>
                        <p class="text-muted">Need pricing, catalog support, or bulk order information? Reach out through the form or the details below.</p>
                        <ul class="list-unstyled text-muted mb-0">
                            <li class="mb-2"><i class="bi bi-telephone me-2 text-success"></i><?= CONTACT_PHONE; ?></li>
                            <li class="mb-2"><i class="bi bi-envelope me-2 text-success"></i><?= CONTACT_EMAIL; ?></li>
                            <li><i class="bi bi-geo-alt me-2 text-success"></i><?= CONTACT_ADDRESS; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="contact-panel h-100">
                        <form id="contact-form" novalidate>
                            <input type="hidden" name="csrf_token" value="<?= csrfToken(); ?>">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Your name" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Email address" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="tel" name="phone" class="form-control" placeholder="Phone number" required>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" name="subject">
                                        <option value="Retail Enquiry">Retail Enquiry</option>
                                        <option value="Wholesale Enquiry">Wholesale Enquiry</option>
                                        <option value="Distribution">Distribution</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <textarea name="message" class="form-control" rows="5" placeholder="Tell us how we can help" minlength="10" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-success" type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
