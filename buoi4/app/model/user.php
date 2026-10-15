<?php
/**
 * Model User - Quản lý các thao tác dữ liệu với bảng users
 * Bài thực hành Buổi 4 - Quản lý giỏ hàng
 * Sinh viên: Nguyễn Đình Phiên - MSV: 23001913
 */

require_once __DIR__ . '/../common/dbConnect.php';

if (!function_exists('getUserByUsername')) {
    /**
     * Lấy thông tin người dùng theo tên đăng nhập
     * @param string $username
     * @return array|false
     */
    function getUserByUsername($username) {
        $pdo = getDBConnection();
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
}

if (!function_exists('checkUsernameExists')) {
    /**
     * Kiểm tra tên đăng nhập đã tồn tại trong database hay chưa
     * @param string $username
     * @return bool
     */
    function checkUsernameExists($username) {
        $user = getUserByUsername($username);
        return !empty($user);
    }
}

if (!function_exists('createUser')) {
    /**
     * Đăng ký người dùng mới với mật khẩu đã hash
     * @param string $username
     * @param string $hashedPassword
     * @return bool
     */
    function createUser($username, $hashedPassword) {
        $pdo = getDBConnection();
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$username, $hashedPassword]);
    }
}
