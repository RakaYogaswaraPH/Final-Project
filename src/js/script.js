// Dynamic Text 
document.addEventListener("DOMContentLoaded", function () {
    const dynamicText = document.getElementById("dynamic-text");
    const texts = [
        "Berani untuk memulai",
        "Terbaharu dan Terkurasi",
        "Relevan dengan Zaman",
    ];
    let textIndex = 0;
    let charIndex = 0;

    function typeEffect() {
        if (charIndex < texts[textIndex].length) {
            dynamicText.textContent += texts[textIndex].charAt(charIndex);
            charIndex++;
            setTimeout(typeEffect, 100);
        } else {
            setTimeout(deleteEffect, 1000);
        }
    }

    function deleteEffect() {
        if (charIndex > 0) {
            dynamicText.textContent = texts[textIndex].substring(0, charIndex - 1);
            charIndex--;
            setTimeout(deleteEffect, 50);
        } else {
            textIndex = (textIndex + 1) % texts.length;
            setTimeout(typeEffect, 500);
        }
    }

    if (dynamicText) typeEffect();
});

// Drop Shadow Navbar
window.onscroll = function () { addShadowOnScroll() };

function addShadowOnScroll() {
    const navbar = document.querySelector('nav');
    if (window.scrollY > 10) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
}

// Back To Top
document.addEventListener('DOMContentLoaded', function () {
    const backToTopButton = document.getElementById('back-to-top');

    window.addEventListener('scroll', function () {
        if (window.scrollY > 300) {
            backToTopButton.classList.add('show');
        } else {
            backToTopButton.classList.remove('show');
        }
    });

    backToTopButton.addEventListener('click', function () {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});

// Story and Slideshow
document.addEventListener("scroll", () => {
    const story = document.querySelector(".story");
    const slideshow = document.querySelector(".slideshow");
    if (story && slideshow) {
        const storyRect = story.getBoundingClientRect();
        const slideshowRect = slideshow.getBoundingClientRect();

        if (slideshowRect.top < window.innerHeight && slideshowRect.bottom > 0) {
            story.style.opacity = "0";
        } else {
            story.style.opacity = "1";
        }
    }
});

// Slide Kegiatan
const cardContainer = document.querySelector('.card-container-kegiatan');
const dots = document.querySelectorAll('.pagination-kegiatan .dot');

if (cardContainer) {
    let isDown = false;
    let startX;
    let scrollLeft;

    cardContainer.addEventListener('mousedown', (e) => {
        isDown = true;
        cardContainer.classList.add('active');
        startX = e.pageX - cardContainer.offsetLeft;
        scrollLeft = cardContainer.scrollLeft;
    });

    cardContainer.addEventListener('mouseleave', () => {
        isDown = false;
        cardContainer.classList.remove('active');
    });

    cardContainer.addEventListener('mouseup', () => {
        isDown = false;
        cardContainer.classList.remove('active');
    });

    cardContainer.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - cardContainer.offsetLeft;
        const walk = (x - startX) * 3;
        cardContainer.scrollLeft = scrollLeft - walk;
        updateDots();
    });

    function updateDots() {
        const card = cardContainer.querySelector('.card-kegiatan');
        if (card) {
            const cardWidth = card.offsetWidth + 20;
            const scrollPosition = cardContainer.scrollLeft;
            const activeIndex = Math.round(scrollPosition / cardWidth);
            dots.forEach((dot, index) => {
                if (index === activeIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            const card = cardContainer.querySelector('.card-kegiatan');
            if (card) {
                const cardWidth = card.offsetWidth + 20;
                cardContainer.scrollTo({
                    left: cardWidth * index,
                    behavior: 'smooth'
                });
                dots.forEach(d => d.classList.remove('active'));
                dot.classList.add('active');
            }
        });
    });

    updateDots();
}

// Update year
const yearElement = document.getElementById("current-year");
const currentYear = new Date().getFullYear();
yearElement.textContent = currentYear;


// Program Toggle
document.addEventListener("DOMContentLoaded", () => {
    const dropdownToggles = document.querySelectorAll(".dropdown-toggle");

    dropdownToggles.forEach(toggle => {
        toggle.addEventListener("click", () => {
            const content = toggle.nextElementSibling;
            content.classList.toggle("open");

            // Menyesuaikan teks tombol
            if (content.classList.contains("open")) {
                toggle.textContent = toggle.textContent;
            } else {
                toggle.textContent = toggle.textContent;
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const sliderContainer = document.querySelector('.slider-container');
    const prevButton = document.querySelector('.prev-button');
    const nextButton = document.querySelector('.next-button');
    const cards = document.querySelectorAll('.testimonial-card');

    let currentIndex = 0;
    const cardWidth = cards[0].offsetWidth + 20; // Include margin

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
        if (currentIndex < cards.length - 1) {
            currentIndex++;
            updateSlider();
        }
    });

    // Responsive handling
    window.addEventListener('resize', () => {
        currentIndex = 0;
        updateSlider();
    });
});