<?php
session_start();

require "../../src/config/config.php";
include '../../components/sidebar.php';

requireAdminRole();
$courses = readCourses();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create_course'])) {
        // Cek dulu apakah title sudah ada, sebelum upload gambar
        $titleToCheck = htmlspecialchars($_POST['title']);
        $checkTitle = mysqli_query($connect, "SELECT id FROM course WHERE title = '$titleToCheck'");

        if (mysqli_fetch_assoc($checkTitle)) {
            // Title sudah ada, tampilkan pesan tanpa upload gambar
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.warning('Nama program sudah digunakan sebelumnya!', 'Perhatian');
            });
            </script>";
        } else {
            // Title belum ada, baru upload gambar
            $imagePath = uploadImage($_FILES['image']);
            if ($imagePath) {
                $_POST['image'] = $imagePath;
                $result = createCourse($_POST);
                if ($result > 0) {
                    echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        toastr.success('Program baru sudah ditambahkan', 'Berhasil');
                        setTimeout(function() {
                            window.location.href = 'course_control.php';
                        }, 2500);
                    });
                    </script>";
                } else {
                    echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        toastr.error('Terjadi kesalahan menambahkan data program', 'Gagal');
                    });
                    </script>";

                    // Hapus gambar jika gagal menyimpan ke database
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            } else {
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.error('Terjadi kesalahan mengirimkan gambar', 'Gagal');
                });
                </script>";
            }
        }
    }
}

if (isset($_POST['delete_course'])) {
    $id = $_POST['id'];
    $result = deleteCourse($id);
    if ($result > 0) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.success('Program sudah dihapus', 'Berhasil');
                setTimeout(function() {
                    window.location.href = 'course_control.php';
                }, 2000);
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.error('Terjadi kesalahan menghapus pengguna', 'Gagal');
            });
        </script>";
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
                    <!-- Add New Course -->
                    <p>Buat Program Baru</p>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="text" name="title" placeholder="Nama Program" required>
                        <textarea name="description" placeholder="Deskripsi" required></textarea>
                        <input type="file" name="image" accept="image/*" required>
                        <input type="number" name="price" placeholder="Harga" required>
                        <textarea name="General_Objectives" placeholder="Tujuan Umum" required></textarea>
                        <textarea name="Specific_Objectives" placeholder="Tujuan Khusus" required></textarea>
                        <textarea name="Target_Group" placeholder="Kelompok Sasaran" required></textarea>
                        <textarea name="Competency_Aspects" placeholder="Aspek Kompetensi" required></textarea>
                        <section class="create-client">
                            <button type="submit" name="create_course"><i class="fas fa-plus"></i>Buat Program</button>
                        </section>
                    </form>

                    <!-- Modified Course List Table -->
                    <p>Daftar Program</p>
                    <div class="table-container">
                        <div class="table-horizontal-container">
                            <table class="unfixed-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Program</th>
                                        <th>Pengaturan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($courses)) : ?>
                                        <tr class="empty-row">
                                            <td colspan="3">Belum ada program yang dibuat</td>
                                        </tr>
                                    <?php else : ?>
                                        <?php foreach ($courses as $course): ?>
                                            <tr>
                                                <td><?= $course['id'] ?></td>
                                                <td>
                                                    <span class="program-title" onclick="showProgramDetails(<?= htmlspecialchars(json_encode($course)) ?>)">
                                                        <?= $course['title'] ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <section class="control-client">
                                                        <a href="edit_course.php?id=<?= $course['id'] ?>">
                                                            <button type="submit"><i class="fas fa-edit"></i>Ubah</button>
                                                        </a>
                                                        <form action="" method="POST" style="display: inline;">
                                                            <input type="hidden" name="id" value="<?= $course['id'] ?>">
                                                            <button onclick="confirmDelete(event, this, 'delete_course')">
                                                                <i class="fas fa-trash"></i>Hapus
                                                            </button>
                                                        </form>
                                                    </section>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Updated Program Details Modal -->
                    <div id="programModal" class="program-modal">
                        <div class="program-modal-content">
                            <span class="close-modal"></span>
                            <div id="programDetails"></div>
                        </div>
                    </div>

</body>
<script src="../../src/js/admin.js"></script>
<script src="../../src/js/modal_course.js"></script>

</html>