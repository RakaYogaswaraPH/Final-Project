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
                <li><a href="community.php">Komunitas</a></li>
                <li>
                    <a href="#" class="desktop-item-custom">Program</a>
                    <input type="checkbox" id="showDrop-custom">
                    <label for="showDrop-custom" class="mobile-item-custom">Program</label>
                    <ul class="drop-menu-custom">
                        <li><a href="prakerja.php">Prakerja</a></li>
                        <li><a href="prakerja.php">Belajar Bekerja</a></li>
                        <li><a href="isw.php">ISW</a></li>
                    </ul>
                </li>
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