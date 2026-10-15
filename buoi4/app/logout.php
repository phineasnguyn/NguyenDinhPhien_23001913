<?php
/**
 * Chức năng đăng xuất
 * Bài thực hành Buổi 4 - Quản lý giỏ hàng
 * Sinh viên: Nguyễn Đình Phiên - MSV: 23001913
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Xóa toàn bộ thông tin phiên đăng nhập bằng session
$_SESSION = [];

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

// Chuyển người dùng về trang login.php sau khi đăng xuất
header('Location: login.php');
exit;
