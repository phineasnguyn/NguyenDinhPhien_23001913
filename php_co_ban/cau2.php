<?php
header('Content-Type: text/html; charset=utf-8');

// Mang gia cua 5 san pham (don vi: dong).
$prices = [100000, 150000, 200000, 80000, 120000];

// Tinh tong gia tri cua tat ca san pham.
function calculateTotal($prices)
{
    $total = 0;

    foreach ($prices as $price) {
        $total += $price;
    }

    return $total;
}

// Tim gia cao nhat; mang dau vao co it nhat 5 san pham theo de bai.
function findMaxPrice($prices)
{
    $maxPrice = $prices[0];

    foreach ($prices as $price) {
        if ($price > $maxPrice) {
            $maxPrice = $price;
        }
    }

    return $maxPrice;
}

$total = calculateTotal($prices);
$maxPrice = findMaxPrice($prices);

echo "Tổng giá trị sản phẩm: " . $total . " đồng<br>";
echo "Giá sản phẩm cao nhất: " . $maxPrice . " đồng";
