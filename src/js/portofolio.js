// Portofolio slider
document.addEventListener('DOMContentLoaded', function () {
    const portofolioTrack = document.querySelector('.portofolio-track');
    const portofolioPrev = document.querySelector('.portofolio-prev');
    const portofolioNext = document.querySelector('.portofolio-next');
    const portofolioItems = document.querySelectorAll('.portofolio-item');
    let portofolioIndex = 0;

    function getportofolioWidth() {
        const item = portofolioItems[0];
        const style = window.getComputedStyle(item);
        const margin = parseFloat(style.marginLeft) + parseFloat(style.marginRight);
        return item.offsetWidth + margin;
    }

    function updateportofolioSlider() {
        const itemWidth = getportofolioWidth();
        portofolioTrack.style.transform = `translateX(-${portofolioIndex * itemWidth}px)`;
    }

    function updateportofolioButtons() {
        portofolioPrev.style.display = portofolioIndex === 0 ? 'none' : 'flex';
        portofolioNext.style.display = portofolioIndex >= portofolioItems.length - getVisibleportofolios() ? 'none' : 'flex';
    }

    function getVisibleportofolios() {
        const containerWidth = document.querySelector('.portofolio-wrapper').offsetWidth;
        const itemWidth = getportofolioWidth();
        return Math.floor(containerWidth / itemWidth);
    }

    portofolioPrev.addEventListener('click', () => {
        if (portofolioIndex > 0) {
            portofolioIndex--;
            updateportofolioSlider();
            updateportofolioButtons();
        }
    });

    portofolioNext.addEventListener('click', () => {
        if (portofolioIndex < portofolioItems.length - getVisibleportofolios()) {
            portofolioIndex++;
            updateportofolioSlider();
            updateportofolioButtons();
        }
    });

    window.addEventListener('resize', () => {
        portofolioIndex = 0;
        updateportofolioSlider();
        updateportofolioButtons();
    });

    updateportofolioButtons();
});