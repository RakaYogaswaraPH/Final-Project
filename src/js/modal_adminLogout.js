document.addEventListener('DOMContentLoaded', function () {
    const userDiv = document.getElementById('user');
    const logoutBtn = document.getElementById('logout-btn');
    const modal = document.getElementById('logout-confirm-modal');
    const modalContent = document.querySelector('.logout-modal-content');
    const closeBtn = document.querySelector('.logout-modal-close');
    const cancelBtn = document.getElementById('cancel-logout-btn');

    // Dropdown animasi hover
    userDiv.addEventListener('mouseenter', function () {
        userDiv.classList.add('show-user-dropdown');
    });

    userDiv.addEventListener('mouseleave', function () {
        userDiv.classList.remove('show-user-dropdown');
    });

    // Animasi buka modal
    logoutBtn.addEventListener('click', function (e) {
        e.preventDefault();
        modal.classList.add('show');
        setTimeout(() => {
            modalContent.classList.add('show');
        }, 10);
    });

    // Animasi tutup modal
    function closeModalWithAnimation() {
        modalContent.classList.remove('show');
        modal.classList.add('hide');

        setTimeout(() => {
            modal.classList.remove('show', 'hide');
        }, 300);
    }

    closeBtn.addEventListener('click', closeModalWithAnimation);
    cancelBtn.addEventListener('click', closeModalWithAnimation);

    window.addEventListener('click', function (e) {
        if (e.target == modal) {
            closeModalWithAnimation();
        }
    });
});