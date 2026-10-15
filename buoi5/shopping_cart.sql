-- =======================================================
-- BÀI THỰC HÀNH BUỔI 5: PHP + MYSQL – QUẢN LÝ GIỎ HÀNG
-- Sinh viên: Nguyễn Đình Phiên
-- Mã sinh viên: 23001913
-- Email: 23001913@hus.edu.vn
-- Lớp: K68 ĐHKHTN - ĐHQGHN (HUS)
-- =======================================================

-- 1. Tạo database shopping_cart và sử dụng database
CREATE DATABASE IF NOT EXISTS shopping_cart CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE shopping_cart;

-- =======================================================
-- 2. TẠO BẢNG PRODUCTS VÀ CHÈN DỮ LIỆU MẪU
-- =======================================================
DROP TABLE IF EXISTS products;
CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Thêm tối thiểu 5 sản phẩm mẫu
INSERT INTO products (name, price, quantity) VALUES
('Bàn phím cơ DareU EK87 Tenkeyless', 490000.00, 15),
('Chuột không dây Logitech M331 Silent', 320000.00, 25),
('Tai nghe Bluetooth Sony WH-CH520', 990000.00, 10),
('Màn hình LG 24 inch IPS Full HD 75Hz', 2450000.00, 8),
('Balo laptop chống sốc Targus 15.6 inch', 650000.00, 20),
('Ổ cứng SSD Kingston NV2 500GB PCIe NVMe', 890000.00, 30);

-- =======================================================
-- 3. TẠO BẢNG USERS VÀ CHÈN DỮ LIỆU MẪU
-- =======================================================
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Thêm tài khoản mẫu đã mã hóa bằng password_hash() (Bcrypt)
-- Tài khoản 1: admin / admin123
-- Tài khoản 2: phien23001913 / 123456
INSERT INTO users (username, password) VALUES
('admin', '$2y$10$NjqAXKH8e290SW7PBq1Jxu/YujfmNWsW3xKfxo8yMzDM/wNwCeCnu'),
('phien23001913', '$2y$10$/p4ZUycAvruNfkyd4PKxUuHlv6Gfr5g7UfHihv928AlEOLeV4b752');
