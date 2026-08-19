import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    const slides = document.querySelectorAll(".slide");
    let index = 0;

    function showSlide(i) {
        slides.forEach(slide => slide.classList.remove("active"));
        slides[i].classList.add("active");
    }

    function nextSlide() {
        index++;
        if (index >= slides.length) index = 0;
        showSlide(index);
    }

    setInterval(nextSlide, 4000);
});