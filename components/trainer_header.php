<?php
$username = $_SESSION['username'] ?? 'Fasilitator';
?>

<header>
    <nav class="header-nav">
        <div class="logo">
            <a class="active nav-item">
                <img src="../../assets/img/luarsekolah-logo.png" alt="Logo" />
            </a>
        </div>
        <div class="user" id="user">
            <a href="../../components/logout.php" class="user-link"><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></a>
            <div class="user-img-wrapper">
                <img src="../../assets/img/user.png" alt="Icon" />
            </div>
        </div>
    </nav>
</header>