<?php

$thongBao = '';
$loaiThongBao = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $matKhau = $_POST['matKhau'] ?? '';

    if ($email === 'admin@storyhub.vn' && $matKhau === 'Admin@123') {
        $thongBao = 'Đăng nhập thành công.';
        $loaiThongBao = 'success';
    } else {
        $thongBao = 'Email hoặc mật khẩu không chính xác.';
        $loaiThongBao = 'error';
    }
}

?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form đăng nhập</title>
</head>
<body>
    <h1>Form đăng nhập</h1>

    <?php if ($thongBao !== ''): ?>
        <p class="<?= $loaiThongBao ?>"><?= $thongBao ?></p>
    <?php endif; ?>

    <form method="POST">
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" required>
        </div>

        <div>
            <label for="matKhau">Mật khẩu</label>
            <input id="matKhau" type="password" name="matKhau" required>
        </div>

        <button type="submit">Đăng nhập</button>
    </form>

    <p>Tài khoản thử: admin@storyhub.vn / Admin@123</p>
</body>
</html>
