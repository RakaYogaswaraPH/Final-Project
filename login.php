<?php
require "src/config/config.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $result = registers($_POST);
        if ($result > 0) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.success('Berhasil Mendaftar', 'Berhasil');
                    setTimeout(function() {
                        window.location.href = '/pages/user/home.php';
                    }, 2000);
                });
            </script>";
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    toastr.error('Terjadi kesalahan saat mendaftar', 'Gagal');
                });
            </script>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['login'])) {
            $email = mysqli_real_escape_string($connect, $_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (!empty($email) && !empty($password)) {
                // Query langsung ke database
                $query = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($connect, $query);

                if (mysqli_num_rows($result) === 1) {
                    $user = mysqli_fetch_assoc($result);

                    if (password_verify($password, $user['password'])) {
                        session_start();
                    
                        // Gunakan key unik berdasarkan role
                        $roleKey = $user['role']; // Contoh: 'admin', 'trainer', 'user'
                    
                        // Set session untuk role tertentu
                        $_SESSION[$roleKey] = [
                            'login' => true,
                            'username' => $user['username'],
                        ];
                    
                        // Redirect sesuai role
                        if ($roleKey === 'admin') {
                            header("Location: ./pages/admin/dashboard.php");
                        } elseif ($roleKey === 'trainer') {
                            header("Location: ./pages/trainer/home.php");
                        } elseif ($roleKey === 'user') {
                            header("Location: ./pages/user/home.php");
                        } else {
                            header("Location: ./login.php");
                        }
                        exit();
                    }
                    
                    else {
                        echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                toastr.error('Password salah', 'Gagal');
                            });
                        </script>";
                    }
                } else {
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            toastr.error('Email tidak terdaftar', 'Gagal');
                        });
                    </script>";
                }
            } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        toastr.warning('Email dan password harus diisi', 'Peringatan');
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
    <title>Luarsekolah | #sampaijadibisa</title>
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/auth.css">
    <link rel="icon" type="image/x-icon" href="assets/icon/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>

<body>

    <!-- Navigation Bar -->
    <?php include 'components/navbar.php'; ?>
    <!-- End Of Navigation Bar -->

    <section class="gate">
        <div class="main">
            <input type="checkbox" id="chk" aria-hidden="true">

            <div class="signup" id="signup">
                <form method="post" action="">
                    <label for="chk" aria-hidden="true">Selamat Datang</label>
                    <input type="text" name="username" placeholder="Nama Pengguna" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="re-password" placeholder="Re-Password" required>
                    <button type="submit" name="register">Daftar Sekarang</button>
                    <div class="signup-switch-text">
                        Sudah memiliki akun?
                        <a href="#" onclick="document.getElementById('chk').click();">Masuk sekarang</a>
                    </div>
                </form>
            </div>

            <div class="login" id="login">
                <form method="post" action="">
                    <label for="chk" aria-hidden="true">Mari Memulai</label>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button button type="submit" name="login">Masuk</button>
                    <div class="switch-text">
                        Belum memiliki akun?
                        <a href="#" onclick="document.getElementById('chk').click();">Daftar sekarang</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

</body>
<script src="src/js/toastr.js"></script>

</html>