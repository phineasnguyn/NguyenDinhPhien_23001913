<?php
/**
 * Sửa sản phẩm
 * Bài thực hành Buổi 5 - Quản lý giỏ hàng
 * Sinh viên: Nguyễn Đình Phiên - MSV: 23001913
 */

require_once __DIR__ . '/common/auth.php';

// Kiểm soát truy cập: Chỉ người dùng đã đăng nhập mới được truy cập
requireLogin();

require_once __DIR__ . '/model/product.php';

$errors = [];

// Lấy id từ GET hoặc POST
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
}

// Kiểm tra ID hợp lệ
if (!$id) {
    $_SESSION['flash_error'] = 'ID sản phẩm không hợp lệ!';
    header('Location: product_list.php');
    exit;
}

// Lấy thông tin hiện tại của sản phẩm
$product = getProductById($id);

if (!$product) {
    $pageTitle = 'Không tìm thấy sản phẩm';
    require_once __DIR__ . '/view/header.php';
    ?>
    <div style="max-width: 600px; margin: 0 auto;">
        <div class="card">
            <div class="alert alert-danger">
                <strong>Lỗi:</strong> Sản phẩm có ID = <?= htmlspecialchars($id) ?> không tồn tại hoặc đã bị xóa!
            </div>
            <a href="product_list.php" class="btn btn-secondary">Quay lại danh sách sản phẩm</a>
        </div>
    </div>
    <?php
    require_once __DIR__ . '/view/footer.php';
    exit;
}

// Giá trị ban đầu hiển thị trên form
$name = $product['name'];
$price = $product['price'];
$quantity = $product['quantity'];

// Xử lý khi submit form cập nhật
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

    // Nếu không có lỗi thì tiến hành cập nhật vào database
    if (empty($errors)) {
        if (updateProduct($id, $name, (float)$price, (int)$quantity)) {
            $_SESSION['flash_success'] = 'Cập nhật sản phẩm "' . $name . '" (ID: ' . $id . ') thành công!';
            header('Location: product_list.php');
            exit;
        } else {
            $errors[] = 'Có lỗi xảy ra khi cập nhật sản phẩm. Vui lòng thử lại!';
        }
    }
}

$pageTitle = 'Sửa sản phẩm #' . $id;
require_once __DIR__ . '/view/header.php';
?>

<div style="max-width: 600px; margin: 0 auto;">
    <div class="card">
        <div class="card-title">
            <span>✏️ CẬP NHẬT SẢN PHẨM #<?= htmlspecialchars($id) ?></span>
            <a href="product_list.php" class="btn btn-secondary">Quay lại</a>
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

        <form action="product_edit.php?id=<?= urlencode($id) ?>" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

            <div class="form-group">
                <label for="name">Tên sản phẩm: <span style="color:red;">*</span></label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required placeholder="Nhập tên sản phẩm...">
            </div>

            <div class="form-group">
                <label for="price">Giá (VNĐ): <span style="color:red;">*</span></label>
                <input type="number" id="price" name="price" step="0.01" min="0.01" value="<?= htmlspecialchars($price) ?>" required placeholder="Nhập giá sản phẩm...">
            </div>

            <div class="form-group">
                <label for="quantity">Số lượng: <span style="color:red;">*</span></label>
                <input type="number" id="quantity" name="quantity" min="0" step="1" value="<?= htmlspecialchars($quantity) ?>" required placeholder="Nhập số lượng...">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                <a href="product_list.php" class="btn btn-secondary">Hủy bỏ</a>
            </div>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/view/footer.php';
?>
