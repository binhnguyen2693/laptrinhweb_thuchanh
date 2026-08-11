<?php
declare(strict_types=1);

$student = [
    'name' => 'Trần Nguyễn Bình Nguyên',
    'student_id' => '224001819',
    'class' => 'Lập trình web_1',
    'school' => 'trường Đại học Thủ Đô Hà Nội',
];

$projects = [
    [
        'name' => 'Website tin tức/blog có trang quản trị',
        'description' => 'Bài tập lớn theo nhóm của học phần Lập trình web: Website tin tức/Blog có trang quản trị',
        'status' => 'Đang lập kế hoạch',
    ],
];

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giới thiệu bản thân</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Bài thực hành buổi 01 -->
    <main class="container">

        <header class="hero">
            <p class="eyebrow">About me</p>
            <h1><?= escape($student['name']) ?></h1>
            <p>
                Mình là một sinh viên đang học môn Lập trình web. Mình đang tìm hiểu
                HTML, CSS, PHP, MySQL, Git và GitHub.
            </p>
        </header>

        <section class="card">
            <h2>Thông tin cá nhân</h2>
            <dl class="details">
                <div><dt>Mã sinh viên</dt><dd><?= escape($student['student_id']) ?></dd></div>
                <div><dt>Lớp</dt><dd><?= escape($student['class']) ?></dd></div>
                <div><dt>Trường</dt><dd><?= escape($student['school']) ?></dd></div>
            </dl>
        </section>

        <section>
            <h2>Dự án đang thực hiện</h2>
            <div class="grid">
                <?php foreach ($projects as $project): ?>
                    <article class="card">
                        <span class="badge"><?= escape($project['status']) ?></span>
                        <h3><?= escape($project['name']) ?></h3>
                        <p><?= escape($project['description']) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
</body>
</html>
