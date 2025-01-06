<?php
require 'src/config/config.php';
$testimonials = getTestimonials();
$portofolios = getPortofolios();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luarsekolah</title>
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/gallery.css">
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
            <div class="Recap-luarsekolah">
                <h1><span class="highlight-h1">Recap Kegiatan</span> Luarsekolah</h1>
                <p>Melalui acara, seminar, workshop, dan berbagai program lainnya kami terus menghadirkan inspirasi,
                    berbagi pengetahuan, dan membuka peluang yang besar bagi masyarakat luas terutama generasi muda
                    Indonesia.</p>
            </div>
        </section>
        <!-- End Of Hero Section -->

        <section class="portofolio-section">
            <div class="cloud-decoration cloud-left"></div>
            <div class="cloud-decoration cloud-right"></div>

            <h1 class="program-heading">
                Portoflio Para Alumni <span>Luarsekolah</span>
            </h1>

            <div class="portofolio-wrapper">
                <button class="portofolio-btn portofolio-prev">←</button>
                <button class="portofolio-btn portofolio-next">→</button>

                <div class="portofolio-track">
                    <!-- Graphic Design portofolio -->
                    <?php foreach ($portofolios as $portofolio): ?>
                        <div class="portofolio-item">
                            <img src="./pages/admin/portofolio/<?= htmlspecialchars($portofolio['image']); ?>" alt="Graphic Design portofolio" class="portofolio-image">
                            <div class="portofolio-content">
                                <h3 class="portofolio-item-title"><a href="<?= htmlspecialchars($portofolio['project_link']); ?>" target="_blank"><?= htmlspecialchars($portofolio['project_name']); ?></a></h3>
                                <div class="portofolio-author">
                                    <div class="author-info">
                                        <p class="author-name"><?= htmlspecialchars($portofolio['username']); ?></p>
                                        <p class="author-role"><?= htmlspecialchars($portofolio['program_name']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
        </section>

        <!-- Testimonial Section -->
        <section class="program-container">
            <h1 class="program-heading">
                Perjalanan Sukses Alumni <span>Luarsekolah</span>
            </h1>
            <div class="testimonial-slider">
                <button class="slider-button prev-button">←</button>
                <section class="testimonial-section">
                    <div class="slider-container">
                        <?php foreach ($testimonials as $testimonial): ?>
                            <div class="testimonial-card">
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
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <button class="slider-button next-button">→</button>
            </div>
        </section>
        <!-- End Of Testimonial Section -->

        <!-- Gallery Section -->
        <section class="gambar">
            <div class="gambarcontainer">
                <div class="gambarheader">
                    <h2>Dokumentasi</h2>
                    <h3>Melihat Kembali Momen-Momen Berharga kegiatan Luarsekolah melalui Lensa</h3>
                </div>

                <div class="gambarscroll-container">
                    <div class="gambarcarousel-primary1">
                        <img src="assets\img\1-1-DSC02957.png" alt="cat1" />
                        <img src="assets\img\1-2-Charity Amal Salman.png" alt="cat1" />
                        <img src="assets\img\1-3-Cendikia1.png" alt="cat1" />
                        <img src="assets\img\1-4-LS_TRKP_004.png" alt="cat1" />
                    </div>
                    <div class="gambarcarousel-primary1 gambarcarousel-secondary1">
                        <img src="assets\img\1-5-Charity Amal Salman1.png" alt="cat1" />
                        <img src="assets\img\1-6-Sosialisasi Prakerja 20244.png" alt="cat1" />
                        <img src="assets\img\1-7-Charity Amal Salman2.png" alt="cat1" />
                        <img src="assets\img\1-8-Mini Magang1.png" alt="cat1" />
                    </div>
                </div>

                <div class="gambarscroll-container">
                    <div class="gambarcarousel-primary">
                        <img src="assets\img\1-9-Charity Amal Salman3.png" alt="cat1" />
                        <img src="assets\img\1-10-Screenshot (150).png" alt="cat1" />
                        <img src="assets\img\1-11-Webinar Prakerja3.png" alt="cat1" />
                        <img src="assets\img\2-1-DSC02936.png" alt="cat1" />
                    </div>
                    <div class="gambarcarousel-primary gambarcarousel-secondary">
                        <img src="assets\img\2-2-DSC02903.png" alt="cat1" />
                        <img src="assets\img\2-3-Screen Shot 2024-03-04 at 10.06.39.png" alt="cat1" />
                        <img src="assets\img\2-4-DSC02931.png" alt="cat1" />
                        <img src="assets\img\2-5-LS_TRKP_017.png" alt="cat1" />
                    </div>
                </div>

                <div class="gambarscroll-container">
                    <div class="gambarcarousel-primary1">
                        <img src="assets\img\2-6-Krea1.png" alt="cat1" />
                        <img src="assets\img\2-7-DSC02836.png" alt="cat1" />
                        <img src="assets\img\2-8-Mini Magang.png" alt="cat1" />
                        <img src="assets\img\2-9-Sosialisasi Prakerja 20242.png" alt="cat1" />
                    </div>
                    <div class="gambarcarousel-primary1 gambarcarousel-secondary1">
                        <img src="assets\img\2-10-Mini Magang3.png" alt="cat1" />
                        <img src="assets\img\2-11-IMG_1609a.png" alt="cat1" />
                        <img src="assets\img\2-12-.png" alt="cat1" />
                        <img src="assets\img\3-1-LS_TRKP_024.png" alt="cat1" />
                    </div>
                </div>

                <div class="gambarscroll-container">
                    <div class="gambarcarousel-primary">
                        <img src="assets\img\3-2-DSC02829.png" alt="cat1" />
                        <img src="assets\img\3-2-DSC02829.png" alt="cat1" />
                        <img src="assets\img\3-2-DSC02954.png" alt="cat1" />
                        <img src="assets\img\3-4-Sosialisasi Prakerja 2024.png" alt="cat1" />
                    </div>
                    <div class="gambarcarousel-primary gambarcarousel-secondary">
                        <img src="assets\img\3-5-DSC02834.png" alt="cat1" />
                        <img src="assets\img\3-6-DSC02843.png" alt="cat1" />
                        <img src="assets\img\3-7-DSC02871.png" alt="cat1" />
                        <img src="assets\img\3-8-Mini Magang2.png" alt="cat1" />
                    </div>
                </div>
            </div>
        </section>
        <!-- End Of Gallery Section -->

    </main>

    <!-- Footer -->
    <?php include 'components/footer.php'; ?>
    <!-- End Of Footer -->

</body>
<script src="src/js/script.js"></script>

</html>