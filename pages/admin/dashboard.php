<?php
include '../../components/sidebar.php';
require "../../src/config/config.php";
$users = getAllUsers();
$courses = getAllCourse();
$testimonials = getAllTestimonials();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luarsekolah | Dashboard</title>
    <link rel="stylesheet" href="../../src/css/administrator.css">
    <link rel="icon" type="image/x-icon" href="../../assets/icon/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
    <div class="container">
        <!-- Header -->
        <?php include '../../components/header.php'; ?>
        <!-- End Of Header -->

        <main class="main">
            <?php renderSidebar('dashboard'); ?>

            <section class="page-content">
                <article class="board">
                    <p>Selamat Datang</p>
                    <section class="boxes">
                        <div class="box bg-pink">
                            <p>Pengguna</p>
                            <div class="icon-value">
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <p class="value"><?php echo $users; ?></p>
                            </div>
                        </div>

                        <div class="box bg-purple">
                            <p>Program</p>
                            <div class="icon-value">
                                <div class="icon">
                                    <i class="fas fa-sitemap"></i>
                                </div>
                                <p class="value"><?php echo $courses; ?></p>
                            </div>
                        </div>

                        <div class="box bg-cyan">
                            <p>Testimoni</p>
                            <div class="icon-value">
                                <div class="icon"><i class="fas fa-comments"></i></div>
                                <p class="value"><?php echo $testimonials; ?></p>
                            </div>
                        </div>

                        <div class="box bg-ash">
                            <p>Portofolio</p>
                            <div class="icon-value">
                                <div class="icon">
                                    <i class="fas fa-file"></i>
                                </div>
                                <p class="value">0</p>
                            </div>
                        </div>

                    </section>
                </article>
            </section>
        </main>
    </div>
</body>

</html>