import productDAO from "./DAO/productDAO.js";

const productos = await new productDAO().getAll();

const containerProducts = document.querySelector('#container-products');

productos.data.forEach(product => {
    containerProducts.innerHTML += `
            <div class="producto">
            <img class="imgProducto" src="../storage/imgproductos/Pro1.png" alt="">
            <div class="info">
                <h2 class="title">${product.description_product}</h2>
                <p class="price">U$S ${product.price_product}</p>
                <a href="#" onclick='loadContent("../user/product.html?productId=${product.id_product}", ${product.id_product})';>Ver Producto</a>
            </div>
            </div>
    `
});



// const carousel = document.querySelector('.carousel');
// const rightArrow = document.getElementById('right-arrow');
// const leftArrow = document.getElementById('lefct-arrow');

// let currentIndex = 0;

// rightArrow.addEventListener('click', () => {
//     currentIndex = (currentIndex + 1) % 4;  // Hay 4 productos
//     carousel.style.transform = `translateX(-${currentIndex * 260}px)`;
// });

// leftArrow.addEventListener('click', () => {
//     currentIndex = (currentIndex - 1 + 4) % 4;  // Ajuste circular
//     carousel.style.transform = `translateX(-${currentIndex * 260}px)`;
// });