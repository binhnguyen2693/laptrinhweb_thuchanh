<?php

$hoTen = '';
$email = '';
$chuDe = 'Hỗ trợ kỹ thuật';
$noiDung = '';
$loi = [];
$thanhCong = false;

function hienThiAnToan($giaTri)
{
    return htmlspecialchars($giaTri, ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hoTen = trim($_POST['hoTen'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $chuDe = trim($_POST['chuDe'] ?? 'Hỗ trợ kỹ thuật');
    $noiDung = trim($_POST['noiDung'] ?? '');

    if ($hoTen === '') {
        $loi['hoTen'] = 'Vui lòng nhập họ tên.';
    }

    if ($email === '') {
        $loi['email'] = 'Vui lòng nhập email.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $loi['email'] = 'Email không đúng định dạng.';
    }

    if ($noiDung === '') {
        $loi['noiDung'] = 'Vui lòng nhập nội dung liên hệ.';
    }

    if (count($loi) === 0) {
        $thanhCong = true;
        $hoTen = '';
        $email = '';
        $chuDe = 'Hỗ trợ kỹ thuật';
        $noiDung = '';
    }
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form liên hệ</title>
    <link rel="stylesheet" href="form-lien-he.css">
</head>
<body>
    <main class="contact-page">
        <section class="contact-card">
            <div class="contact-heading">
                <h1>Liên hệ</h1>
                <p>Vui lòng điền thông tin để gửi liên hệ cho chúng tôi.</p>
            </div>

            <?php if ($thanhCong): ?>
                <div class="message success">
                    Gửi liên hệ thành công. Cảm ơn bạn đã phản hồi!
                </div>
            <?php endif; ?>

            <form method="POST" novalidate>
                <div class="form-group">
                    <label for="hoTen">Họ tên <span>*</span></label>
                    <input
                        id="hoTen"
                        type="text"
                        name="hoTen"
                        value="<?= hienThiAnToan($hoTen) ?>"
                        placeholder="Nhập họ tên"
                    >
                    <?php if (isset($loi['hoTen'])): ?>
                        <small class="error"><?= hienThiAnToan($loi['hoTen']) ?></small>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email">Email <span>*</span></label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="<?= hienThiAnToan($email) ?>"
                        placeholder="name@example.com"
                    >
                    <?php if (isset($loi['email'])): ?>
                        <small class="error"><?= hienThiAnToan($loi['email']) ?></small>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="chuDe">Chủ đề</label>
                    <select id="chuDe" name="chuDe">
                        <option value="Hỗ trợ kỹ thuật" <?= $chuDe === 'Hỗ trợ kỹ thuật' ? 'selected' : '' ?>>
                            Hỗ trợ kỹ thuật
                        </option>
                        <option value="Góp ý nội dung" <?= $chuDe === 'Góp ý nội dung' ? 'selected' : '' ?>>
                            Góp ý nội dung
                        </option>
                        <option value="Hợp tác" <?= $chuDe === 'Hợp tác' ? 'selected' : '' ?>>
                            Hợp tác
                        </option>
                        <option value="Khác" <?= $chuDe === 'Khác' ? 'selected' : '' ?>>
                            Khác
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="noiDung">Nội dung <span>*</span></label>
                    <textarea
                        id="noiDung"
                        name="noiDung"
                        rows="6"
                        placeholder="Nhập nội dung liên hệ"
                    ><?= hienThiAnToan($noiDung) ?></textarea>
                    <?php if (isset($loi['noiDung'])): ?>
                        <small class="error"><?= hienThiAnToan($loi['noiDung']) ?></small>
                    <?php endif; ?>
                </div>

                <p class="required-note">Các trường có dấu * là bắt buộc.</p>
                <button type="submit">Gửi liên hệ</button>
            </form>
        </section>
    </main>
</body>
</html>
