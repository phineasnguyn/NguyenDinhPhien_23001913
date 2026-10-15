<?php
/**
 * Model Product - Quản lý các thao tác dữ liệu với bảng products
 * Bài thực hành Buổi 4 - Quản lý giỏ hàng
 * Sinh viên: Nguyễn Đình Phiên - MSV: 23001913
 */

require_once __DIR__ . '/../common/dbConnect.php';

if (!function_exists('getAllProducts')) {
    /**
     * Lấy toàn bộ danh sách sản phẩm từ bảng products
     * @return array
     */
    function getAllProducts() {
        $pdo = getDBConnection();
        $sql = "SELECT * FROM products ORDER BY id ASC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }
}

if (!function_exists('getProductById')) {
    /**
     * Lấy thông tin một sản phẩm theo ID
     * @param int $id
     * @return array|false Trả về mảng thông tin sản phẩm hoặc false nếu không tìm thấy
     */
    function getProductById($id) {
        $pdo = getDBConnection();
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}

if (!function_exists('addProduct')) {
    /**
     * Thêm một sản phẩm mới vào bảng products
     * @param string $name Tên sản phẩm
     * @param float|string $price Giá sản phẩm
     * @param int $quantity Số lượng
     * @return bool Trả về true nếu thêm thành công, false nếu thất bại
     */
    function addProduct($name, $price, $quantity) {
        $pdo = getDBConnection();
        $sql = "INSERT INTO products (name, price, quantity) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$name, $price, $quantity]);
    }
}

if (!function_exists('updateProduct')) {
    /**
     * Cập nhật thông tin sản phẩm theo ID
     * @param int $id ID sản phẩm cần cập nhật
     * @param string $name Tên sản phẩm mới
     * @param float|string $price Giá mới
     * @param int $quantity Số lượng mới
     * @return bool Trả về true nếu cập nhật thành công, false nếu thất bại
     */
    function updateProduct($id, $name, $price, $quantity) {
        $pdo = getDBConnection();
        $sql = "UPDATE products SET name = ?, price = ?, quantity = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$name, $price, $quantity, $id]);
    }
}

if (!function_exists('deleteProduct')) {
    /**
     * Xóa một sản phẩm theo ID
     * @param int $id ID sản phẩm cần xóa
     * @return bool Trả về true nếu xóa thành công, false nếu thất bại
     */
    function deleteProduct($id) {
        $pdo = getDBConnection();
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
