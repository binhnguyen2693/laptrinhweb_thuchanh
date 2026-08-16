<?php

$students = [
    [
        'name' => 'Lan',
        'midterm' => 7,
        'final' => 8
    ],
    [
        'name' => 'Nam',
        'midterm' => 5,
        'final' => 6
    ],
    [
        'name' => 'An',
        'midterm' => 4,
        'final' => 5
    ]
];

function calculateAverage($midterm, $final)
{
    return ($midterm + $final) / 2;
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bảng điểm sinh viên</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>Tên</th>
            <th>Giữa kỳ</th>
            <th>Cuối kỳ</th>
            <th>Điểm trung bình</th>
            <th>Kết quả</th>
        </tr>

        <?php foreach ($students as $student): ?>
            <?php
            $average = calculateAverage(
                $student['midterm'],
                $student['final']
            );

            $result = $average >= 5 ? 'Đạt' : 'Chưa đạt';
            ?>

            <tr>
                <td><?= htmlspecialchars($student['name']) ?></td>
                <td><?= $student['midterm'] ?></td>
                <td><?= $student['final'] ?></td>
                <td><?= $average ?></td>
                <td><?= $result ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
