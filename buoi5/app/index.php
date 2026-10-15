<?php
/**
 * Trang chủ - Điều hướng người dùng
 * Bài thực hành Buổi 5 - Quản lý giỏ hàng
 * Sinh viên: Nguyễn Đình Phiên - MSV: 23001913
 */

require_once __DIR__ . '/common/auth.php';

if (isLoggedIn()) {
    header('Location: product_list.php');
} else {
    header('Location: login.php');
}
exit;
