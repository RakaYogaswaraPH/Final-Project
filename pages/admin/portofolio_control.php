<?php
session_start();

require "../../src/config/config.php";
include '../../components/sidebar.php';

requireAdminRole();
$portofolios = getPortofolios();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add_portofolio"])) {
        // Cek dulu apakah nama peserta sudah ada
        $usernameToCheck = htmlspecialchars($_POST['username']);
        $checkUsername = mysqli_query($connect, "SELECT id FROM portofolio WHERE username = '$usernameToCheck'");

        if (mysqli_fetch_assoc($checkUsername)) {
            // Nama peserta sudah ada, tampilkan pesan peringatan
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.warning('Nama peserta sudah memiliki portofolio!', 'Perhatian');
            });
            </script>";
        } else {
            // Nama peserta belum ada, lanjutkan proses
            $result = createPortofolio($connect, $_POST, $_FILES['image']);
            if ($result) {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        toastr.success('Portofolio baru sudah ditambahkan', 'Berhasil');
                        setTimeout(function() {
                            window.location.href = 'portofolio_control.php';
                        }, 2000);
                    });
                </script>";
            } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        toastr.error('Gagal menambahkan portofolio', 'Error');
                    });
                </script>";
            }
        }
    } elseif (isset($_POST["delete_portofolio"])) {
        $id = $_POST["id"];
        if (deletePortofolio($connect, $id)) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.success('Portofolio berhasil dihapus', 'Berhasil');
                    setTimeout(function() {
                        window.location.href = 'portofolio_control.php';
                    }, 2000);
                });
            </script>";
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.error('Gagal menghapus portofolio', 'Error');
                });
            </script>";
        }
    } elseif (isset($_POST["update_portofolio"])) {
        // Cek apakah nama peserta yang diupdate sudah ada selain data yang sedang diupdate
        $id = $_POST["id"];
        $usernameToCheck = htmlspecialchars($_POST['username']);
        $checkUsername = mysqli_query($connect, "SELECT id FROM portofolio WHERE username = '$usernameToCheck' AND id != $id");

        if (mysqli_fetch_assoc($checkUsername)) {
            // Nama peserta sudah ada di data lain, tampilkan pesan peringatan
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.warning('Nama peserta sudah memiliki portofolio!', 'Perhatian');
            });
            </script>";
        } else {
            // Nama peserta belum ada atau milik data yang sedang diupdate, lanjutkan
            $result = updatePortofolio($connect, $_POST, $_FILES['image']);
            if ($result) {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        toastr.success('Portofolio berhasil diperbarui', 'Berhasil');
                        setTimeout(function() {
                            window.location.href = 'portofolio_control.php';
                        }, 2000);
                    });
                </script>";
            } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        toastr.error('Gagal memperbarui portofolio', 'Error');
                    });
                </script>";
            }
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
            <?php renderSidebar('portofolio'); ?>
            <!-- End Of Sidebar Menu -->

            <section class="page-content">
                <article class="board">
                    <p>Buat Portoflio Baru</p>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="text" name="project_name" placeholder="Judul Portofolio" required>
                        <input type="text" name="project_link" placeholder="Link Portofolio" required>
                        <input type="text" name="username" placeholder="Nama Peserta" required>
                        <select name="program_name" required>
                            <option value="Prakerja">Prakerja</option>
                            <option value="Indonesia Skills Week">Indonesia Skills Week</option>
                        </select>
                        <input type="file" name="image" accept="image/*" required>
                        <section class="create-client">
                            <button type="submit" name="add_portofolio"><i class="fas fa-plus"></i>Buat Portolio</button>
                        </section>
                    </form>

                    <!-- portofolio List -->
                    <p>Daftar Portoflio</p>
                    <div class="table-container">
                        <div class="table-horizontal-container">
                            <table class="unfixed-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Judul</th>
                                        <th>Link</th>
                                        <th>Nama Peserta</th>
                                        <th>Program</th>
                                        <th>Pengaturan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($portofolios)) : ?>
                                        <tr class="empty-row">
                                            <td colspan="8">Belum ada portofolio yang dibuat</td>
                                        </tr>
                                    <?php else : ?>
                                        <?php foreach ($portofolios as $index => $portofolio): ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td><img src="portofolio/<?= $portofolio['image']; ?>" alt="Image" width="50"></td>
                                                <td><?= $portofolio['project_name']; ?></td>
                                                <td><a href="<?= $portofolio['project_link']; ?>" target="_blank">Link</a></td>
                                                <td><?= $portofolio['username']; ?></td>
                                                <td><?= $portofolio['program_name']; ?></td>
                                                <!-- portofolio Settings -->
                                                <td>
                                                    <section class="control-client">
                                                        <button type="button" onclick="openEditModalPortofolio(<?= htmlspecialchars(json_encode($portofolio)); ?>)">
                                                            <i class="fas fa-edit"></i>Ubah
                                                        </button>
                                                        <form action="" method="POST" style="display: inline;">
                                                            <input type="hidden" name="id" value="<?= $portofolio['id']; ?>">
                                                            <button onclick="confirmDelete(event, this, 'delete_portofolio')">
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
                </article>
            </section>
        </main>
    </div>

    <!-- portofolio Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1>Ubah Portofolio</h1>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="edit_id">
                <div class="image-preview-container">
                    <label>Foto Portofolio:</label><br>
                    <img id="current_image" src="" alt="Current Image">
                    <input type="file" name="image" accept="image/*">
                </div>
                <label>Judul:</label>
                <input type="text" name="project_name" id="project_name" required>
                <label>Nama Peserta:</label>
                <input type="text" name="username" id="username" required>
                <label>Nama Program:</label>
                <select name="program_name" id="program_name" required>
                    <option value="Prakerja">Prakerja</option>
                    <option value="Indonesia Skills Week">Indonesia Skills Week</option>
                </select>
                <label>Link Portofolio:</label>
                <input type="text" name="project_link" id="project_link" required>
                <button type="submit" name="update_portofolio">Perbaharui Testimoni</button>
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
<script src="../../src/js/modal.js"></script>

</html>