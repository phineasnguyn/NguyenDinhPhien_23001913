<?php
/**
 * Thêm sản phẩm mới
 * Bài thực hành Buổi 5 - Quản lý giỏ hàng
 * Sinh viên: Nguyễn Đình Phiên - MSV: 23001913
 */

require_once __DIR__ . '/common/auth.php';

// Kiểm soát truy cập: Chỉ người dùng đã đăng nhập mới được truy cập
requireLogin();

require_once __DIR__ . '/model/product.php';

$errors = [];
$name = '';
$price = '';
$quantity = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $quantity = trim($_POST['quantity'] ?? '');

    // 1. Kiểm tra: Tên không được rỗng
    if (empty($name)) {
        $errors[] = 'Tên sản phẩm không được để rỗng!';
    }

    // 2. Kiểm tra: Giá > 0
    if ($price === '' || !is_numeric($price) || (float)$price <= 0) {
        $errors[] = 'Giá sản phẩm phải là số lớn hơn 0!';
    }

    // 3. Kiểm tra: Số lượng >= 0
    if ($quantity === '' || !is_numeric($quantity) || (int)$quantity < 0 || (int)$quantity != (float)$quantity) {
        $errors[] = 'Số lượng sản phẩm phải là số nguyên lớn hơn hoặc bằng 0!';
    }

    // Nếu không có lỗi, tiến hành thêm sản phẩm vào database
    if (empty($errors)) {
        if (addProduct($name, (float)$price, (int)$quantity)) {
            $_SESSION['flash_success'] = 'Thêm sản phẩm "' . $name . '" thành công!';
            header('Location: product_list.php');
            exit;
        } else {
            $errors[] = 'Có lỗi xảy ra khi lưu vào cơ sở dữ liệu. Vui lòng thử lại!';
        }
    }
}

$pageTitle = 'Thêm sản phẩm mới';
require_once __DIR__ . '/view/header.php';
?>

<div style="max-width: 600px; margin: 0 auto;">
    <div class="card">
        <div class="card-title">
            <span>➕ THÊM SẢN PHẨM MỚI</span>
            <a href="product_list.php" class="btn btn-secondary">Quay lại danh sách</a>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <strong>Vui lòng kiểm tra lại các lỗi sau:</strong>
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="product_add.php" method="POST">
            <div class="form-group">
                <label for="name">Tên sản phẩm: <span style="color:red;">*</span></label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required placeholder="Ví dụ: Bàn phím cơ DareU...">
            </div>

            <div class="form-group">
                <label for="price">Giá (VNĐ): <span style="color:red;">*</span></label>
                <input type="number" id="price" name="price" step="0.01" min="0.01" value="<?= htmlspecialchars($price) ?>" required placeholder="Ví dụ: 350000">
            </div>

            <div class="form-group">
                <label for="quantity">Số lượng: <span style="color:red;">*</span></label>
                <input type="number" id="quantity" name="quantity" min="0" step="1" value="<?= htmlspecialchars($quantity) ?>" required placeholder="Ví dụ: 10">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Lưu sản phẩm</button>
                <a href="product_list.php" class="btn btn-secondary">Hủy bỏ</a>
            </div>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/view/footer.php';
?>
