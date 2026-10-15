<?php
/**
 * Chức năng đăng ký tài khoản
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
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Kiểm tra các trường không được để trống
    if (empty($username) || empty($password)) {
        $errorMessage = 'Vui lòng không để trống tên đăng nhập và mật khẩu!';
    } elseif (mb_strlen($username) < 3 || mb_strlen($username) > 50) {
        $errorMessage = 'Tên đăng nhập phải có độ dài từ 3 đến 50 ký tự!';
    } elseif (!empty($confirmPassword) && $password !== $confirmPassword) {
        $errorMessage = 'Mật khẩu xác nhận không khớp!';
    } else {
        // Kiểm tra tên đăng nhập chưa tồn tại trong database
        if (checkUsernameExists($username)) {
            $errorMessage = 'Tên đăng nhập đã tồn tại trong hệ thống. Vui lòng chọn tên khác!';
        } else {
            // Sử dụng password_hash() để mã hóa mật khẩu trước khi lưu vào database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Lưu người dùng mới vào database
            if (createUser($username, $hashedPassword)) {
                // Thông báo kết quả đăng ký. Nếu thành công, chuyển đến trang đăng nhập
                $_SESSION['flash_success'] = 'Đăng ký tài khoản thành công! Vui lòng đăng nhập.';
                header('Location: login.php');
                exit;
            } else {
                $errorMessage = 'Có lỗi xảy ra trong quá trình đăng ký, vui lòng thử lại!';
            }
        }
    }
}

$pageTitle = 'Đăng ký tài khoản';
require_once __DIR__ . '/view/header.php';
?>

<div class="auth-wrapper">
    <div class="card">
        <h2 class="card-title text-center" style="display:block; text-align:center;">ĐĂNG KÝ TÀI KHOẢN</h2>

        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($errorMessage) ?>
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($username) ?>" required autofocus placeholder="Chọn tên đăng nhập (tối thiểu 3 ký tự)...">
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu...">
            </div>

            <div class="form-group">
                <label for="confirm_password">Xác nhận mật khẩu:</label>
                <input type="password" id="confirm_password" name="confirm_password" required placeholder="Nhập lại mật khẩu...">
            </div>

            <div class="form-actions" style="margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Đăng ký</button>
            </div>
        </form>

        <div class="auth-footer-link">
            Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/view/footer.php';
?>
