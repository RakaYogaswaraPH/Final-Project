<?php
session_start();
require "../../src/config/config.php";

$username = $_SESSION['username'] ?? 'Pengguna';
$userId = $_SESSION['user_id'];
requireUserRole();
$query = "
    SELECT c.id, c.title 
    FROM course_registrations cr
    JOIN course c ON cr.course_id = c.id
    WHERE cr.user_id = $userId
";
$result = mysqli_query($connect, $query);

$kelasTerpilih = [];
while ($row = mysqli_fetch_assoc($result)) {
    $kelasTerpilih[] = [
        'id' => $row['id'],
        'title' => $row['title']
    ];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luarsekolah | Kelas</title>
    <link rel="stylesheet" href="../../src/css/style.css">
    <link rel="stylesheet" href="../../src/css/user.css">
    <link rel="stylesheet" href="../../src/css/user_navbar.css">
    <link rel="icon" type="image/x-icon" href="../../assets/icon/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <style>

    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <?php include '../../components/user_navbar.php'; ?>
    <!-- End Of Navigation Bar -->

    <main class="main-content">
        <section class="welcome-section">
            <h1>Selamat datang <?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>!</h1>
            <p>Semoga aktivitas belajarmu menyenangkan.</p>
        </section>

        <div class="subscription-card">
            <h2 class="subscription-status"><i class="fas fa-chalkboard"></i> Status Kelas</h2>
            <div class="subscription-message">
                <?php if (!empty($kelasTerpilih)): ?>
                    <p>Anda telah terdaftar di kelas:</p>
                    <div class="registered-classes">
                        <?php foreach ($kelasTerpilih as $kelas): ?>
                            <div class="class-item"><?= htmlspecialchars($kelas['title']); ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>Anda belum memilih kelas Luarsekolah. Ayo mulai perjalanan mu menjadi talenta profesional.</p>
                    <a href="isw.php"><button class="subscription-btn">Pilih Kelas</button></a>
                <?php endif; ?>
            </div>
        </div>
        </div>

        <div class="activities-container">
            <div class="activity-card">
                <div class="activity-header">
                    <span><i class="fas fa-chart-line"></i></span>
                    <h3>Aktivitas Belajar</h3>
                </div>
                <?php if (!empty($kelasTerpilih)): ?>
                    <?php foreach ($kelasTerpilih as $kelas): ?>
                        <div class="course-item">
                            <div><?= htmlspecialchars($kelas['title']); ?></div>
                            <a href="#" class="continue-btn">Lanjutkan</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="color: #666; margin-bottom: 1rem;">Belum ada kelas yang terdaftar.</p>
                <?php endif; ?>
            </div>

            <div class="activity-card">
                <div class="activity-header">
                    <span><i class="fas fa-chalkboard-teacher"></i></span>
                    <h3>Fasilitator Kelas</h3>
                </div>
                <?php if (!empty($kelasTerpilih)): ?>
                    <?php foreach ($kelasTerpilih as $kelas): ?>
                        <div class="facilitator-item">
                            <div class="class-name"><?= htmlspecialchars($kelas['title']); ?></div>
                            <div class="facilitator-name">
                                <?php
                                $facilitator = getTrainerByCourseId($kelas['id']);
                                echo $facilitator !== "Segera" ? $facilitator : "Belum ada fasilitator";
                                ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="color: #666; margin-bottom: 1rem;">Belum ada fasilitator karena Anda belum terdaftar di kelas manapun.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include '../../components/user_footer.php'; ?>
    <!-- End Of Footer -->
</body>
<script src="../../src/js/script.js"></script>

</html>