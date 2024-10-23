import productDAO from "./DAO/productDAO.js";

const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get('productId');


const producto = await new productDAO().getById(productId);
const containerProduct = document.querySelector('#container-product');

containerProduct.innerHTML += `
            <div class="producto">
            <img class="imgProducto" src="../storage/imgproductos/Pro1.png" alt="">
            <div class="info">
                <h2 class="title">${producto.producto.description_product}</h2>
                <p class="price">U$S ${producto.producto.price_product}</p>
            </div>
            </div>
    `;