<header>
    <nav>
        <div class="wrapper">
            <div class="logo"> <a class="logo d-flex align-items-center">
                    <img src="assets/img/luarsekolah-logo.png" alt="logo">
                </a>
            </div>
            <input type="radio" name="slider" id="menu-btn">
            <input type="radio" name="slider" id="close-btn">
            <ul class="nav-links">
                <label for="close-btn" class="btn close-btn"><i class="fas fa-times"></i></label>
                <li><a href="index.php#about">Tentang Kami</a></li>
                <li><a href="community.php">Komunitas</a></li>
                <li>
                    <a href="#" class="desktop-item">Program</a>
                    <input type="checkbox" id="showDrop">
                    <label for="showDrop" class="mobile-item">Program</label>
                    <ul class="drop-menu">
                        <li><a href="prakerja.php">Prakerja</a></li>
                        <li><a href="https://belajarbekerja.com/" target="_blank">Belajar Bekerja</a></li>
                        <li><a href="isw.php">ISW</a></li>
                    </ul>
                </li>
                <li><a href="login.php" class="nav-login-btn" data-form="login">Masuk</a></li>
                <li><a href="login.php" class="nav-register-btn" data-form="signup">Daftar</a></li>
            </ul>
            <label for="menu-btn" class="btn menu-btn"><i class="fas fa-bars"></i></label>
        </div>
    </nav>
</header>

<button id="back-to-top" class="back-to-top">
    <i class="ri-arrow-up-s-line"></i>
</button>

<style>
    .nav-links {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .nav-links li a.nav-login-btn {
        color: #00BA88;
        padding: 8px 24px;
        border: 1px solid #00BA88;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .nav-links li a.nav-login-btn:hover {
        background: rgba(0, 186, 136, 0.1);
    }

    .nav-links li a.nav-register-btn {
        color: white;
        padding: 8px 24px;
        background: #00BA88;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .nav-links li a.nav-register-btn:hover {
        background: #00A578;
    }
</style>