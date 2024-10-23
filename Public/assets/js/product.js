import productDAO from "./DAO/productDAO.js";

const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get('productId');


const producto = await new productDAO().getById(productId);
console.log(producto)
// const containerProducts = document.querySelector('#container-products');

// productos.products.forEach(product => {
//     containerProducts.innerHTML += `
//             <div class="producto">
//             <img class="imgProducto" src="../storage/imgproductos/Pro1.png" alt="">
//             <div class="info">
//                 <h2 class="title">${product.description_product}</h2>
//                 <p class="price">U$S ${product.price_product}</p>
//                 <a href="./product.html">Ver Producto</a>
//             </div>
//             </div>
//     `
// });
