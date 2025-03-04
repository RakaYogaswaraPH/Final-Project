<?php
$username = $_SESSION['username'] ?? 'User';
?>

<nav class="navbar-custom">
    <div class="wrapper-custom">
        <div class="logo-custom">
            <a href="index.php"><img src="../../assets/img/luarsekolah-logo.png" alt="Logo"></a>
        </div>
        <div class="nav-container-custom">
            <ul class="nav-links-custom">
                <li><a href="home.php">Kelas</a></li>
                <li><a href="community.php">Komunitas</a></li>
                <li>
                    <a href="#" class="desktop-item-custom">Program</a>
                    <input type="checkbox" id="showDrop-custom">
                    <label for="showDrop-custom" class="mobile-item-custom">Program</label>
                    <ul class="drop-menu-custom">
                        <li><a href="prakerja.php">Prakerja</a></li>
                        <li><a href="https://belajarbekerja.com/" target="_blank">Belajar Bekerja</a></li>
                        <li><a href="isw.php">ISW</a></li>
                    </ul>
                </li>
            </ul>
            <div class="profile-custom">
                <i class="fas fa-user-circle"></i>
                <span><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></span>
                <div class="logout-dropdown">
                    <a href="#" id="logoutBtn">
                        <i class="ri-logout-box-r-line"></i> Keluar
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<button id="back-to-top" class="back-to-top">
    <i class="ri-arrow-up-s-line"></i>
</button>

<!-- Add Logout Confirmation Modal -->
<div id="logoutModals" class="modals">
    <div class="modals-content">
        <h3>Konfirmasi Keluar</h3>
        <p>Apakah Anda yakin ingin keluar?</p>
        <div class="modals-buttons">
            <button class="modals-btn cancel-btn" id="cancelLogout">Batal</button>
            <button class="modals-btn confirm-btn" id="confirmLogout">
                <i class="ri-logout-box-r-line"></i> Ya, Keluar
            </button>
        </div>
    </div>
</div>

<script src="../../src/js/modal_logout.js"></script>