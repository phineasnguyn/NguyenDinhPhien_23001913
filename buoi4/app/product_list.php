<?php
/**
 * Danh sách sản phẩm
 * Bài thực hành Buổi 4 - Quản lý giỏ hàng
 * Sinh viên: Nguyễn Đình Phiên - MSV: 23001913
 */

require_once __DIR__ . '/common/auth.php';

// Kiểm soát truy cập: Chỉ người dùng đã đăng nhập mới được truy cập
requireLogin();

require_once __DIR__ . '/model/product.php';

// Lấy toàn bộ danh sách sản phẩm
$products = getAllProducts();

$pageTitle = 'Danh sách sản phẩm';
require_once __DIR__ . '/view/header.php';
?>

<div class="card">
    <div class="card-title">
        <span>📦 DANH SÁCH SẢN PHẨM</span>
        <a href="product_add.php" class="btn btn-primary">+ Thêm sản phẩm mới</a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width: 80px;" class="text-center">ID</th>
                    <th>Tên sản phẩm</th>
                    <th style="width: 160px;" class="text-right">Giá (VNĐ)</th>
                    <th style="width: 120px;" class="text-center">Số lượng</th>
                    <th style="width: 160px;" class="text-center">Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $item): ?>
                        <tr>
                            <td class="text-center"><?= htmlspecialchars($item['id']) ?></td>
                            <td><strong><?= htmlspecialchars($item['name']) ?></strong></td>
                            <td class="text-right"><?= number_format($item['price'], 0, ',', '.') ?> đ</td>
                            <td class="text-center"><?= htmlspecialchars($item['quantity']) ?></td>
                            <td class="text-center">
                                <a href="product_edit.php?id=<?= urlencode($item['id']) ?>" class="action-link action-edit">Sửa</a>
                                <a href="product_delete.php?id=<?= urlencode($item['id']) ?>&confirm=1" 
                                   class="action-link action-delete"
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm \'<?= htmlspecialchars(addslashes($item['name'])) ?>\' không?');">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center" style="padding: 2rem; color: var(--text-muted);">
                            Chưa có sản phẩm nào trong hệ thống. <a href="product_add.php">Bấm vào đây để thêm sản phẩm mới</a>.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once __DIR__ . '/view/footer.php';
?>
