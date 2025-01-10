<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luarsekolah | Kelas</title>
    <link rel="stylesheet" href="../../src/css/style.css">
    <link rel="stylesheet" href="../../src/css/users.css">
    <link rel="icon" type="image/x-icon" href="../../assets/icon/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">

</head>

<body>

    <!-- Navigation Bar -->
    <?php include '../../components/user_navbar.php'; ?>
    <!-- End Of Navigation Bar -->

    <main class="main-content">
        <section class="welcome-section">
            <h1>Selamat datang Raka Yogaswara Pratama Husaeni!</h1>
            <p>Semoga aktivitas belajarmu menyenangkan.</p>
        </section>

        <div class="subscription-card">
            <h2 class="subscription-status">Status Langganan</h2>
            <div class="subscription-message">
                <span>📄</span>
                <p>Anda belum berlangganan Dicoding Academy. Pilih paket langganan dan mulai lah perjalanan Anda menjadi developer profesional.</p>
            </div>
            <button class="subscription-btn">Pilih paket langganan</button>
        </div>

        <div class="activities-container">
            <div class="activity-card">
                <div class="activity-header">
                    <span>📚</span>
                    <h3>Aktivitas Belajar</h3>
                </div>
                <div class="course-item">
                    <div>Menjadi Front-End Web Developer Expert</div>
                    <a href="#" class="continue-btn">Lanjutkan</a>
                </div>
                <div class="course-item">
                    <div>Belajar Membuat Aplikasi Web dengan React</div>
                    <a href="#" class="continue-btn">Lanjutkan</a>
                </div>
            </div>

            <div class="activity-card">
                <div class="activity-header">
                    <span>📊</span>
                    <h3>Aktivitas Lain</h3>
                </div>
                <p style="color: #666; margin-bottom: 1rem;">Belum ada aktivitas.</p>
                <div class="activity-icons">
                    <div class="activity-icon-card">
                        <div style="font-size: 2rem; margin-bottom: 0.5rem;">📅</div>
                        <div>Telusuri event dari Dicoding</div>
                    </div>
                    <div class="activity-icon-card">
                        <div style="font-size: 2rem; margin-bottom: 0.5rem;">🚀</div>
                        <div>Telusuri challenge dari Dicoding</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>