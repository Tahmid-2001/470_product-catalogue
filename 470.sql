
-- Product Catalog and Order Management System Database Schema

-- Create Database
CREATE DATABASE product_catalog_system;
USE product_catalog_system;

-- 1. Users Table (handles both users and admins)
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    age INT NOT NULL,
    account_type ENUM('user', 'admin') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Products Table
CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    product_type VARCHAR(50) NOT NULL,
    description TEXT,
    product_specification TEXT,
    product_price DECIMAL(10, 2) NOT NULL,
    stock_quantity INT NOT NULL DEFAULT 0,
    expiration_date DATE,
    product_image VARCHAR(255) DEFAULT 'default.jpg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 3. Cart Table (temporary storage before checkout)
CREATE TABLE cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

-- 4. Orders Table
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    product_name VARCHAR(100) NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    total_price DECIMAL(10, 2) NOT NULL,
    order_status ENUM('pending', 'delivered', 'cancelled') DEFAULT 'pending',
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

-- Insert sample data for testing

-- Sample Admin Account
INSERT INTO users (full_name, email, password, contact_number, age, account_type) VALUES
('Admin User', 'admin@test.com', 'admin123', '1234567890', 25, 'admin');

-- Sample Regular User Account
INSERT INTO users (full_name, email, password, contact_number, age, account_type) VALUES
('John Doe', 'user@test.com', 'user123', '9876543210', 30, 'user');

-- Sample Products
INSERT INTO products (product_name, product_type, description, product_specification, product_price, stock_quantity, expiration_date, product_image) VALUES
('Laptop', 'Electronics', 'High-performance laptop for work and gaming', 'Intel i7, 16GB RAM, 512GB SSD', 999.99, 10, '2026-12-31', 'laptop.jpg'),
('Smartphone', 'Electronics', 'Latest smartphone with advanced camera', '128GB Storage, 12MP Camera, 5G Ready', 699.99, 15, '2027-06-30', 'smartphone.jpg'),
('Office Chair', 'Furniture', 'Ergonomic office chair for comfortable work', 'Adjustable height, lumbar support, mesh back', 249.99, 8, NULL, 'chair.jpg'),
('Coffee Maker', 'Appliances', 'Automatic coffee maker with timer', '12-cup capacity, programmable, stainless steel', 89.99, 20, NULL, 'coffee_maker.jpg'),
('Running Shoes', 'Sports', 'Lightweight running shoes for athletes', 'Size 9, breathable material, shock absorption', 129.99, 25, NULL, 'shoes.jpg');
