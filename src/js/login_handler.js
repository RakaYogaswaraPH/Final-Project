document.addEventListener('DOMContentLoaded', function () {
    // Get form elements
    const checkbox = document.getElementById('chk');
    const navLoginBtn = document.querySelector('.nav-login-btn');
    const navRegisterBtn = document.querySelector('.nav-register-btn');

    // Function to show login form
    function showLoginForm() {
        checkbox.checked = true;
    }

    // Function to show register form
    function showRegisterForm() {
        checkbox.checked = false;
    }

    // Check localStorage on page load
    const selectedForm = localStorage.getItem('selectedForm');
    if (selectedForm === 'login') {
        showLoginForm();
    } else if (selectedForm === 'register') {
        showRegisterForm();
    }

    // Add event listeners for navbar buttons
    if (navLoginBtn) {
        navLoginBtn.addEventListener('click', function (e) {
            e.preventDefault();
            localStorage.setItem('selectedForm', 'login');
            showLoginForm();
        });
    }

    if (navRegisterBtn) {
        navRegisterBtn.addEventListener('click', function (e) {
            e.preventDefault();
            localStorage.setItem('selectedForm', 'register');
            showRegisterForm();
        });
    }

    // Clear localStorage after form is shown
    window.addEventListener('load', function () {
        localStorage.removeItem('selectedForm');
    });
});