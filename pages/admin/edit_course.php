<?php
session_start();
require "../../src/config/config.php";
include '../../components/sidebar.php';
requireAdminRole();

$courseId = (int)$_GET['id'];
$course = readCourseById($courseId);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_course'])) {
    // Simpan data POST dalam variabel sementara
    $postData = $_POST;

    // Cek apakah title sudah ada di course lain (duplikasi)
    $id = (int)$postData['id'];
    $title = htmlspecialchars($postData['title']);

    global $connect;
    $result = mysqli_query($connect, "SELECT id FROM course WHERE title = '$title' AND id != $id");

    if (mysqli_fetch_assoc($result)) {
        // Judul sudah ada, tampilkan pesan tanpa upload gambar
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.warning('Program dengan judul tersebut sudah ada', 'Perhatian');
            });
        </script>";
    } else {
        // Judul belum ada, lanjutkan dengan proses upload gambar jika ada
        if (!empty($_FILES['image']['name'])) {
            $imagePath = uploadImage($_FILES['image']);
            if ($imagePath) {
                $postData['image'] = $imagePath;
            } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        toastr.error('Terjadi kesalahan mengunggah gambar', 'Gagal');
                    });
                </script>";
            }
        } else {
            // Gunakan gambar yang sudah ada jika tidak ada upload baru
            if ($course) {
                $postData['image'] = $course['image'];
            }
        }

        // Panggil fungsi updateCourse
        $result = updateCourse($postData);

        if ($result > 0) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.success('Data program sudah diperbaharui', 'Berhasil');
                    setTimeout(function() {
                        window.location.href = 'course_control.php';
                    }, 2500);
                });
            </script>";
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.warning('Belum ada perubahan yang dilakukan', 'Perhatian');
                });
            </script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luarsekolah | Dashboard</title>
    <link rel="stylesheet" href="../../src/css/admin.css">
    <link rel="icon" type="image/x-icon" href="../../assets/icon/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>

    </style>

</head>

<body>
    <div class="container">

        <!-- Header -->
        <?php include '../../components/header.php'; ?>
        <!-- End Of Header -->

        <main class="main">
            <!-- Sidebar Menu -->
            <?php renderSidebar('program'); ?>
            <!-- End Of Sidebar Menu -->

            <section class="page-content">
                <article class="board">
                    <!-- Course Edit -->
                    <p>Ubah Program</p>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $course['id'] ?>">
                        <label>Nama Program:</label>
                        <input type="text" name="title" value="<?= $course['title'] ?>" required>

                        <label>Deskripsi:</label>
                        <textarea name="description" required><?= $course['description'] ?></textarea>

                        <label>Poster:</label>
                        <input type="file" name="image" accept="image/*">
                        <img class="preview" src="../../pages/admin/banner/<?= $course['image'] ?>" alt="Current Image" width="500">
                        <br>

                        <label>Harga:</label>
                        <input type="number" name="price" value="<?= $course['price'] ?>" required>

                        <label>Tujuan Umum:</label>
                        <textarea name="General_Objectives" required><?= $course['General_Objectives'] ?></textarea>

                        <label>Tujuan Khusus:</label>
                        <textarea name="Specific_Objectives" required><?= $course['Specific_Objectives'] ?></textarea>

                        <label>Kelompok Sasaran:</label>
                        <textarea name="Target_Group" required><?= $course['Target_Group'] ?></textarea>

                        <label>Aspek Kompetensi:</label>
                        <textarea name="Competency_Aspects" required><?= $course['Competency_Aspects'] ?></textarea>

                        <section class="create-client">
                            <button type="submit" name="update_course"><i class="fas fa-plus"></i>Perbaharui Program</button>
                        </section>
                    </form>

                </article>
            </section>
        </main>
    </div>
    <script src="../../src/js/admin.js"></script>
</body>

</html>