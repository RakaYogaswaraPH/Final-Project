// Add this JavaScript code to your script file or in a script tag
document.addEventListener('DOMContentLoaded', function () {
    // Get modal elements
    const modal = document.getElementById('programModal');
    const closeButton = document.querySelector('.close-button');
    const subscriptionBtn = document.querySelector('.subscription-btn');

    // Open modal when clicking the subscription button
    subscriptionBtn.addEventListener('click', function (e) {
        e.preventDefault();
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    });

    // Close modal when clicking the close button
    closeButton.addEventListener('click', function () {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto'; // Restore scrolling
    });

    // Close modal when clicking outside the modal content
    window.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });
});