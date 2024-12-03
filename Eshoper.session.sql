--@block
-- Users Table
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    password CHAR(64) NOT NULL, -- SHA-256 hash length
    email VARCHAR(100) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--@block
-- Categories Table
CREATE TABLE IF NOT EXISTS categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL
);
--@block
-- Products Table
CREATE TABLE IF NOT EXISTS products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    prod_name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image MEDIUMBLOB NOT NULL,
    stock_quantity INT NOT NULL,
    category_id INT NOT NULL REFERENCES categories(category_id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--@block
-- Orders Table
CREATE TABLE IF NOT EXISTS orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL REFERENCES users(user_id),
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'processing', 'completed', 'cancelled') NOT NULL DEFAULT 'pending',
    total_amount DECIMAL(10, 2) NOT NULL
);

--@block
-- Order Details Table
CREATE TABLE IF NOT EXISTS order_details (
    order_detail_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL REFERENCES orders(order_id),
    product_id INT NOT NULL REFERENCES products(product_id),
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);

--@block
-- Cart Table
CREATE TABLE IF NOT EXISTS cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL REFERENCES users(user_id),
    product_id INT NOT NULL REFERENCES products(product_id),
    quantity INT NOT NULL,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--@block
-- Payment Table
CREATE TABLE IF NOT EXISTS payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL REFERENCES orders(order_id),
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    amount DECIMAL(10, 2) NOT NULL,
    payment_method ENUM('credit_card', 'paypal', 'cash') NOT NULL,
    status ENUM('pending', 'completed', 'cancelled') NOT NULL DEFAULT 'pending'
);

--@block
-- Reviews Table
CREATE TABLE IF NOT EXISTS reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL REFERENCES products(product_id),
    user_id INT NOT NULL REFERENCES users(user_id),
    rating INT NOT NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--@block
-- Sample data for Users Table
INSERT INTO users (username, password, email, role) VALUES
('admin', SHA2('adminpass', 256), 'admin@example.com', 'admin'),
('user1', SHA2('user1pass', 256), 'user1@example.com', 'user'),
('user2', SHA2('user2pass', 256), 'user2@example.com', 'user');

-- Sample data for Categories Table
INSERT INTO categories (category_name, description) VALUES
('Electronics', 'Electronic gadgets and devices'),
('Books', 'Various kinds of books'),
('Clothing', 'Men and Women clothing');

-- Sample data for Products Table
INSERT INTO products (prod_name, description, price, image, stock_quantity, category_id) VALUES
('Smartphone', 'Latest model smartphone', 699.99, 'image1', 50, 1),
('Laptop', 'High performance laptop', 999.99, 'image2', 30, 1),
('Novel', 'Bestselling novel', 19.99, 'image3', 100, 2),
('T-Shirt', 'Cotton T-Shirt', 9.99, 'image4', 200, 3);

-- Sample data for Orders Table
INSERT INTO orders (user_id, status, total_amount) VALUES
(2, 'pending', 719.98),
(3, 'completed', 29.98);

-- Sample data for Order Details Table
INSERT INTO order_details (order_id, product_id, quantity, price) VALUES
(1, 1, 1, 699.99),
(1, 3, 1, 19.99),
(2, 3, 1, 19.99),
(2, 4, 1, 9.99);

-- Sample data for Cart Table
INSERT INTO cart (user_id, product_id, quantity) VALUES
(2, 2, 1),
(3, 1, 2);

-- Sample data for Payments Table
INSERT INTO payments (order_id, amount, payment_method, status) VALUES
(1, 719.98, 'credit_card', 'pending'),
(2, 29.98, 'paypal', 'completed');

-- Sample data for Reviews Table
INSERT INTO reviews (product_id, user_id, rating, comment) VALUES
(1, 2, 5, 'Excellent product!'),
(3, 3, 4, 'Good read, but a bit lengthy.');