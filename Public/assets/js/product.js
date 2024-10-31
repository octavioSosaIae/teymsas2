import productDAO from "./DAO/productDAO.js";

const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get('productId');


const response = await new productDAO().getById(productId);
const product = response.producto;

const containerProduct = document.querySelector('#container-product');

containerProduct.innerHTML = `

<h1>${product.description_product}</h1>
<p> ${product.details_product} </p>
<p> ${product.price_product} </p>
<p> ${product.thumbnail_product} </p>
<p> ${product.stock_product} </p>
<p> ${product.measures_product} </p>
    `;
