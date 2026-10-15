<?php
/**
 * Chức năng đăng nhập hệ thống
 * Bài thực hành Buổi 5 - Quản lý giỏ hàng
 * Sinh viên: Nguyễn Đình Phiên - MSV: 23001913
 */

require_once __DIR__ . '/common/auth.php';
require_once __DIR__ . '/model/user.php';

// Nếu đã đăng nhập thì chuyển hướng thẳng tới trang danh sách sản phẩm
if (isLoggedIn()) {
    header('Location: product_list.php');
    exit;
}

$errorMessage = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Kiểm tra các trường không được để trống
    if (empty($username) || empty($password)) {
        $errorMessage = 'Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu!';
    } else {
        // Kiểm tra thông tin đăng nhập với dữ liệu trong bảng users
        $user = getUserByUsername($username);

        // Sử dụng password_verify() để kiểm tra mật khẩu
        if ($user && password_verify($password, $user['password'])) {
            // Đăng nhập thành công, lưu thông tin cần thiết vào $_SESSION
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['flash_success'] = 'Đăng nhập thành công! Chào mừng ' . htmlspecialchars($user['username']) . '.';

            // Chuyển đến product_list.php
            header('Location: product_list.php');
            exit;
        } else {
            // Thông tin không chính xác
            $errorMessage = 'Tên đăng nhập hoặc mật khẩu không chính xác!';
        }
    }
}

$pageTitle = 'Đăng nhập';
require_once __DIR__ . '/view/header.php';
?>

<div class="auth-wrapper">
    <div class="card">
        <h2 class="card-title text-center" style="display:block; text-align:center;">ĐĂNG NHẬP HỆ THỐNG</h2>

        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($errorMessage) ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($username) ?>" required autofocus placeholder="Nhập tên đăng nhập...">
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu...">
            </div>

            <div class="form-actions" style="margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Đăng nhập</button>
            </div>
        </form>

        <div class="auth-footer-link">
            Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a>
        </div>

        <div style="margin-top: 1.25rem; padding: 0.75rem; background: #f1f5f9; border-radius: 6px; font-size: 0.85rem; color: #475569;">
            <strong>Tài khoản mẫu có sẵn trong database:</strong><br>
            • Tài khoản 1: <code>admin</code> / Mật khẩu: <code>admin123</code><br>
            • Tài khoản 2: <code>phien23001913</code> / Mật khẩu: <code>123456</code>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/view/footer.php';
?>
