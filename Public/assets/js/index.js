const container = document.querySelector('.container');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');

let scrollPosition = 0;
const productWidth = 300;

nextButton.addEventListener('click', () => {
    scrollPosition += productWidth;
    container.style.transform = `translateX(-${scrollPosition}px)`;
});

prevButton.addEventListener('click', () => {
    scrollPosition -= productWidth;
    container.style.transform = `translateX(-${scrollPosition}px)`;
});