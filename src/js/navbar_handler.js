document.addEventListener('DOMContentLoaded', function () {
    // Handler untuk tombol auth di navbar
    const navLoginBtn = document.querySelector('.nav-login-btn');
    const navRegisterBtn = document.querySelector('.nav-register-btn');

    // Menambahkan event listener untuk tombol Masuk
    navLoginBtn.addEventListener('click', function (e) {
        e.preventDefault();
        localStorage.setItem('selectedForm', 'signup');
        window.location.href = 'login.php';
    });

    // Menambahkan event listener untuk tombol Daftar
    navRegisterBtn.addEventListener('click', function (e) {
        e.preventDefault();
        localStorage.setItem('selectedForm', 'login');
        window.location.href = 'login.php';
    });
});



