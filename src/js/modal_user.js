document.addEventListener('DOMContentLoaded', function() {
    const modalOverlay = document.getElementById('editModalOverlay');
    const modal = document.getElementById('editModal');
    const closeModalBtn = document.querySelector('.close-modal');
    const cancelBtn = document.querySelector('.modal-cancel');
    const editButtons = document.querySelectorAll('.edit-btn');

    // Open modal with user data when edit button is clicked
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            const username = this.getAttribute('data-username');
            const email = this.getAttribute('data-email');
            const role = this.getAttribute('data-role');

            document.getElementById('editUserId').value = userId;
            document.getElementById('editUsername').value = username;
            document.getElementById('editEmail').value = email;
            document.getElementById('editRole').value = role;

            // Show modal with animation
            modalOverlay.style.display = 'block';
            setTimeout(() => {
                modalOverlay.classList.add('active');
                modal.classList.add('active');
            }, 10);
        });
    });

    // Close modal functions
    function closeModal() {
        modalOverlay.classList.remove('active');
        modal.classList.remove('active');
        setTimeout(() => {
            modalOverlay.style.display = 'none';
        }, 300);
    }

    closeModalBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    // Close modal when clicking outside
    modalOverlay.addEventListener('click', function(event) {
        if (event.target === modalOverlay) {
            closeModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && modalOverlay.classList.contains('active')) {
            closeModal();
        }
    });
});