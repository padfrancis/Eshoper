SET GLOBAL max_allowed_packet = 67108864;

CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE, 
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    password CHAR(64) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    prod_name VARCHAR(100) NOT NULL UNIQUE, 
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image MEDIUMBLOB NOT NULL,
    stock_quantity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS order_reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL, 
    prod_name VARCHAR(50) NOT NULL, 
    quantity INT NOT NULL,
    reservation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('reserved', 'cancelled', 'completed') NOT NULL DEFAULT 'reserved',
    FOREIGN KEY (username) REFERENCES users(username),
    FOREIGN KEY (prod_name) REFERENCES products(prod_name) 
);

CREATE TABLE IF NOT EXISTS reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    prod_name VARCHAR(50) NOT NULL, 
    username VARCHAR(50) NOT NULL,
    rating INT NOT NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (prod_name) REFERENCES products(prod_name),
    FOREIGN KEY (username) REFERENCES users(username)
);