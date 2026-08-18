<?php
declare(strict_types=1);

$thuMucSession = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'ltweb_ca_nhan_sessions';

if (!is_dir($thuMucSession) && !mkdir($thuMucSession, 0775, true)) {
    exit('Không thể tạo thư mục lưu session.');
}

session_save_path($thuMucSession);
session_start();

$email = '';
$loi = [];
$thongBaoThanhCong = '';
$nguoiDungDangNhap = $_SESSION['dangNhapCaNhan'] ?? null;

$taiKhoanMau = [
    'email' => 'admin@storyhub.vn',
    'matKhauHash' => '$2y$10$5qOBuv285ychc3kts46L7OsmFyodolU33/K0T8QAo3dczDCzkqFga',
    'hoTen' => 'Quản trị viên StoryHub',
];

function hienThiAnToan(string $giaTri): string
{
    return htmlspecialchars($giaTri, ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hanhDong = $_POST['hanhDong'] ?? 'dangNhap';

    if ($hanhDong === 'dangXuat') {
        unset($_SESSION['dangNhapCaNhan']);
        $nguoiDungDangNhap = null;
        $thongBaoThanhCong = 'Bạn đã đăng xuất.';
    } else {
        $email = strtolower(trim($_POST['email'] ?? ''));
        $matKhau = $_POST['matKhau'] ?? '';

        if ($email === '') {
            $loi['email'] = 'Vui lòng nhập email.';
        } elseif (mb_strlen($email, 'UTF-8') > 254) {
            $loi['email'] = 'Email không được vượt quá 254 ký tự.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $loi['email'] = 'Email không đúng định dạng.';
        }

        if ($matKhau === '') {
            $loi['matKhau'] = 'Vui lòng nhập mật khẩu.';
        } elseif (strlen($matKhau) < 8 || strlen($matKhau) > 72) {
            $loi['matKhau'] = 'Mật khẩu phải có từ 8 đến 72 ký tự.';
        }

        if (count($loi) === 0) {
            $emailDung = hash_equals($taiKhoanMau['email'], $email);
            $matKhauDung = password_verify($matKhau, $taiKhoanMau['matKhauHash']);

            if (!$emailDung || !$matKhauDung) {
                $loi['dangNhap'] = 'Email hoặc mật khẩu không chính xác.';
            } else {
                session_regenerate_id(true);

                $_SESSION['dangNhapCaNhan'] = [
                    'email' => $taiKhoanMau['email'],
                    'hoTen' => $taiKhoanMau['hoTen'],
                ];

                $nguoiDungDangNhap = $_SESSION['dangNhapCaNhan'];
                $thongBaoThanhCong = 'Đăng nhập thành công.';
                $email = '';
            }
        }
    }
}
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập an toàn</title>
    <link rel="stylesheet" href="dang-nhap-an-toan.css">
</head>
<body>
    <main class="login-page">
        <section class="login-card">
            <div class="login-heading">
                <h1>Đăng nhập quản trị</h1>
                <p>Form đăng nhập an toàn cho website tin tức/blog.</p>
            </div>

            <?php if ($thongBaoThanhCong !== ''): ?>
                <div class="message success">
                    <?= hienThiAnToan($thongBaoThanhCong) ?>
                </div>
            <?php endif; ?>

            <?php if ($nguoiDungDangNhap !== null): ?>
                <div class="account-box">
                    <h2>Đã đăng nhập</h2>
                    <p><strong>Họ tên:</strong> <?= hienThiAnToan($nguoiDungDangNhap['hoTen']) ?></p>
                    <p><strong>Email:</strong> <?= hienThiAnToan($nguoiDungDangNhap['email']) ?></p>

                    <form method="POST">
                        <input type="hidden" name="hanhDong" value="dangXuat">
                        <button type="submit" class="logout-button">Đăng xuất</button>
                    </form>
                </div>
            <?php else: ?>
                <?php if (isset($loi['dangNhap'])): ?>
                    <div class="message error-message">
                        <?= hienThiAnToan($loi['dangNhap']) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" class="login-form" novalidate>
                    <input type="hidden" name="hanhDong" value="dangNhap">

                    <div class="form-group">
                        <label for="email">Email <span>*</span></label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            maxlength="254"
                            value="<?= hienThiAnToan($email) ?>"
                            placeholder="admin@storyhub.vn"
                            autocomplete="email"
                            aria-invalid="<?= isset($loi['email']) ? 'true' : 'false' ?>"
                        >
                        <?php if (isset($loi['email'])): ?>
                            <small class="error"><?= hienThiAnToan($loi['email']) ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="matKhau">Mật khẩu <span>*</span></label>
                        <input
                            id="matKhau"
                            type="password"
                            name="matKhau"
                            minlength="8"
                            maxlength="72"
                            placeholder="Nhập mật khẩu"
                            autocomplete="current-password"
                            aria-invalid="<?= isset($loi['matKhau']) ? 'true' : 'false' ?>"
                        >
                        <?php if (isset($loi['matKhau'])): ?>
                            <small class="error"><?= hienThiAnToan($loi['matKhau']) ?></small>
                        <?php endif; ?>
                    </div>

                    <p class="required-note">Các trường có dấu * là bắt buộc.</p>
                    <button type="submit">Đăng nhập</button>
                </form>

                <div class="demo-account">
                    <strong>Tài khoản thử nghiệm</strong>
                    <span>Email: admin@storyhub.vn</span>
                    <span>Mật khẩu: Admin@123</span>
                </div>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
