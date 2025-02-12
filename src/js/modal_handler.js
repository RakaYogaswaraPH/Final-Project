document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('authModal');
    const closeBtn = document.getElementsByClassName('close')[0];
    const buyButton = document.querySelector('.voucher-btn');
    const loginBtn = document.querySelector('.login-btn');
    const registerBtn = document.querySelector('.register-btn');

    buyButton.setAttribute('href', '#');

    function openModal() {
        modal.style.display = 'block';
        modal.offsetHeight;
        modal.classList.add('show');
    }

    function closeModal() {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    buyButton.onclick = function (e) {
        e.preventDefault();
        openModal();
    }

    closeBtn.onclick = closeModal;

    window.onclick = function (event) {
        if (event.target == modal) {
            closeModal();
        }
    }

    // Menyimpan form yang dipilih ke localStorage
    loginBtn.onclick = function () {
        localStorage.setItem('selectedForm', 'signup');
    }

    registerBtn.onclick = function () {
        localStorage.setItem('selectedForm', 'login');
    }
});