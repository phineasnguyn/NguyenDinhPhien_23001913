<?php
/**
 * Header giao diện chung của hệ thống
 * Bài thực hành Buổi 4 - Quản lý giỏ hàng
 * Sinh viên: Nguyễn Đình Phiên - MSV: 23001913
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = $pageTitle ?? 'Quản lý giỏ hàng';
$isLoggedIn = isset($_SESSION['username']) && !empty($_SESSION['username']);
$currentUsername = $_SESSION['username'] ?? '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> - Quản Lý Giỏ Hàng</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="site-header">
        <nav class="navbar">
            <a href="product_list.php" class="brand-logo">
                <span>🛒</span> QUẢN LÝ GIỎ HÀNG
            </a>

            <div class="nav-menu">
                <?php if ($isLoggedIn): ?>
                    <a href="product_list.php" class="nav-link">Danh sách sản phẩm</a>
                    <a href="product_add.php" class="nav-link">+ Thêm sản phẩm</a>
                    <span class="user-greeting">
                        Xin chào, <strong><?= htmlspecialchars($currentUsername) ?></strong>
                    </span>
                    <a href="logout.php" class="btn-logout">Đăng xuất</a>
                <?php else: ?>
                    <a href="login.php" class="nav-link">Đăng nhập</a>
                    <a href="register.php" class="btn btn-primary">Đăng ký</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main class="main-container">
        <?php if (!empty($_SESSION['flash_success'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['flash_success']) ?>
            </div>
            <?php unset($_SESSION['flash_success']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['flash_error'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_SESSION['flash_error']) ?>
            </div>
            <?php unset($_SESSION['flash_error']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['flash_warning'])): ?>
            <div class="alert alert-warning">
                <?= htmlspecialchars($_SESSION['flash_warning']) ?>
            </div>
            <?php unset($_SESSION['flash_warning']); ?>
        <?php endif; ?>
