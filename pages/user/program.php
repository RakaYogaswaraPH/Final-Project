<?php
session_start();
require '../../src/config/config.php';

// Pastikan pengguna login dan memiliki role 'user'
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../../login.php");
    exit(); // Hentikan eksekusi untuk mencegah akses lebih lanjut
}

// Ambil ID dari URL
$courseId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data course berdasarkan ID
$course = readCourseById($courseId);

if (!$course) {
    die("Course tidak ditemukan.");
}

$fasilitator = getFacilitatorByCourseId($courseId);

function registerForCourse($userId, $courseId)
{
    global $connect;

    // Periksa apakah pengguna sudah mendaftar kursus ini
    $checkQuery = "SELECT * FROM course_registrations WHERE user_id = $userId AND course_id = $courseId";
    $checkResult = mysqli_query($connect, $checkQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        return ['status' => 'error', 'message' => 'Anda sudah terdaftar dalam kursus ini.'];
    }

    // Daftarkan pengguna ke kursus
    $query = "INSERT INTO course_registrations (user_id, course_id) VALUES ($userId, $courseId)";
    if (mysqli_query($connect, $query)) {
        return ['status' => 'success', 'message' => 'Berhasil mendaftar dalam kursus ini.'];
    }

    return ['status' => 'error', 'message' => 'Gagal mendaftar kursus.'];
}


// Ambil ID pengguna dari sesi
$userId = $_SESSION['user_id'];

// Proses pengajuan kelas
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $courseId = intval($_POST['course_id']); // Ambil ID kursus dari form

    // Panggil fungsi untuk mendaftar
    $result = registerForCourse($userId, $courseId);

    // Tampilkan pesan hasil
    if ($result['status'] === 'success') {
        echo "<script>alert('{$result['message']}');</script>";
    } else {
        echo "<script>alert('{$result['message']}');</script>";
    }
}


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
    <link rel="icon" type="image/x-icon" href="../../assets/icon/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
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

                <div class="price-section">
                    <div class="price">Rp<?= number_format($course['price'], 0, ',', '.'); ?>,-</div>
                    <form action="" method="POST">
                        <input type="hidden" name="course_id" value="<?= $courseId; ?>">
                        <button type="submit" name="register" class="voucher-btn">Pilih Kelas</button>
                    </form>
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

</html>