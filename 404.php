<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/404.css">
    <link rel="icon" type="image/x-icon" href="assets/icon/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <title>Halaman Tidak Ditemukan</title>
</head>

<body>
    <!-- Navigation Bar -->
    <?php include 'components/navbar.php'; ?>
    <!-- End Of Navigation Bar -->

    <div class="containers">
        <div class="contents">
            <div class="image-container">
                <img src="assets/animation/empty-emot.svg" alt="404 illustration">
            </div>
            <div class="text-content">
                <h1>Oh Tidak!</h1>
                <h2>Sepertinya kamu tidak menemukan halaman yang kamu cari, mari kembali ke <a class="shortcut" href="index.php">beranda</a></h2>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'components/footer.php'; ?>
    <!-- End Of Footer -->

</body>
<script src="src/js/script.js"></script>

</html>