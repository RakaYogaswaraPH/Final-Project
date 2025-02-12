<?php
session_start();
require '../../src/config/config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    die("Anda harus login sebagai pengguna untuk mendaftar.");
}
$courses = readCourses();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luarsekolah | Prakerja </title>
    <link rel="stylesheet" href="../../src/css/style.css">
    <link rel="stylesheet" href="../../src/css/isw.css">
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

    <main>
        <!-- Hero Section -->
        <section class="hero-2">
            <div class="isw-luarsekolah">
                <h1>Program <span class="highlight-h1-2">Prakerja</span></h1>
                <p>Program Pengembangan Keterampilan untuk Pencari Kerja dan Pekerja yang ingin meningkatkan kompetensi.</p>
            </div>
        </section>
        <!-- End Of Hero Section -->

        <!-- Our Course Section -->
        <section class="course-section">
            <h1>Kelas Terpopuler <span class="highlight">Prakerja</span></h1>
            <section class="articles">
                <?php foreach ($courses as $course): ?>
                    <article>
                        <div class="article-wrapper">
                            <figure>
                                <img src="../../pages/admin/banner/<?= htmlspecialchars($course['image']); ?>" alt="<?= htmlspecialchars($course['image']); ?>" />
                            </figure>
                            <div class="article-body">
                                <h2><?= htmlspecialchars($course['title']); ?></h2>
                                <p><?= htmlspecialchars(substr($course['description'], 0, 100)); ?>...</p>
                                <a href="program.php?id=<?= $course['id']; ?>" class="read-more">
                                    Baca Selengkapnya <span class="sr-only">about <?= htmlspecialchars($course['title']); ?></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
        </section>
        <!-- End Of Our Course Section -->
    </main>

    <!-- Footer -->
    <?php include '../../components/user_footer.php'; ?>
    <!-- End Of Footer -->

</body>
<script src="src/js/script.js"></script>

</html>