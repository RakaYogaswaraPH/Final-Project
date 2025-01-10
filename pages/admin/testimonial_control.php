<?php
require "../../src/config/config.php";
include '../../components/sidebar.php';
$testimonials = getTestimonials();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create_testimonial'])) {
        $result = createTestimonial($connect, $_POST, $_FILES['image']);
        if ($result) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.success('Testimoni baru berhasil ditambahkan', 'Berhasil');
                setTimeout(function() {
                    window.location.href = 'testimonial_control.php';
                }, 2500);
            });
        </script>";
        } else {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.error('Terjadi kesalahan menambahkan testimoni', 'Gagal');
            });
        </script>";
        }
    }

    if (isset($_POST['update_testimonial'])) {
        $result = updateTestimonial($connect, $_POST, $_FILES['image']);
        if ($result) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.success('Testimoni berhasil diperbarui', 'Berhasil');
                setTimeout(function() {
                    window.location.href = 'testimonial_control.php';
                }, 2500);
            });
        </script>";
        } else {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.error('Terjadi kesalahan memperbarui testimoni', 'Gagal');
            });
        </script>";
        }
    }

    if (isset($_POST['delete_testimonial'])) {
        $result = deleteTestimonial($connect, $_POST['id']);
        if ($result) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.success('Testimoni berhasil dihapus', 'Berhasil');
                setTimeout(function() {
                    window.location.href = 'testimonial_control.php';
                }, 2500);
            });
        </script>";
        } else {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.error('Terjadi kesalahan menghapus testimoni', 'Gagal');
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
            <?php renderSidebar('testimoni'); ?>
            <!-- End Of Sidebar Menu -->

            <section class="page-content">
                <article class="board">
                    <p>Buat Testimoni Baru</p>
                    <!-- Add New Testimonial -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="file" name="image" accept="image/*" required>
                        <input type="text" name="name" placeholder="Nama" required>
                        <input type="text" name="course_name" placeholder="Nama Kelas" required>
                        <textarea type="text" name="review" placeholder="Kata-kata" required></textarea>
                        <select name="program_name" required>
                            <option value="Prakerja">Prakerja</option>
                            <option value="Indonesia Skills Week">Indonesia Skills Week</option>
                        </select>
                        <input type="text" name="linkedin" placeholder="LinkedIn URL" required>
                        <section class="create-client">
                            <button type="submit" name="create_testimonial"><i class="fas fa-plus"></i>Tambah Testimoni</button>
                        </section>
                    </form>

                    <!-- Testimonial List -->
                    <p>Daftar Testimoni</p>
                    <div class="table-container">
                        <div class="table-horizontal-container">
                            <table class="unfixed-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto Profil</th>
                                        <th>Nama</th>
                                        <th>Nama Kelas</th>
                                        <th>Kata - Kata</th>
                                        <th>Nama Program</th>
                                        <th>LinkedIn</th>
                                        <th>Pengaturan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($testimonials)) : ?>
                                        <tr class="empty-row">
                                            <td colspan="8">Belum ada testimonial yang dibuat</td>
                                        </tr>
                                    <?php else : ?>
                                        <?php foreach ($testimonials as $testimonial): ?>
                                            <tr>
                                                <td><?= $testimonial['id']; ?></td>
                                                <td><img src="profile/<?= $testimonial['image']; ?>" alt="Image" width="50"></td>
                                                <td><?= $testimonial['name']; ?></td>
                                                <td><?= $testimonial['course_name']; ?></td>
                                                <td><?= $testimonial['review']; ?></td>
                                                <td><?= $testimonial['program_name']; ?></td>
                                                <td><a href="<?= $testimonial['linkedin']; ?>" target="_blank">LinkedIn</a></td>
                                                <!-- Testimonial Settings -->
                                                <td>
                                                    <section class="control-client">
                                                        <button type="button" onclick="openEditModal(<?= htmlspecialchars(json_encode($testimonial)); ?>)">
                                                            <i class="fas fa-edit"></i>Ubah
                                                        </button>
                                                        <form action="" method="POST" style="display: inline;">
                                                            <input type="hidden" name="id" value="<?= $testimonial['id']; ?>">
                                                            <button onclick="confirmDelete(event, this, 'delete_testimonial')"><i class="fas fa-trash"></i>Hapus</button>
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
                </article>
            </section>
        </main>
    </div>
    <!-- Testimonial Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1>Ubah Testimoni</h1>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="edit_id">
                <div class="image-preview-container">
                    <label>Foto Profil:</label><br>
                    <img id="current_image" src="" alt="Current Image">
                    <input type="file" name="image" accept="image/*">
                </div>
                <label>Nama:</label>
                <input type="text" name="name" id="edit_name" required>
                <label>Nama Kelas:</label>
                <input type="text" name="course_name" id="edit_course_name" required>
                <label>Kata - Kata:</label>
                <textarea type="text" name="review" id="edit_review" required></textarea>
                <label>Nama Program:</label>
                <select name="program_name" id="edit_program_name" required>
                    <option value="Prakerja">Prakerja</option>
                    <option value="Indonesia Skills Week">Indonesia Skills Week</option>
                </select>
                <label>linkedIn:</label>
                <input type="text" name="linkedin" id="edit_linkedin" required>
                <button type="submit" name="update_testimonial">Perbaharui Testimoni</button>
            </form>
        </div>
    </div>

    <div id="imagePreviewModal" class="image-preview-modal">
        <span class="close-image-modal">&times;</span>
        <div class="modal-image-content">
            <img id="modalImage" src="" alt="Preview">
        </div>
    </div>
</body>
<script src="../../src/js/admin.js"></script>



</html>