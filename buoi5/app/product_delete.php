<?php
/**
 * Xóa sản phẩm
 * Bài thực hành Buổi 5 - Quản lý giỏ hàng
 * Sinh viên: Nguyễn Đình Phiên - MSV: 23001913
 */

require_once __DIR__ . '/common/auth.php';

// Kiểm soát truy cập: Chỉ người dùng đã đăng nhập mới được truy cập
requireLogin();

require_once __DIR__ . '/model/product.php';

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

// Kiểm tra xem sản phẩm có tồn tại trong database không
$product = getProductById($id);

// Nếu sản phẩm không tồn tại, hiển thị thông báo phù hợp
if (!$product) {
    $pageTitle = 'Sản phẩm không tồn tại';
    require_once __DIR__ . '/view/header.php';
    ?>
    <div style="max-width: 600px; margin: 0 auto;">
        <div class="card">
            <div class="alert alert-danger">
                <strong>Thông báo:</strong> Sản phẩm có ID = <strong><?= htmlspecialchars($id) ?></strong> không tồn tại trong hệ thống hoặc đã bị xóa trước đó!
            </div>
            <a href="product_list.php" class="btn btn-secondary">Quay lại danh sách sản phẩm</a>
        </div>
    </div>
    <?php
    require_once __DIR__ . '/view/footer.php';
    exit;
}

// Trước khi xóa phải xác nhận:
// Kiểm tra nếu đã được xác nhận (qua POST hoặc tham số confirm=1 trên URL)
$isConfirmed = ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) 
               || (isset($_GET['confirm']) && $_GET['confirm'] === '1');

if ($isConfirmed) {
    // Thực hiện xóa sản phẩm
    if (deleteProduct($id)) {
        $_SESSION['flash_success'] = 'Đã xóa sản phẩm "' . $product['name'] . '" (ID: ' . $id . ') thành công!';
    } else {
        $_SESSION['flash_error'] = 'Có lỗi xảy ra khi xóa sản phẩm. Vui lòng thử lại!';
    }
    header('Location: product_list.php');
    exit;
}

// Trường hợp chưa xác nhận: Hiển thị trang xác nhận xóa
$pageTitle = 'Xác nhận xóa sản phẩm #' . $id;
require_once __DIR__ . '/view/header.php';
?>

<div style="max-width: 600px; margin: 0 auto;">
    <div class="card">
        <div class="card-title">
            <span style="color: var(--danger-color);">⚠️ XÁC NHẬN XÓA SẢN PHẨM</span>
        </div>

        <div class="alert alert-warning">
            Bạn có chắc chắn muốn xóa sản phẩm này khỏi hệ thống? <strong>Thao tác này không thể hoàn tác!</strong>
        </div>

        <div style="background: #f8fafc; border: 1px solid var(--border-color); border-radius: 6px; padding: 1.25rem; margin-bottom: 1.5rem;">
            <p><strong>Mã sản phẩm (ID):</strong> #<?= htmlspecialchars($product['id']) ?></p>
            <p><strong>Tên sản phẩm:</strong> <?= htmlspecialchars($product['name']) ?></p>
            <p><strong>Đơn giá:</strong> <?= number_format($product['price'], 0, ',', '.') ?> đ</p>
            <p><strong>Số lượng trong kho:</strong> <?= htmlspecialchars($product['quantity']) ?></p>
        </div>

        <form action="product_delete.php?id=<?= urlencode($id) ?>" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
            <input type="hidden" name="confirm_delete" value="1">
            <div class="form-actions">
                <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
                <a href="product_list.php" class="btn btn-secondary">Hủy bỏ / Quay lại</a>
            </div>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/view/footer.php';
?>
