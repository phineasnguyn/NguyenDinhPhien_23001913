-- Sinh viên: Nguyễn Đình Phiên
-- Mã sinh viên: 23001913


-- PHẦN I: BÀI 1 – QUẢN LÝ GIỎ HÀNG

-- Tạo database shopping_cart và chuyển sang sử dụng database này
CREATE DATABASE IF NOT EXISTS shopping_cart CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE shopping_cart;

-- Tạo bảng cart_items
DROP TABLE IF EXISTS cart_items;
CREATE TABLE cart_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL
);

-- 2. Thực hiện các yêu cầu:

-- 2.1: Thêm ít nhất 5 sản phẩm vào bảng
INSERT INTO cart_items (name, price, quantity) VALUES
('Áo thun polo nam Cotton', 150000.00, 3),
('Quần jean slimfit nam', 350000.00, 2),
('Giày thể thao Sneaker', 650000.00, 1),
('Tất cổ ngắn (hộp 5 đôi)', 50000.00, 8),
('Mũ lưỡi trai phong cách', 85000.00, 6),
('Balo laptop chống sốc', 450000.00, 2);

-- 2.2: Hiển thị toàn bộ sản phẩm
SELECT * FROM cart_items;

-- 2.3: Hiển thị sản phẩm có giá lớn hơn 100000
SELECT * FROM cart_items 
WHERE price > 100000;

-- 2.4: Hiển thị sản phẩm có số lượng lớn hơn 5
SELECT * FROM cart_items 
WHERE quantity > 5;

-- 2.5: Sắp xếp sản phẩm theo giá giảm dần
SELECT * FROM cart_items 
ORDER BY price DESC;

-- 2.6: Cập nhật giá của một sản phẩm (cập nhật giá của sản phẩm có id = 1)
UPDATE cart_items 
SET price = 180000.00 
WHERE id = 1;

-- Kiểm tra lại sau khi cập nhật giá
SELECT * FROM cart_items WHERE id = 1;

-- 2.7: Cập nhật số lượng của một sản phẩm (cập nhật số lượng của sản phẩm có id = 2)
UPDATE cart_items 
SET quantity = 5 
WHERE id = 2;

-- Kiểm tra lại sau khi cập nhật số lượng
SELECT * FROM cart_items WHERE id = 2;

-- 2.8: Xóa một sản phẩm (xóa sản phẩm có id = 6)
DELETE FROM cart_items 
WHERE id = 6;

-- Kiểm tra lại danh sách sản phẩm sau khi xóa
SELECT * FROM cart_items;

-- 2.9: Hiển thị tên sản phẩm, giá, số lượng và thành tiền (price * quantity)
SELECT 
    name AS ten_san_pham,
    price AS don_gia,
    quantity AS so_luong,
    (price * quantity) AS thanh_tien
FROM cart_items;

-- 2.10: Tính tổng tiền của toàn bộ giỏ hàng
SELECT 
    SUM(price * quantity) AS tong_tien_gio_hang
FROM cart_items;



-- PHẦN II: BÀI 2 – QUẢN LÝ VÉ XEM PHIM

-- Tạo database cinema_db và chuyển sang sử dụng database này
CREATE DATABASE IF NOT EXISTS cinema_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cinema_db;

-- Tạo bảng movies
DROP TABLE IF EXISTS movies;
CREATE TABLE movies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    total_seats INT NOT NULL,
    available_seats INT NOT NULL
);

-- 2. Thực hiện các yêu cầu:

-- 2.1: Thêm ít nhất 5 bộ phim
INSERT INTO movies (title, price, total_seats, available_seats) VALUES
('Mai', 120000.00, 100, 20),
('Dune: Hành Tinh Cát - Phần 2', 150000.00, 150, 40),
('Kung Fu Panda 4', 90000.00, 100, 65),
('Godzilla x Kong: Đế Chế Mới', 110000.00, 180, 55),
('Lật Mặt 7: Một Điều Ước', 95000.00, 120, 25),
('Exhuma: Quật Mộ Trùng Ma', 130000.00, 90, 15);

-- 2.2: Hiển thị toàn bộ danh sách phim
SELECT * FROM movies;

-- 2.3: Hiển thị phim có giá vé lớn hơn 100000
SELECT * FROM movies 
WHERE price > 100000;

-- 2.4: Hiển thị phim còn nhiều hơn 50 ghế (available_seats > 50)
SELECT * FROM movies 
WHERE available_seats > 50;

-- 2.5: Sắp xếp phim theo giá vé giảm dần
SELECT * FROM movies 
ORDER BY price DESC;

-- 2.6: Cập nhật số ghế còn lại của một phim (cập nhật phim có id = 1)
UPDATE movies 
SET available_seats = 10 
WHERE id = 1;

-- Kiểm tra lại sau khi cập nhật số ghế
SELECT * FROM movies WHERE id = 1;

-- 2.7: Xóa một phim (xóa phim có id = 6)
DELETE FROM movies 
WHERE id = 6;

-- Kiểm tra lại danh sách phim sau khi xóa
SELECT * FROM movies;

-- 2.8: Hiển thị số vé đã bán của từng phim: total_seats - available_seats
SELECT 
    id,
    title AS ten_phim,
    total_seats AS tong_so_ghe,
    available_seats AS so_ghe_con_lai,
    (total_seats - available_seats) AS so_ve_da_ban
FROM movies;

-- 2.9: Tính doanh thu của từng phim: (total_seats - available_seats) * price
SELECT 
    id,
    title AS ten_phim,
    price AS gia_ve,
    (total_seats - available_seats) AS so_ve_da_ban,
    ((total_seats - available_seats) * price) AS doanh_thu
FROM movies;

-- 2.10: Tính tổng doanh thu của tất cả các phim
SELECT 
    SUM((total_seats - available_seats) * price) AS tong_doanh_thu_tat_ca_phim
FROM movies;

-- 2.11: Tìm phim có số vé bán ra nhiều nhất
SELECT 
    id,
    title AS ten_phim,
    total_seats AS tong_so_ghe,
    available_seats AS so_ghe_con_lai,
    (total_seats - available_seats) AS so_ve_da_ban
FROM movies
WHERE (total_seats - available_seats) = (
    SELECT MAX(total_seats - available_seats) FROM movies
);
