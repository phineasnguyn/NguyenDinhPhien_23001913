# Bài Thực Hành Buổi 3 - Thực Hành MySQL

**Sinh viên:** Nguyễn Đình Phiên  
**Mã sinh viên:** 23001913  
**Môn học:** Thực hành Phát triển Ứng dụng Web  

---

## Danh mục tài liệu trong thư mục
- `buoi3.sql`: Toàn bộ câu lệnh SQL thực hiện đầy đủ các yêu cầu của Bài 1 và Bài 2.
- `Bài thực hành buổi 3 - MYSQL.pdf`: Đề bài thực hành chi tiết.

---

## Tóm tắt nội dung bài làm

### Bài 1 – Quản lý giỏ hàng
* **Database:** `shopping_cart`
* **Bảng:** `cart_items` (`id`, `name`, `price`, `quantity`)
* **Các câu lệnh đã thực hiện:**
  1. Thêm 6 sản phẩm mẫu vào bảng.
  2. Hiển thị toàn bộ sản phẩm trong giỏ hàng.
  3. Lọc danh sách sản phẩm có giá lớn hơn `100000`.
  4. Lọc danh sách sản phẩm có số lượng lớn hơn `5`.
  5. Sắp xếp danh sách sản phẩm theo giá giảm dần (`ORDER BY price DESC`).
  6. Cập nhật giá của sản phẩm (`UPDATE ... SET price = ... WHERE id = 1`).
  7. Cập nhật số lượng của sản phẩm (`UPDATE ... SET quantity = ... WHERE id = 2`).
  8. Xóa sản phẩm (`DELETE FROM cart_items WHERE id = 6`).
  9. Hiển thị tên sản phẩm, giá, số lượng và thành tiền (`price * quantity`).
  10. Tính tổng số tiền của toàn bộ giỏ hàng (`SUM(price * quantity)`).

---

### Bài 2 – Quản lý vé xem phim
* **Database:** `cinema_db`
* **Bảng:** `movies` (`id`, `title`, `price`, `total_seats`, `available_seats`)
* **Các câu lệnh đã thực hiện:**
  1. Thêm 6 bộ phim mẫu vào bảng.
  2. Hiển thị toàn bộ danh sách phim.
  3. Lọc danh sách phim có giá vé lớn hơn `100000`.
  4. Lọc danh sách phim còn nhiều hơn `50` ghế (`available_seats > 50`).
  5. Sắp xếp phim theo giá vé giảm dần (`ORDER BY price DESC`).
  6. Cập nhật số ghế còn lại của một bộ phim (`UPDATE ... SET available_seats = ... WHERE id = 1`).
  7. Xóa một bộ phim khỏi bảng (`DELETE FROM movies WHERE id = 6`).
  8. Hiển thị số vé đã bán của từng phim: `total_seats - available_seats`.
  9. Tính doanh thu của từng phim: `(total_seats - available_seats) * price`.
  10. Tính tổng doanh thu của tất cả các phim (`SUM((total_seats - available_seats) * price)`).
  11. Tìm phim có số vé bán ra nhiều nhất (sử dụng Subquery kết hợp hàm `MAX(...)` theo đúng yêu cầu đề bài).

---

## Hướng dẫn thực thi script SQL
1. Mở công cụ quản trị MySQL (MySQL Workbench, phpMyAdmin, hoặc MySQL CLI).
2. Mở file `buoi3.sql` và thực thi toàn bộ script hoặc từng khối lệnh tương ứng.
