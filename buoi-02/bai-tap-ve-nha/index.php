<?php

$danhSachBaiViet = [];
$thongBaoLoi = '';

function xacDinhTrangThai($noiDung)
{
    if (strlen($noiDung) >= 100) {
        return 'Sẵn sàng đăng';
    }

    return 'Bản nháp';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tieuDe = trim($_POST['tieuDe'] ?? '');
    $chuyenMuc = trim($_POST['chuyenMuc'] ?? '');
    $tacGia = trim($_POST['tacGia'] ?? '');
    $noiDung = trim($_POST['noiDung'] ?? '');

    if ($tieuDe === '' || $chuyenMuc === '' || $tacGia === '' || $noiDung === '') {
        $thongBaoLoi = 'Vui lòng nhập đầy đủ thông tin.';
    } else {
        $baiViet = [
            'tieuDe' => $tieuDe,
            'chuyenMuc' => $chuyenMuc,
            'tacGia' => $tacGia,
            'noiDung' => $noiDung,
            'trangThai' => xacDinhTrangThai($noiDung)
        ];

        $danhSachBaiViet[] = $baiViet;
    }
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý bài viết</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 30px auto;
            padding: 0 16px;
            color: #222;
        }

        form {
            display: grid;
            gap: 12px;
            padding: 20px;
            background: #f3f3f3;
            border-radius: 8px;
        }

        input, select, textarea, button {
            padding: 10px;
            font: inherit;
        }

        textarea {
            min-height: 120px;
        }

        button {
            width: 150px;
            color: white;
            background: #1565c0;
            border: 0;
            border-radius: 5px;
            cursor: pointer;
        }

        .loi {
            color: #c62828;
        }

        table {
            width: 100%;
            margin-top: 24px;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #bbb;
            text-align: left;
        }

        th {
            background: #e3f2fd;
        }
    </style>
</head>
<body>
    <h1>Nhập thông tin bài viết</h1>

    <?php if ($thongBaoLoi !== ''): ?>
        <p class="loi"><?= htmlspecialchars($thongBaoLoi) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="tieuDe">Tiêu đề</label>
        <input id="tieuDe" type="text" name="tieuDe" required>

        <label for="chuyenMuc">Chuyên mục</label>
        <select id="chuyenMuc" name="chuyenMuc" required>
            <option value="">-- Chọn chuyên mục --</option>
            <option value="Tin tức">Tin tức</option>
            <option value="Công nghệ">Công nghệ</option>
            <option value="Đời sống">Đời sống</option>
            <option value="Giáo dục">Giáo dục</option>
        </select>

        <label for="tacGia">Tác giả</label>
        <input id="tacGia" type="text" name="tacGia" required>

        <label for="noiDung">Nội dung</label>
        <textarea id="noiDung" name="noiDung" required></textarea>

        <button type="submit">Thêm bài viết</button>
    </form>

    <?php if (count($danhSachBaiViet) > 0): ?>
        <h2>Danh sách bài viết</h2>

        <table>
            <tr>
                <th>Tiêu đề</th>
                <th>Chuyên mục</th>
                <th>Tác giả</th>
                <th>Trạng thái</th>
            </tr>

            <?php foreach ($danhSachBaiViet as $baiViet): ?>
                <tr>
                    <td><?= htmlspecialchars($baiViet['tieuDe']) ?></td>
                    <td><?= htmlspecialchars($baiViet['chuyenMuc']) ?></td>
                    <td><?= htmlspecialchars($baiViet['tacGia']) ?></td>
                    <td><?= htmlspecialchars($baiViet['trangThai']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
