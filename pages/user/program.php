<?php
session_start();
require '../../src/config/config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    include __DIR__ . "/pages/404.php"; 
    exit();
}

$courseId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$fasilitator = getFacilitatorByCourseId($courseId);
$userId = $_SESSION['user_id'];
$isRegistered = isUserRegistered($userId, $courseId);
$course = readCourseById($courseId);

if (!$course) {
    http_response_code(404);
    include __DIR__ . "/../404.php"; 
    exit();
}
$participantCount = getRegistrationCountByCourseId($courseId);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luarsekolah | Program</title>
    <link rel="stylesheet" href="../../src/css/style.css">
    <link rel="stylesheet" href="../../src/css/program.css">
    <link rel="stylesheet" href="../../src/css/user_navbar.css">
    <link rel="stylesheet" href="../../src/css/user_footer.css">
    <link rel="icon" type="image/x-icon" href="../../assets/icon/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <!-- Navigation Bar -->
    <?php include '../../components/user_navbar.php'; ?>
    <!-- End Of Navigation Bar -->

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

                <div class="participant-count-section">
                    <i class="fas fa-users"></i>
                    <?php if ($participantCount > 0): ?>
                        <?= number_format($participantCount, 0, ',', '.'); ?>+ Pelajar yang mengikuti kelas ini
                    <?php else: ?>
                        Ayo daftarkan dirimu sebagai peserta paling pertama!
                    <?php endif; ?>
                </div>

                <div class="price-section">
                    <div class="price">Rp<?= number_format($course['price'], 0, ',', '.'); ?>,-</div>
                    <?php if (!$isRegistered): ?>
                        <form action="" method="POST">
                            <input type="hidden" name="course_id" value="<?= $courseId; ?>">
                            <button type="submit" name="register" class="voucher-btn">Pilih Kelas</button>
                        </form>
                    <?php else: ?>
                        <button class="voucher-btn" disabled style="background-color: #6c757d;">Sudah Terdaftar</button>
                    <?php endif; ?>
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

    <!-- Footer -->
    <?php include '../../components/user_footer.php'; ?>
    <!-- End Of Footer -->

</body>
<script src="../../src/js/script.js"></script>
<script src="../../src/js/toastr.js"></script>
<?php
// Proses pengajuan kelas
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $courseId = intval($_POST['course_id']); // Ambil ID kursus dari form

    // Panggil fungsi untuk mendaftar
    $result = registerForCourse($userId, $courseId);

    // Tampilkan pesan hasil menggunakan toastr
    if ($result['status'] === 'success') {
        echo "<script>toastr.success('" . addslashes($result['message']) . "');</script>";
    } else {
        echo "<script>toastr.error('" . addslashes($result['message']) . "');</script>";
    }
}
?>


</html>