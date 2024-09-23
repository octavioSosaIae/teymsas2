const carousel = document.querySelector('.carousel');
const rightArrow = document.getElementById('right-arrow');
const leftArrow = document.getElementById('left-arrow');

let currentIndex = 0;

rightArrow.addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % 4;  // Hay 4 productos
    carousel.style.transform = `translateX(-${currentIndex * 260}px)`;
});

leftArrow.addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + 4) % 4;  // Ajuste circular
    carousel.style.transform = `translateX(-${currentIndex * 260}px)`;
});