<?php
$username = $_SESSION['username'] ?? 'Administrator';
?>

<nav class="navbar-custom">
    <div class="wrapper-custom">
        <div class="logo-custom">
            <img src="../../assets/img/luarsekolah-logo.png" alt="Logo">
        </div>
        <div class="nav-container-custom">
            <ul class="nav-links-custom">
                <li><a href="home.php">Beranda</a></li>
                <li><a href="isw.php">Program</a></li>
            </ul>
            <div class="profile-custom">
                <i class="fas fa-user-circle"></i>
                <a href="../../components/logout.php"><span><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></span></a>
            </div>
        </div>
    </div>
</nav>

<button id="back-to-top" class="back-to-top">
    <i class="ri-arrow-up-s-line"></i>
</button>