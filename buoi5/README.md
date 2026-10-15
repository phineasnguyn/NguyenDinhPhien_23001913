# BÀI THỰC HÀNH BUỔI 5: PHP + MYSQL – QUẢN LÝ GIỎ HÀNG

- **Sinh viên:** Nguyễn Đình Phiên
- **Mã sinh viên:** 23001913
- **Email:** 23001913@hus.edu.vn
- **Trường:** Trường Đại học Khoa học Tự nhiên - ĐHQGHN (HUS)

---

## 1. Cấu trúc thư mục dự án

```text
buoi5/
├── app/
│   ├── common/
│   │   ├── auth.php              # Kiểm soát phiên làm việc (Session) & chặn truy cập trái phép
│   │   └── dbConnect.php         # Kết nối MySQL bằng PDO, xử lý lỗi kết nối
│   ├── model/
│   │   ├── product.php           # 5 hàm thao tác dữ liệu bảng products (getAll, getById, add, update, delete)
│   │   └── user.php              # Thao tác dữ liệu bảng users (getUser, checkExists, create)
│   ├── view/
│   │   ├── header.php            # Phần đầu trang HTML, thanh điều hướng, hiển thị user & thông báo flash
│   │   └── footer.php            # Phần cuối trang HTML, bản quyền sinh viên
│   ├── assets/
│   │   └── css/
│   │       └── style.css         # Định dạng giao diện chuẩn mực, rõ ràng, thẩm mỹ
│   ├── index.php                 # Điều hướng vào trang sản phẩm (nếu đã login) hoặc login
│   ├── login.php                 # Đăng nhập hệ thống (password_verify, $_SESSION)
│   ├── register.php              # Đăng ký tài khoản mới (password_hash)
│   ├── logout.php                # Đăng xuất và hủy session
│   ├── product_list.php          # Hiển thị danh sách sản phẩm [Sửa] [Xóa]
│   ├── product_add.php           # Thêm sản phẩm (Validate: tên không rỗng, giá > 0, số lượng >= 0)
│   ├── product_edit.php          # Sửa sản phẩm hiện có
│   └── product_delete.php        # Xóa sản phẩm theo ID (Có xác nhận & thông báo khi không tồn tại)
├── index.php                     # Chuyển hướng tự động vào app/index.php
├── shopping_cart.sql             # Script SQL tạo database, bảng products, users và dữ liệu mẫu
├── buoi5.sql                     # Bản sao file SQL đồng bộ tên buổi học
└── README.md                     # Tài liệu hướng dẫn sử dụng và báo cáo
```

---

## 2. Hướng dẫn cài đặt & Khởi chạy

### Bước 1: Khởi động Apache và MySQL
- Mở **XAMPP** hoặc **Laragon**, nhấn **Start** cho cả hai dịch vụ **Apache** và **MySQL**.

### Bước 2: Import Cơ sở dữ liệu
- Mở trình duyệt và truy cập vào **phpMyAdmin** (`http://localhost/phpmyadmin`).
- Chọn thẻ **Import** (Nhập).
- Chọn file `shopping_cart.sql` (hoặc `buoi5.sql`) nằm trong thư mục `buoi5/`.
- Nhấn **Import** / **Thực hiện**.
- Script sẽ tự động:
  - Tạo database `shopping_cart` (hỗ trợ `utf8mb4`).
  - Tạo bảng `products` và nạp sẵn 6 sản phẩm mẫu.
  - Tạo bảng `users` và nạp sẵn 2 tài khoản mẫu đã được mã hóa bằng `password_hash()`.

### Bước 3: Truy cập ứng dụng trên trình duyệt
Mở trình duyệt web và truy cập đường dẫn:
```text
http://localhost/THWeb/buoi5/
```
hoặc:
```text
http://localhost/THWeb/buoi5/app/
```

---

## 3. Tài khoản mẫu đăng nhập

Hệ thống đã được nạp sẵn 2 tài khoản mẫu trong cơ sở dữ liệu:

| Tên đăng nhập (`username`) | Mật khẩu (`password`) | Trạng thái mật khẩu |
| :--- | :--- | :--- |
| `admin` | `admin123` | Đã mã hóa bằng `password_hash()` |
| `phien23001913` | `123456` | Đã mã hóa bằng `password_hash()` |

*Bạn cũng có thể vào trang Đăng ký (`register.php`) để tạo thêm tài khoản mới bất kỳ.*

---

## 4. Chi tiết các chức năng đã xây dựng theo yêu cầu đề bài

