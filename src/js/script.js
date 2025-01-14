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



