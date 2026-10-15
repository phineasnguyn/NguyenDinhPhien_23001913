<?php
/**
 * Kết nối cơ sở dữ liệu MySQL sử dụng PDO
 * Bài thực hành Buổi 5 - Quản lý giỏ hàng
 * Sinh viên: Nguyễn Đình Phiên - MSV: 23001913
 */

$host = 'localhost';
$dbname = 'shopping_cart';
$username = 'root';
$password = ''; // Mặc định trong XAMPP / Laragon là rỗng
$charset = 'utf8mb4';

$dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    // Xử lý trường hợp kết nối thất bại
    die('<div style="color:red; font-family:sans-serif; padding:20px; border:1px solid red; background:#fee;">' .
        '<strong>Lỗi kết nối cơ sở dữ liệu:</strong> ' . htmlspecialchars($e->getMessage()) . 
        '<br>Vui lòng đảm bảo dịch vụ MySQL đang chạy và database <code>shopping_cart</code> đã được import từ file <code>shopping_cart.sql</code>.' .
        '</div>');
}

if (!function_exists('getDBConnection')) {
    /**
     * Hàm lấy đối tượng kết nối PDO
     * @return PDO
     */
    function getDBConnection() {
        global $pdo;
        return $pdo;
    }
}
