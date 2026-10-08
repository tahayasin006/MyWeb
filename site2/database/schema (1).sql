CREATE DATABASE IF NOT EXISTS `3byaz` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `3byaz`;

CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(80) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(180) NOT NULL,
  slug VARCHAR(220) UNIQUE NOT NULL,
  description TEXT,
  price DECIMAL(10,2) NOT NULL DEFAULT 0,
  stock INT NOT NULL DEFAULT 0,
  category VARCHAR(100) DEFAULT NULL,
  image VARCHAR(255) DEFAULT NULL,
  active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_no VARCHAR(40) UNIQUE NOT NULL,
  customer_name VARCHAR(150) NOT NULL,
  email VARCHAR(180) NOT NULL,
  phone VARCHAR(40) NOT NULL,
  address TEXT NOT NULL,
  city VARCHAR(80) NOT NULL,
  district VARCHAR(100) NOT NULL,
  postal_code VARCHAR(20) DEFAULT NULL,
  subtotal DECIMAL(10,2) NOT NULL,
  shipping DECIMAL(10,2) NOT NULL DEFAULT 0,
  total DECIMAL(10,2) NOT NULL,
  payment_method VARCHAR(30) NOT NULL,
  payment_status VARCHAR(30) NOT NULL DEFAULT 'pending',
  order_status VARCHAR(30) NOT NULL DEFAULT 'new',
  payment_reference VARCHAR(120) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  product_name VARCHAR(180) NOT NULL,
  quantity INT NOT NULL,
  unit_price DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

INSERT INTO admins (username, password_hash)
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llCkS6iQw0nV7gM6V6iK');
-- Demo hash; change this password immediately in production.

INSERT INTO products (name,slug,description,price,stock,category,image) VALUES
('3D Baskı Ejderha Figürü','3d-baski-ejderha-figuru','Dekoratif 3D baskı ejderha figürü.',349.90,10,'Figür','assets/products/ejderha.jpg'),
('Flexi Dinozor','flexi-dinozor','Hareketli esnek dinozor.',249.90,20,'Oyuncak','assets/products/dinozor.jpg'),
('Modern 3D Kalemlik','modern-3d-kalemlik','Masaüstü için modern kalemlik.',299.90,15,'Masaüstü','assets/products/kalemlik.jpg'),
('Sevimli Kedi Figürü','sevimli-kedi-figuru','Dekoratif kedi figürü.',199.90,25,'Figür','assets/products/kedi.jpg');
