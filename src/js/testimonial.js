document.addEventListener('DOMContentLoaded', function () {
    const sliderContainer = document.querySelector('.slider-container');
    const prevButton = document.querySelector('.prev-button');
    const nextButton = document.querySelector('.next-button');
    const cards = document.querySelectorAll('.testimonial-card');

    let currentIndex = 0;
    const cardWidth = cards[0].offsetWidth + 20; // Include margin

    function getVisibleCardCount() {
        const sliderWidth = sliderContainer.offsetWidth;
        return Math.floor(sliderWidth / cardWidth);
    }

    function updateSlider() {
        sliderContainer.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
    }

    prevButton.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateSlider();
        }
    });

    nextButton.addEventListener('click', () => {
        const visibleCards = getVisibleCardCount();
        if (currentIndex < cards.length - visibleCards) {
            currentIndex++;
            updateSlider();
        }
    });

    // Responsive handling
    window.addEventListener('resize', () => {
        currentIndex = 0; // Reset index on resize to avoid layout issues
        updateSlider();
    });
});
