<?php
$username = $_SESSION['username'] ?? 'Fasilitator';
?>
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
<header>
    <nav class="header-nav">
        <div class="logo">
            <a class="active nav-item">
                <img src="../../assets/img/luarsekolah-logo.png" alt="Logo" />
            </a>
        </div>
        <div class="user" id="user">
            <a class="user-link"><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></a>
            <div class="user-img-wrapper">
                <img src="../../assets/img/user.png" alt="Icon" />
            </div>
            <div class="user-dropdown-menu">
                <a href="#" id="logout-btn">
                    <i class="ri-logout-box-r-line"></i> Keluar
                </a>
            </div>
        </div>
    </nav>
</header>

<!-- Modal Konfirmasi Logout -->
<div id="logout-confirm-modal" class="logout-modal">
    <div class="logout-modal-content">
        <div class="logout-modal-header">
            <h2>Konfirmasi</h2>
            <span class="logout-modal-close">&times;</span>
        </div>
        <div class="logout-modal-body">
            <h2>Apakah Anda yakin ingin keluar?</h2>
        </div>
        <div class="logout-modal-footer">
            <button id="cancel-logout-btn" class="logout-btn logout-btn-secondary">Batal</button>
            <a href="../../components/logout.php" class="logout-btn logout-btn-primary">
                <i class="ri-logout-box-r-line"></i> Ya, Keluar
            </a>
        </div>
    </div>
</div>

<script src="../../src/js/modal_adminLogout.js"></script>
