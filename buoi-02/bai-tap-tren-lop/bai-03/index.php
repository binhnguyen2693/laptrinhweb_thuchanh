<?php

$diem = 7.5;

if ($diem >= 8) {
    echo "Điểm: $diem - Xếp loại: Giỏi";
} elseif ($diem >= 6.5) {
    echo "Điểm: $diem - Xếp loại: Khá";
} elseif ($diem >= 5) {
    echo "Điểm: $diem - Xếp loại: Trung bình";
} else {
    echo "Điểm: $diem - Xếp loại: Chưa đạt";
}

?>
