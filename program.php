<?php
require 'src/config/config.php';
$courseId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$course = readCourseById($courseId);
if (!$course) {
    die("Course tidak ditemukan.");
}
$fasilitator = getTrainerByCourseId($courseId);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luarsekolah | Program</title>
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/program.css">
    <link rel="icon" type="image/x-icon" href="assets/icon/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation Bar -->
    <?php include 'components/navbar.php'; ?>
    <!-- End Of Navigation Bar -->

    <!-- Course Section -->
    <div class="course-container">
        <div class="course-header">
            <div class="title"><?= htmlspecialchars($course['title']); ?></div>
        </div>
        <div class="content-wrapper">
            <div class="image">
                <img src="./pages/admin/banner/<?= htmlspecialchars($course['image']); ?>" alt="Course Image">
            </div>
            <div class="description">
                <h3>Deskripsi</h3>
                <p><?= nl2br(htmlspecialchars($course['description'])); ?></p>

                <div class="facilitator-section">
                    <h4>Fasilitator</h4>
                    <p class="facilitator-name"><?= htmlspecialchars($fasilitator); ?></p>
                </div>

                <div class="price-section">
                    <div class="price">Rp<?= number_format($course['price'], 0, ',', '.'); ?>,-</div>
                    <a href="login.php" class="voucher-btn">Pilih Kelas</a>
                </div>
            </div>
        </div>
        <div class="info-section">
            <h3>Informasi Kelas</h3>
            <div class="dropdown">
                <button class="dropdown-toggle">Tujuan Umum</button>
                <div class="dropdown-content">
                    <p><?= nl2br(htmlspecialchars($course['General_Objectives'])); ?></p>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-toggle">Tujuan Khusus</button>
                <div class="dropdown-content">
                    <p><?= nl2br(htmlspecialchars($course['Specific_Objectives'])); ?></p>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-toggle">Kelompok Sasaran</button>
                <div class="dropdown-content">
                    <p><?= nl2br(htmlspecialchars($course['Target_Group'])); ?></p>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-toggle">Aspek Kompetensi</button>
                <div class="dropdown-content">
                    <p><?= nl2br(htmlspecialchars($course['Competency_Aspects'])); ?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- End Of Course Section -->

    <div id="authModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Perhatian</h2>
            <p>Silahkan masuk atau daftar akun terlebih dahulu untuk memilih kelas ini.</p>
            <div class="modal-buttons">
                <a href="login.php" class="modal-btn login-btn" data-form="login">Masuk</a>
                <a href="login.php" class="modal-btn register-btn" data-form="signup">Daftar</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'components/footer.php'; ?>
    <!-- End Of Footer -->

</body>
<script src="src/js/script.js"></script>
<script src="src/js/modal_handler.js"></script>
<script src="src/js/navbar_handler.js"></script>

</html>