### I. Database (`shopping_cart.sql`)
1. **Bảng `products`**:
   - `id`: INT PRIMARY KEY, AUTO_INCREMENT
   - `name`: VARCHAR(100) NOT NULL
   - `price`: DECIMAL(10,2) NOT NULL
   - `quantity`: INT NOT NULL
   - Đã nạp sẵn 6 sản phẩm phong phú.
2. **Bảng `users`**:
   - `id`: INT PRIMARY KEY, AUTO_INCREMENT
   - `username`: VARCHAR(50) NOT NULL UNIQUE
   - `password`: VARCHAR(255) NOT NULL
   - Mật khẩu lưu dưới dạng mã hóa Bcrypt (`password_hash()`), không lưu văn bản thuần.

### II. Kết nối Database (`common/dbConnect.php`)
- Sử dụng **PDO** hiện đại, an toàn chống tấn công SQL Injection.
- Cấu hình bắt lỗi ngoại lệ `PDO::ERRMODE_EXCEPTION`.
- Bắt lỗi trong khối `try - catch`, hiển thị thông báo hướng dẫn rõ ràng nếu kết nối thất bại.

### III. Model Product (`model/product.php`)
Xây dựng đầy đủ 5 hàm theo đúng đề bài:
1. `getAllProducts()`: Truy vấn danh sách toàn bộ sản phẩm.
2. `getProductById($id)`: Tìm sản phẩm theo ID bằng Prepared Statement.
3. `addProduct($name, $price, $quantity)`: Thêm mới sản phẩm an toàn.
4. `updateProduct($id, $name, $price, $quantity)`: Cập nhật thông tin sản phẩm.
5. `deleteProduct($id)`: Xóa sản phẩm khỏi database.

### IV. Các trang quản lý sản phẩm
1. **Danh sách sản phẩm (`product_list.php`)**:
   - Hiển thị bảng dữ liệu: `ID | Tên sản phẩm | Giá | Số lượng | Chức năng`.
   - Mỗi sản phẩm có đầy đủ 2 nút: `[Sửa]` và `[Xóa]`.
   - Định dạng giá tiền VNĐ rõ ràng, dễ nhìn.
2. **Thêm sản phẩm (`product_add.php`)**:
   - Form nhập: Tên sản phẩm, Giá, Số lượng.
   - Kiểm tra dữ liệu hợp lệ:
     - Tên sản phẩm không được rỗng.
     - Giá > 0.
     - Số lượng >= 0.
   - Giữ lại dữ liệu đã nhập khi gặp lỗi nhập liệu.
3. **Sửa sản phẩm (`product_edit.php`)**:
   - Hiển thị thông tin hiện tại của sản phẩm lên form.
   - Kiểm tra tồn tại của sản phẩm và kiểm tra dữ liệu trước khi cập nhật.
4. **Xóa sản phẩm (`product_delete.php`)**:
   - Xóa sản phẩm theo ID.
   - Có hộp thoại xác nhận trước khi xóa (cả JavaScript confirm lẫn trang xác nhận HTML).
   - Nếu sản phẩm không tồn tại, hiển thị thông báo lỗi rõ ràng.

### V. Đăng ký, Đăng nhập, Đăng xuất & Kiểm soát truy cập
1. **Đăng ký (`register.php`)**:
   - Kiểm tra các trường không được để trống.
   - Kiểm tra tên đăng nhập chưa tồn tại trong cơ sở dữ liệu.
   - Sử dụng `password_hash()` để mã hóa mật khẩu trước khi lưu.
   - Sau khi đăng ký thành công, tự động chuyển về trang `login.php`.
2. **Đăng nhập (`login.php`)**:
   - Kiểm tra tài khoản trong database và dùng `password_verify()` để đối soát mật khẩu.
   - Đăng nhập thành công sẽ lưu thông tin vào `$_SESSION` và chuyển hướng tới `product_list.php`.
   - Báo lỗi nếu sai tên đăng nhập hoặc mật khẩu.
3. **Đăng xuất (`logout.php`)**:
   - Hủy toàn bộ phiên làm việc session và cookie phiên.
   - Chuyển hướng người dùng về `login.php`.
4. **Kiểm soát truy cập (`common/auth.php`)**:
   - Chặn người dùng chưa đăng nhập truy cập vào các trang quản lý sản phẩm (`product_list.php`, `product_add.php`, `product_edit.php`, `product_delete.php`).
   - Tự động chuyển hướng về `login.php` nếu chưa đăng nhập.
   - Hiển thị lời chào kèm tên tài khoản đang đăng nhập và liên kết Đăng xuất trên thanh điều hướng.
