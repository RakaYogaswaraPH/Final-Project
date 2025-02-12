document.addEventListener('DOMContentLoaded', function () {
    const sliderContainer = document.querySelector('.slider-container');
    const prevButton = document.querySelector('.prev-button');
    const nextButton = document.querySelector('.next-button');
    const cards = document.querySelectorAll('.testimonial-card');

    let currentIndex = 0;

    function calculateCardWidth() {
        const card = cards[0]
        const style = window.getComputedStyle(card);
        return card.offsetWidth +
            parseInt(style.marginLeft || 0) +
            parseInt(style.marginRight || 0) +
            25; // Include the gap
    }

    function getVisibleCardCount() {
        const containerWidth = document.querySelector('.testimonial-section').offsetWidth;
        const cardWidth = calculateCardWidth();
        return Math.floor(containerWidth / cardWidth);
    }

    function getMaxTranslate() {
        const cardWidth = calculateCardWidth();
        const visibleCards = getVisibleCardCount();
        const totalWidth = cardWidth * cards.length;
        const containerWidth = document.querySelector('.testimonial-section').offsetWidth;

        // Calculate maximum translation needed
        return Math.max(0, totalWidth - containerWidth);
    }

    function updateSlider() {
        const cardWidth = calculateCardWidth();
        const maxTranslate = getMaxTranslate();

        // Calculate current translation
        const translateX = Math.min(currentIndex * cardWidth, maxTranslate);

        // Apply transform
        sliderContainer.style.transform = `translateX(-${translateX}px)`;

        // Update button states
        prevButton.style.opacity = currentIndex <= 0 ? '0.5' : '1';
        prevButton.style.cursor = currentIndex <= 0 ? 'not-allowed' : 'pointer';

        // Check if we've reached the last possible position
        const isAtEnd = translateX >= maxTranslate;
        nextButton.style.opacity = isAtEnd ? '0.5' : '1';
        nextButton.style.cursor = isAtEnd ? 'not-allowed' : 'pointer';
    }

    prevButton.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateSlider();
        }
    });

    nextButton.addEventListener('click', () => {
        const cardWidth = calculateCardWidth();
        const maxTranslate = getMaxTranslate();
        const nextTranslate = (currentIndex + 1) * cardWidth;

        // Only move if next translation won't exceed max translate
        if (nextTranslate <= maxTranslate) {
            currentIndex++;
            updateSlider();
        }
    });

    // Handle window resize
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            // Reset position if current translation is beyond maximum
            const maxTranslate = getMaxTranslate();
            const currentTranslate = currentIndex * calculateCardWidth();

            if (currentTranslate > maxTranslate) {
                currentIndex = Math.floor(maxTranslate / calculateCardWidth());
            }

            updateSlider();
        }, 250);
    });

    // Initial setup
    updateSlider();
});