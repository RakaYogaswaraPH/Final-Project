<?php
require "../../src/config/config.php";
include '../../components/sidebar.php';
$users = getUsers();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_user"])) {
    $id = $_POST["id"];
    if (deleteUsers($id)) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.success('Pengguna sudah dihapus', 'Berhasil');
                setTimeout(function() {
                    window.location.href = 'users_control.php';
                }, 2000);
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.error('Terjadi kesalahan menghapus data pengguna', 'Gagal');
            });
        </script>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_user"])) {
    $id = $_POST["id"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $role = $_POST["role"];

    try {
        if (editUsers($id, $username, $email, $role)) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.success('Data pengguna sudah diperbarui', 'Berhasil');
                    setTimeout(function() {
                        window.location.href = 'users_control.php';
                    }, 2000);
                });
            </script>";
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.warning('Belum ada perubahan yang dilakukan', 'Perhatian');
                });
            </script>";
        }
    } catch (Exception $e) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                toastr.error('Error: " . addslashes($e->getMessage()) . "', 'Error');
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
    <link rel="stylesheet" href="../../src/css/administrators.css">
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
            <?php renderSidebar('pengguna'); ?>
            <!-- End Of Sidebar Menu -->

            <section class="page-content">
                <article class="board">
                    <!-- Add New User -->
                    <p>Buat Pengguna Baru</p>
                    <form action="" method="POST">
                        <input type="text" name="username" placeholder="Nama" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <select name="role" required>
                            <option value="Admin">Administrator</option>
                            <option value="User">Peserta</option>
                            <option value="Trainer">Pelatih</option>
                        </select>
                        <section class="create-client">
                            <button type="submit" name="add_user"><i class="fas fa-plus"></i>Buat Pengguna</button>
                        </section>
                    </form>

                    <!-- User List -->
                    <p>Daftar Pengguna</p>
                    <div class="table-container">
                        <div class="table-horizontal-container">
                            <table class="unfixed-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Bagian</th>
                                        <th>Pengaturan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($users)) : ?>
                                        <tr class="empty-row">
                                            <td colspan="5">Belum ada pengguna yang terdaftar</td>
                                        </tr>
                                    <?php else : ?>
                                        <?php foreach ($users as $user) : ?>
                                            <tr>
                                                <td><?= $user['id']; ?></td>
                                                <td><?= $user['username']; ?></td>
                                                <td><?= $user['email']; ?></td>
                                                <td><?= $user['role']; ?></td>

                                                <!-- User Settings -->
                                                <td class="aksi">
                                                    <form action="" method="POST" style="display: inline;">
                                                        <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                                        <input type="nama" name="username" value="<?= $user['username']; ?>">
                                                        <input type="email" name="email" value="<?= $user['email']; ?>" required>
                                                        <select name="role" required>
                                                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                                            <option value="user" <?= $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                                                            <option value="trainer" <?= $user['role'] == 'trainer' ? 'selected' : ''; ?>>Trainer</option>
                                                        </select>
                                                        <section class="control-client">
                                                            <button type="submit" name="edit_user"><i class="fas fa-edit"></i>Ubah</button>
                                                            <button onclick="confirmDelete(event, this, 'delete_user')"><i class="fas fa-trash"></i>Hapus</button>
                                                        </section>
                                                    </form>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </article>
                <div>
                </div>
            </section>
        </main>
    </div>
</body>
<script src="../../src/js/admins.js"></script>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_user"])) {
    $result = addUsers($_POST);
    if ($result === "EMAIL_EXISTS") {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.error('Email sudah terdaftar!', 'Gagal');
                });
            </script>";
    } elseif ($result > 0) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.success('Pengguna baru sudah ditambahkan', 'Berhasil');
                    setTimeout(function() {
                        window.location.href = 'users_control.php';
                    }, 2500);
                });
            </script>";
        exit();
    } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.error('Terjadi kesalahan membuat pengguna baru', 'Gagal');
                });
            </script>";
    }
}
?>

</html>