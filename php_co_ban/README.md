# Đề tự luận PHP cơ bản

Bài làm hai câu trong đề giấy.

## Câu 1: Xếp loại học sinh (5 điểm)

Tệp: [cau1.php](./cau1.php).

Khai báo `$name`, `$score`, dùng `if...elseif...else` để xếp loại và `echo` để hiển thị:

| Điểm | Xếp loại |
| --- | --- |
| Từ 8 trở lên | Giỏi |
| Từ 6.5 đến dưới 8 | Khá |
| Từ 5 đến dưới 6.5 | Trung bình |
| Dưới 5 | Yếu |

Dữ liệu mẫu: Nguyễn Đình Phiên, điểm 7.5. Kết quả: Khá.
Có thể thay giá trị `$name` và `$score` ở đầu tệp.

## Câu 2: Xử lý mảng và hàm (5 điểm)

Tệp: [cau2.php](./cau2.php).

- Mảng chứa giá của 5 sản phẩm.
- `calculateTotal($prices)`: duyệt mảng bằng `foreach`, cộng dồn và trả về tổng bằng `return`.
- `findMaxPrice($prices)`: lấy giá đầu tiên làm giá lớn nhất tạm thời, duyệt mảng để tìm giá cao hơn và trả về kết quả.
- Gọi hai hàm và dùng `echo` hiển thị tổng cùng giá cao nhất.

Với mảng mẫu `[100000, 150000, 200000, 80000, 120000]`:

- Tổng giá trị sản phẩm: 650000 đồng.
- Giá sản phẩm cao nhất: 200000 đồng.

Theo đề bài, mảng đầu vào phải chứa ít nhất 5 giá sản phẩm.

## Cách chạy

Cần cài PHP. Mở terminal tại thư mục gốc repository và chạy:

```bash
php -S localhost:8000 -t php_co_ban
```

Sau đó mở:

- Câu 1: http://localhost:8000/cau1.php
- Câu 2: http://localhost:8000/cau2.php
