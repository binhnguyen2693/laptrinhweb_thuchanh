<?php

$ten = $_GET['ten'] ?? '';
$soLuong = $_GET['soLuong'] ?? '';
$donGia = $_GET['donGia'] ?? '';

if ($ten !== '' && $soLuong !== '' && $donGia !== '') {
    $thanhTien = $soLuong * $donGia;

    echo htmlspecialchars($ten) . ': '
        . number_format($thanhTien, 0, ',', '.') . ' đ';
}

?>

<form method="GET">
    <input type="text" name="ten" placeholder="Tên tài liệu">
    <input type="number" name="soLuong" placeholder="Số lượng">
    <input type="number" name="donGia" placeholder="Đơn giá">
    <button type="submit">Tính</button>
</form>
