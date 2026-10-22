<?php
header('Content-Type: text/html; charset=utf-8');

// Khai bao ten va diem cua hoc sinh.
$name = "Nguyễn Đình Phiên";
$score = 7.5;

// Xet diem tu cao xuong thap de xep loai.
if ($score >= 8) {
    $rank = "Giỏi";
} elseif ($score >= 6.5) {
    $rank = "Khá";
} elseif ($score >= 5) {
    $rank = "Trung bình";
} else {
    $rank = "Yếu";
}

echo "Họ tên: " . $name . "<br>";
echo "Điểm: " . $score . "<br>";
echo "Xếp loại: " . $rank;
