-- Sample schema for Nath Enterprises e-commerce website.
CREATE DATABASE IF NOT EXISTS nath_enterprises CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE nath_enterprises;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    slug VARCHAR(120) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(180) NOT NULL,
    slug VARCHAR(180) NOT NULL UNIQUE,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    unit VARCHAR(60),
    image_url VARCHAR(255),
    stock_qty INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    order_number VARCHAR(60) NOT NULL UNIQUE,
    subtotal DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'paid', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE wishlists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_wishlist (user_id, product_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL,
    phone VARCHAR(30) NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO categories (name, slug) VALUES
('Flours', 'flours'),
('Non-Dairy', 'non-dairy');

INSERT INTO products (category_id, name, slug, description, price, unit, image_url, stock_qty) VALUES
(1, 'Wheat Flour', 'wheat-flour', 'Freshly milled wheat flour.', 120.00, '5 kg', 'https://images.unsplash.com/photo-1603048719539-9ecb4d57eaf7?auto=format&fit=crop&w=900&q=80', 100),
(1, 'Pea Flour', 'pea-flour', 'Protein-rich pea flour.', 140.00, '2 kg', 'https://images.unsplash.com/photo-1515543904379-3d757afe72e7?auto=format&fit=crop&w=900&q=80', 80),
(1, 'Gram Flour', 'gram-flour', 'Classic besan for snacks.', 110.00, '2 kg', 'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=900&q=80', 90),
(1, 'Urad Flour', 'urad-flour', 'Smooth urad flour for batter.', 155.00, '1 kg', 'https://images.unsplash.com/photo-1615485291234-9fbc9b1b9aaa?auto=format&fit=crop&w=900&q=80', 70),
(1, 'Barley Flour', 'barley-flour', 'Fiber-rich barley flour.', 130.00, '2 kg', 'https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?auto=format&fit=crop&w=900&q=80', 85),
(2, 'Soy Milk', 'soy-milk', 'Creamy dairy-free soy milk.', 85.00, '1 L', 'https://images.unsplash.com/photo-1550583724-b2692b85b150?auto=format&fit=crop&w=900&q=80', 120),
(2, 'Flavored Milk', 'flavored-milk', 'Banana, Kesar Almond, Strawberry, Mango, and Sweet soy milk.', 95.00, '750 ml', 'https://images.unsplash.com/photo-1514996937319-344454492b37?auto=format&fit=crop&w=900&q=80', 110),
(2, 'Soy Tofu', 'soy-tofu', 'Soft, high-protein tofu.', 90.00, '400 g', 'https://images.unsplash.com/photo-1603048297172-c92544798d5a?auto=format&fit=crop&w=900&q=80', 95),
(2, 'Masala Tofu', 'masala-tofu', 'Spiced ready-to-cook tofu.', 110.00, '400 g', 'https://images.unsplash.com/photo-1547592166-23ac45744acd?auto=format&fit=crop&w=900&q=80', 90);
