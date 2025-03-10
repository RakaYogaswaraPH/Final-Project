<?php
session_start();
require '../../src/config/config.php';
include '../../components/facilitator_sidebar.php';

$loggedInFacilitatorId = $_SESSION['user_id'];
$loggedInFacilitatorName = $_SESSION['username'];
$courseId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$course = readCourseById($courseId);
if (!$course) {
    http_response_code(404);
    include __DIR__ . "/../404.php"; 
    exit();
}
$fasilitator = getFacilitatorByCourseId($courseId);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luarsekolah | Kelas Fasilitator</title>
    <link rel="stylesheet" href="../../src/css/style.css">
    <link rel="stylesheet" href="../../src/css/admin.css">
    <link rel="stylesheet" href="../../src/css/preview.css">
    <link rel="stylesheet" href="../../src/css/program.css">
    <link rel="icon" type="image/x-icon" href="../../assets/icon/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

    <!-- Header -->
    <?php include '../../components/facilitator_header.php'; ?>
    <!-- End Of Header -->

    <main class="main">
        <!-- Sidebar Menu -->
        <?php renderSidebar('kelas'); ?>
        <!-- End Of Sidebar Menu -->

        <!-- Course Section -->
        <div class="course-container">
            <div class="course-header">
                <div class="title"><?= htmlspecialchars($course['title']); ?></div>
            </div>
            <div class="content-wrapper">
                <div class="image">
                    <img src="../../pages/admin/banner/<?= htmlspecialchars($course['image']); ?>" alt="Course Image">
                </div>
                <div class="description">
                    <h3>Deskripsi</h3>
                    <p><?= nl2br(htmlspecialchars($course['description'])); ?></p>

                    <div class="facilitator-section">
                        <h4>Fasilitator</h4>
                        <p class="facilitator-name"><?= htmlspecialchars($fasilitator); ?></p>
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
            <div class="back-button-container">
                <a href="classroom.php" class="back-button">
                    <i class="ri-arrow-left-line"></i> Kembali
                </a>
            </div>

        </div>
        <!-- End Of Course Section -->
    </main>


</body>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const dropdownToggles = document.querySelectorAll(".dropdown-toggle");

        dropdownToggles.forEach(toggle => {
            toggle.addEventListener("click", () => {
                const content = toggle.nextElementSibling;
                content.classList.toggle("open");

                // Menyesuaikan teks tombol
                if (content.classList.contains("open")) {
                    toggle.textContent = toggle.textContent;
                } else {
                    toggle.textContent = toggle.textContent;
                }
            });
        });
    });
</script>

</html>