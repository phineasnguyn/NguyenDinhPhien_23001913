<?php
/**
 * Quản lý phiên đăng nhập và kiểm soát quyền truy cập
 * Bài thực hành Buổi 4 - Quản lý giỏ hàng
 * Sinh viên: Nguyễn Đình Phiên - MSV: 23001913
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!function_exists('isLoggedIn')) {
    /**
     * Kiểm tra xem người dùng đã đăng nhập hay chưa
     * @return bool
     */
    function isLoggedIn() {
        return isset($_SESSION['username']) && !empty($_SESSION['username']);
    }
}

if (!function_exists('requireLogin')) {
    /**
     * Yêu cầu đăng nhập trước khi truy cập trang
     * Nếu chưa đăng nhập, tự động chuyển về login.php
     */
    function requireLogin() {
        if (!isLoggedIn()) {
            header('Location: login.php');
            exit;
        }
    }
}

if (!function_exists('getCurrentUsername')) {
    /**
     * Lấy tên tài khoản hiện tại đang đăng nhập
     * @return string|null
     */
    function getCurrentUsername() {
        return $_SESSION['username'] ?? null;
    }
}
