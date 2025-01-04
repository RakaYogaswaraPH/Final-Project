<?php
require "src/config/config.php";

if (isset($_POST["register"])) {
    if (registers($_POST) > 0) {
        $_SESSION["login"] = true;
        echo "<script>
        alert('Berhasil Masuk');
        document.location.href = '/pages/user/home.php';
        </script>";
        exit;
    } else {
        echo mysqli_error($connect);
    }
}

if (isset($_POST["login"])) {
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $result = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email'");

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row["password"])) {
                $_SESSION["login"] = true;
                $_SESSION["role"] = $row["role"];

                if ($row["role"] === "admin") {
                    echo "<script>
                    alert('Berhasil Masuk sebagai Admin');
                    document.location.href = 'pages/admin/dashboard.php';
                    </script>";
                } else {
                    echo "<script>
                    alert('Berhasil Masuk');
                    document.location.href = 'views/users/home.php';
                    </script>";
                }
                exit;
            } else {
                echo "<script>
                alert('Password Tidak Sesuai!');
                document.location.href = 'login.php';
                </script>";
            }
        } else {
            echo "<script>
            alert('Email Tidak Terdaftar!');
            document.location.href = 'login.php';
            </script>";
        }
    } else {
        echo "<script>
        alert('Email dan Password harus diisi!');
        document.location.href = 'login.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luarsekolah</title>
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/auth.css">
    <link rel="icon" type="image/x-icon" href="assets/icon/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>

    <!-- Navigation Bar -->
    <?php include 'components/navbar.php'; ?>
    <!-- End Of Navigation Bar -->

    <section class="gate">
        <div class="main">
            <input type="checkbox" id="chk" aria-hidden="true">

            <div class="signup" id="signup">
                <form action="" method="post">
                    <label for="chk" aria-hidden="true">Selamat Datang</label>
                    <input type="text" name="username" placeholder="Nama Pengguna" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="re-password" placeholder="Re-Password" required>
                    <button type="submit" name="register">Daftar Sekarang</button>
                </form>
            </div>

            <div class="login" id="login">
                <form action="" method="post">
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

</html>