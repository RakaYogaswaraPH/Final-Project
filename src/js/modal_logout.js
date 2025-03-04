document.addEventListener('DOMContentLoaded', function () {
    const logoutBtn = document.getElementById('logoutBtn');
    const logoutModals = document.getElementById('logoutModals');
    const cancelLogout = document.getElementById('cancelLogout');
    const confirmLogout = document.getElementById('confirmLogout');

    // Show modal with animation when logout button is clicked
    logoutBtn.addEventListener('click', function (e) {
        e.preventDefault();
        logoutModals.style.display = 'flex';
        // Trigger reflow before adding the class for the animation to work
        void logoutModals.offsetWidth;
        logoutModals.classList.add('show');
    });

    // Hide modal with animation when cancel button is clicked
    cancelLogout.addEventListener('click', function () {
        closeModalWithAnimation();
    });

    // Redirect to logout page when confirm button is clicked
    confirmLogout.addEventListener('click', function () {
        window.location.href = '../../components/logout.php';
    });

    // Hide modal when clicking outside of it
    window.addEventListener('click', function (event) {
        if (event.target === logoutModals) {
            closeModalWithAnimation();
        }
    });

    // Function to close modal with animation
    function closeModalWithAnimation() {
        logoutModals.classList.remove('show');
        // Wait for animation to complete before hiding the modal
        setTimeout(function () {
            logoutModals.style.display = 'none';
        }, 300); // Match this duration with CSS transition time
    }
});