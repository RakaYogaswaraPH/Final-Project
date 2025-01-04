<?php
require 'src/config/config.php';
$courses = readCourses();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luarsekolah | ISW </title>
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/isw.css">
    <link rel="icon" type="image/x-icon" href="assets/icon/favicon.ico">
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
    <?php include 'components/navbar.php'; ?>
    <!-- End Of Navigation Bar -->

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="isw-luarsekolah">
                <h1><span class="highlight-h1">Indonesia </span> Skills Week</h1>
                <p>Indonesia Skills Week adalah event dua bulanan dari Prakerja yang terbuka untuk semua golongan,
                    termasuk
                    alumni Prakerja.</p>
            </div>
        </section>
        <!-- End Of Hero Section -->

        <!-- Timeline Section -->
        <section id="timeline">
            <h1 id="timeline-header">Cara Mengikuti ISW di Luarsekolah</h1>
            <ul id="timeline-list">
                <li id="timeline-item-1" style="--accent-color:#41516C">
                    <div class="timeline-date">Buat Akun Prakerja</div>
                    <div class="timeline-title">Buat Akun Prakerja
                        Yuk daftar terlebih dahulu di <a href="https://dashboard.prakerja.go.id/"
                            target="_blank">dashboard.prakerja.go.id</a></div>
                </li>
                <li id="timeline-item-2" style="--accent-color:#FBCA3E">
                    <div class="timeline-date">Masuk Ke Website ISW</div>
                    <div class="timeline-title">Gunakan akun Prakerja kamu di web <a
                            href="https://skillsweek.prakerja.go.id/" target="_blank">skillsweek.prakerja.go.id/</a>
                    </div>
                </li>
                <li id="timeline-item-3" style="--accent-color:#E24A68">
                    <div class="timeline-date">Pilih Pelatihan Luarsekolah</div>
                    <div class="timeline-title">kamu bisa mencari dan ambil pelatihan yang kamu minati di Luarsekolah.
                    </div>
                </li>
                <li id="timeline-item-4" style="--accent-color:#1B5F8C">
                    <div class="timeline-date">Cek Kode di Email</div>
                    <div class="timeline-title">Kamu akan mendapatkan Kode Promo yang dikirimkan ke email yang terdaftar
                        di
                        Prakerja</div>
                </li>
                <li id="timeline-item-5" style="--accent-color:#4CADAD">
                    <div class="timeline-date">Mulai Pelatihan</div>
                    <div class="timeline-title">Cari kelas yang sudah kamu dapatkan Kode Promonya di <a
                            href="https://www.luarsekolah.com/" target="_blank"></a>www.luarsekolah.com</div>
                </li>
            </ul>
        </section>
        <!-- End Of Timeline Section -->

        <!-- Our Course Section -->
        <section class="course-section">
            <h1>Kelas Terpopuler <span class="highlight">Prakerja</span></h1>
            <section class="articles">
                <?php foreach ($courses as $course): ?>
                    <article>
                        <div class="article-wrapper">
                            <figure>
                                <img src="./pages/admin/banner/<?= htmlspecialchars($course['image']); ?>" alt="<?= htmlspecialchars($course['image']); ?>" />
                            </figure>
                            <div class="article-body">
                                <h2><?= htmlspecialchars($course['title']); ?></h2>
                                <p><?= htmlspecialchars(substr($course['description'], 0, 100)); ?>...</p>
                                <a href="program.php?id=<?= $course['id']; ?>" class="read-more">
                                    Read more <span class="sr-only">about <?= htmlspecialchars($course['title']); ?></span>
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
    <?php include 'components/footer.php'; ?>
    <!-- End Of Footer -->

</body>
<script src="src/js/script.js"></script>

</html>