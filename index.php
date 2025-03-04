<?php
require 'src/config/config.php';
$courses = readCourses();
$testimonials = getTestimonials();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luarsekolah | #sampaijadibisa</title>
    <link rel="stylesheet" href="src/css/style.css">
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
        <section id="hero">
            <div class="container">
                <div class="info">
                    <h1>Luar Sekolah</h1>
                    <h2><span id="dynamic-text"></span> #sampaijadibisa</h2>
                    <p>Mulai kembangkan karier dan keahlian mu sebagai generasi muda Indonesia <span id="tagline">#sampaijadibisa.</span>
                    </p>
                    <a href="#program">Bergabung Sekarang <i class="ri-shake-hands-fill"></i></a>
                </div>

                <div class="hero-image">
                    <img src="assets/animation/LS.png" alt="Hero Image">
                </div>
            </div>
        </section>
        <!-- End Of Hero Section -->

        <!-- About Section -->
        <section class="about" id="about">
            <div class="about-luarsekolah">
                <h1><span class="highlight-h1">Tentang Kami</span></h1>
                <p>
                    "Mulai dari langkah pertama memahami dasar hingga mencapai pencapaian besar, Luarsekolah akan selalu mendampingi di setiap proses pengembangan karier mu
                    <span class="highlight-p">#sampaijadibisa"</span>
                </p>
            </div>
        </section>
        <!-- End Of About Section -->

        <!-- Story Section -->
        <section class="story-luarsekolah">
            <div class="slideshow-luarsekolah">
                <div class="slide-luarsekolah slide-1">
                    <div class="content-slide-luarsekolah">
                        <h1>Luar Sekolah</h1>
                        <p>
                            Luar sekolah adalah platform pelatihan edukasi berbasis digital sebagai sarana untuk mendukung generasi muda
                            Indonesia untuk belajar dan berkembang </p>
                    </div>
                </div>

                <div class="slide-luarsekolah slide-2">
                    <div class="content-slide-luarsekolah">
                        <h1>Berawal Dari Kenyataan Pendidikan Saat Ini</h1>
                        <p>Pendidikan formal tidak sesuai kebutuhan industri.</p>
                        <p>Kesenjangan keterampilan dengan dunia kerja.</p>
                        <p>Perusahaan sulit mencari talenta siap bersaing.</p>
                    </div>
                </div>

                <div class="slide-luarsekolah slide-3">
                    <div class="content-slide-luarsekolah">
                        <h1>Maka Demikian...</h1>
                        <p>Kami hadirkan platform pendidikan pelatihan untuk membantu serta mengembangkan kemampuan dan
                            juga karier para generasi muda Indonesia.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Of Story Section -->

        <!-- Visi-Misi Section -->
        <section class="visi-misi">
            <div class="title-visimisi">
                <h2>Tujuan Kami</h2>
                <h4>Kami memiliki rencana untuk mencapai tujuan</h4>
            </div>

            <div class="content-visimisi">
                <div class="animation-visi">
                    <img src="assets/animation/ola.png" alt="Ola">
                </div>
                <div class="visi-right">
                    <h2>
                        <img src="assets/icon/visi-icon.png" alt="Icon">
                        Visi
                    </h2>
                    <p>
                        Menjadi platform pendidikan non-formal berbasis teknologi yang mencetak generasi muda unggul,
                        berkarakter, berpengetahuan, terampil, dan berdaya saing.
                    </p>
                </div>

                <div class="misi-left">
                    <h2>
                        <img src="assets/icon/misi-icon.png" alt="Ikon Misi">
                        Misi
                    </h2>
                    <ul>
                        <li>Merancang program pendidikan sesuai kebutuhan industri.</li>
                        <li>Menyediakan akses pembelajaran dan pengembangan diri.</li>
                        <li>Menanamkan budaya belajar dengan pendampingan aktif.</li>
                        <li>Mendorong kolaborasi melalui pembelajaran kelompok.</li>
                    </ul>
                </div>

                <div class="animation-misi">
                    <img src="assets/animation/three.png" alt="Three">
                </div>
            </div>
        </section>
        <!-- End Of Visi-Misi Section -->

        <!-- Value Section -->
        <section class="value-section">
            <div class="value-header">
                <h2>Kenapa Luar Sekolah Berbeda</h2>
                <p>Kami memiliki nilai yang dijadikan inspirasi kami untuk terus berkembang</p>
            </div>

            <div class="value-content">
                <div class="value-item">
                    <img src="assets/animation/lulu-1.png" alt="Lulu">
                    <p>Relevan Dengan Zaman</p>
                </div>
                <div class="value-item">
                    <img src="assets/animation/lulu-2.png" alt="Lulu">
                    <p>Berani Untuk Memulai</p>
                </div>
                <div class="value-item">
                    <img src="assets/animation/lulu-3.png" alt="Lulu">
                    <p>Terbaru dan Terkurasi</p>
                </div>
            </div>
        </section>
        <!-- End Of Value Section -->

        <!-- Benefit Section -->
        <section class="benefit">
            <div class="benefit-header">
                <h2>Solusi <span>Yang Kami Berikan</span></h2>
            </div>

            <div class="benefit-grid">
                <div class="benefit-item">
                    <img src="assets/icon/keunggulan-1.png" alt="Ikon 1">
                    <h3>Memberdayakan lulusan untuk dunia kerja.</h3>
                    <p>Kami membangun kurikulum yang kami rancang dengan kebutuhan industri, agar siap menghadapi dunia kerja.</p>
                </div>

                <div class="benefit-item">
                    <img src="assets/icon/keunggulan-2.png" alt="Ikon 2">
                    <h3>Memberikan Akses yang Mudah dan Berkualitas.</h3>
                    <p>Platform kami memberikan akses pendidikan yang praktis, efektif, dan berkualitas untuk semua
                        pengguna.</p>
                </div>

                <div class="benefit-item">
                    <img src="assets/icon/keunggulan-3.png" alt="Ikon 3">
                    <h3>Menawarkan Kelas dengan Harga Terjangkau.</h3>
                    <p>Mempelajari skill baru <span class="highlight">#sampaijadibisa</span> tidak perlu mahal! Jadi, kamu
                        bisa menyesuaikan dengan kelas impianmu.</p>
                </div>

                <div class="benefit-item">
                    <img src="assets/icon/keunggulan-4.png" alt="Ikon 4">
                    <h3>Masuk Jurusan yang Salah? Tidak Perlu Cemas!</h3>
                    <p>Dengan berbagai pilihan kelas, kamu bisa membangun diri sesuai minat dan
                        bakatmu, tanpa terikat jurusan.</p>
                </div>
            </div>
        </section>
        <!-- End Of Benefit Section -->

        <!-- Achivement Section -->
        <section class="achievement">
            <div class="achievement-img">
                <img src="assets/animation/eko.png" alt="Eko">
            </div>

            <div class="achievement-content">
                <h1>Pencapaian</h1>
                <p>
                    Kami berkomitmen menciptakan perubahan nyata demi mendukung tumbuh kembang generasi muda Indonesia
                    yang lebih hebat.
                </p>
            </div>

            <div class="achievement-total">
                <div>
                    <h4>Total User</h4>
                    <h1>1.260.000+</h1>
                </div>
                <div>
                    <h4>Total Kelas</h4>
                    <h1>150+</h1>
                </div>
                <div>
                    <h4>Total Fasilitator</h4>
                    <h1>100+</h1>
                </div>
                <div>
                    <h4>Follower Instagram</h4>
                    <h1>313.000+</h1>
                </div>
            </div>
        </section>
        <!-- End Of Achievement Section -->

        <!-- Partnership Section -->
        <section class="mitra">
            <div class="mitracontainer">
                <div class="mitraheader">
                    <h1><span>Mitra</span> Luar Sekolah</h1>
                </div>
                <div class="mitrascroll-container">
                    <div class="mitracarousel-primary">
                        <img src="assets\img\mitra-perusahaan-1.png" alt="cat1" />
                        <img src="assets\img\mitra-perusahaan-2.png" alt="cat1" />
                        <img src="assets\img\mitra-perusahaan-3.png" alt="cat1" />
                        <img src="assets\img\mitra-perusahaan-4.png" alt="cat1" />
                    </div>
                    <div class="mitracarousel-primary mitracarousel-secondary">
                        <img src="assets\img\mitra-perusahaan-5.png" alt="cat1" />
                        <img src="assets\img\mitra-perusahaan-6.png" alt="cat1" />
                        <img src="assets\img\mitra-perusahaan-7.png" alt="cat1" />
                    </div>
                </div>

                <div class="mitrascroll-container1">
                    <div class="mitracarousel-primary1">
                        <img src="assets\img\mitra-kampus-1.png" alt="cat1" />
                        <img src="assets\img\mitra-kampus-2.png" alt="cat1" />
                        <img src="assets\img\mitra-kampus-3.png" alt="cat1" />
                        <img src="assets\img\mitra-kampus-4.png" alt="cat1" />
                    </div>
                    <div class="mitracarousel-primary1 mitracarousel-secondary1">
                        <img src="assets\img\mitra-kampus-5.png" alt="cat1" />
                        <img src="assets\img\mitra-kampus-6.png" alt="cat1" />
                        <img src="assets\img\mitra-kampus-7.png" alt="cat1" />
                    </div>
                </div>
            </div>
        </section>
        <!-- End Of Partnership Section -->

        <!-- Our Team Section -->
        <section class="team-section" id="team">
            <h1><span class="highlight">Tim</span> Luar Biasa Kami</h1>
            <div class="team-container">
                <div class="team-member">
                    <div class="team-member jibril">
                        <div class="profile-picture">
                            <img src="./assets/img/tim-luarsekolah-ceo.png" alt="M. Jibril Sobron">
                        </div>
                        <h2>M. Jibril Sobron</h2>
                        <p>Chief Executive Officer & Co-Founder</p>
                        <div class="social-links left">
                            <a href="mailto:jibril@luarsekolah.com"><img src="./assets/icon/tim-luarsekolah-instagram.png" alt="Instagram"></a>
                            <a href="https://www.instagram.com/jibrilsobron/" target="_blank"><img src="./assets/icon/tim-luarsekolah-email.png" alt="Email"></a>
                            <a href="https://www.linkedin.com/in/jibrilsobron/" target="_blank"><img src="./assets/icon/tim-luarsekolah-linkedin.png" alt="LinkedIn"></a>
                        </div>
                    </div>
                </div>

                <div class="team-member">
                    <div class="profile-picture">
                        <img src="./assets/img/tim-luarsekolah-co-founder.png" alt="M. Fauzan Ahsan">
                    </div>
                    <h2>M. Fauzan Ahsan</h2>
                    <p>Technology Adviser & Co-Founder</p>
                    <div class="social-links right">
                        <a href="mailto:fauzan.ahsan@gmail.com"><img src="./assets/icon/tim-luarsekolah-instagram.png" alt="Instagram"></a>
                        <a href="https://www.instagram.com/mfauzanahsan/" target="_blank"><img src="./assets/icon/tim-luarsekolah-email.png" alt="Email"></a>
                        <a href="https://www.linkedin.com/in/fauzanahsan/" target="_blank"><img src="./assets/icon/tim-luarsekolah-linkedin.png" alt="LinkedIn"></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Of Our Team Section -->

        <!-- Program Section -->
        <section class="program-container" id="program">
            <h1 class="program-heading">
                <span>Program </span>Luar Sekolah
            </h1>
            <div class="program-wrapper">
                <div class="program">
                    <img src="./assets/img/1-program-prakerja.png" alt="Program 1" class="program-image">
                    <div class="program-content">
                        <h1 class="program-title">Kartu Prakerja</h1>
                        <p class="program-description">Program Pengembangan Keterampilan untuk Pencari Kerja dan Pekerja
                            yang ingin meningkatkan kompetensi.</p>
                        <a href="prakerja.php"><button class="program-button">Lihat
                                Selengkapnya</button></a>
                    </div>
                </div>

                <div class="program">
                    <img src="./assets/img/2-program-belajarbekerja.png" alt="Program 2" class="program-image">
                    <div class="program-content">
                        <h1 class="program-title">Belajar Bekerja</h1>
                        <p class="program-description">Dirancang untuk membuatmu siap menghadapi industri dan mendapatkan
                            pekerjaan yang diinginkan.</p>
                        <a href="https://belajarbekerja.com/" target="_blank"><button class="program-button">Lihat
                                Selengkapnya</button></a>
                    </div>
                </div>

                <div class="program">
                    <img src="./assets/img/3-program-isw.png" alt="Program 3" class="program-image">
                    <div class="program-content">
                        <h1 class="program-title">Prakerja ISW</h1>
                        <p class="program-description">Indonesia Skills Week: Event dua bulanan Prakerja untuk semua
                            golongan, termasuk alumni Luarsekolah.</p>
                        <a href="isw.php"><button class="program-button">Lihat
                                Selengkapnya</button></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Of Program Section -->

        <!-- Testimonial Section -->
        <section class="program-container" id="testimonial">
            <h1 class="program-heading">
                Perjalanan Sukses Alumni <span>Luarsekolah</span>
            </h1>
            <div class="testimonial-slider">
                <button class="slider-button prev-button">←</button>
                <section class="testimonial-section">
                    <div class="slider-container">
                        <?php
                        $count = 0;
                        foreach (array_slice($testimonials, 0, 4) as $testimonial):
                            $isBlurred = ($count === 3);
                            $cardClass = $isBlurred ? 'testimonial-card blur-card' : 'testimonial-card';
                        ?>
                            <?php if ($isBlurred): ?>
                                <a href="all-testimonials.php" class="card-link">
                                <?php endif; ?>
                                <div class="<?= $cardClass ?>">
                                    <div class="testimonial-image">
                                        <img src="./pages/admin/profile/<?= htmlspecialchars($testimonial['image']); ?>" alt="<?= htmlspecialchars($testimonial['name']); ?>">
                                    </div>
                                    <div class="testimonial-content">
                                        <h3 class="testimonial-name"><?= htmlspecialchars($testimonial['name']); ?></h3>
                                        <div class="testimonial-title"><?= htmlspecialchars($testimonial['course_name']); ?></div>
                                        <p class="testimonial-text"><?= htmlspecialchars($testimonial['review']); ?></p>
                                        <div class="testimonial-info">
                                            <div class="testimonial-name">
                                                <?= htmlspecialchars($testimonial['program_name']); ?><br>
                                                <a href="<?= htmlspecialchars($testimonial['linkedin']); ?>" target="_blank">
                                                    <i class="fab fa-linkedin"></i> Linkedin
                                                </a>
                                            </div>
                                        </div>
                                        <?php if ($isBlurred): ?>
                                            <div class="see-all-overlay">
                                                <a href="community.php">
                                                    <h2 class="see-all-text">Lihat Semua</h2>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if ($isBlurred): ?>
                                </a>
                            <?php endif; ?>
                        <?php
                            $count++;
                        endforeach;
                        ?>
                    </div>
                </section>
                <button class="slider-button next-button">→</button>
            </div>
        </section>
        <!-- End Of Testimonial Section -->

        <!-- Contact Section -->
        <div class="contact">
            <div class="contactUs">
                <div class="title-contact">
                    <h2>Yuk, Kenali Kami Lebih Jauh</h2>
                </div>
                <div class="box-contact">
                    <div class="contact-maps">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15865.021296467057!2d106.81051261984668!3d-6.230032269482236!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e799d285b7%3A0x1a1359055467a9ec!2svOffice%20Indonesia%20-%20Headquarter%20(Virtual%20Office%20%7C%20Serviced%20Office%20%7C%20Event%20Space%20%7C%20Meeting%20Room)!5e0!3m2!1sid!2sid!4v1733060323702!5m2!1sid!2sid"
                            width="100%" height="auto" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="contact-info">
                        <div class="infoBox">
                            <table>
                                <tr>
                                    <td><i class="fa-solid fa-location-dot fa-xl"></i></td>
                                    <td>Centenial Tower Level 29, Jl Jendral Gatot Subroto No.27, Karet Semanggi,
                                        Setiabudi DKI Jakarta 12950.</td>
                                </tr>
                                <tr>
                                    <td><i class="fa-brands fa-whatsapp fa-xl"></i></td>
                                    <td>+62 811 2021 444</td>
                                </tr>
                                <tr>
                                    <td><i class="fa-solid fa-envelope fa-xl"></i></td>
                                    <td>info@luarsekolah.com</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Of Contact Section -->

            <!-- Collabs -->
            <div class="colaboration">
                <div class="container-collab">
                    <div class="title-collab">
                        <p>Ingin Berkolaborasi Dengan Kami?</p>
                    </div>
                    <div class="btn-colab">
                        <a href="mailto:info@luarsekolah.com?subject=Pengajuan Kerjasama" class="button">Ajukan
                            Penawaran</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Of Collabs  -->
    </main>

    <!-- Footer -->
    <?php include 'components/footer.php'; ?>
    <!-- End Of Footer -->


</body>
<script src="src/js/script.js"></script>
<script src="src/js/testimonial.js"></script>
<script src="src/js/navbar_handler.js"></script>

</html>