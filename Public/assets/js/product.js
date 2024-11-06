import productDAO from "./DAO/productDAO.js";

const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get('productId');


const response = await new productDAO().getById(productId);
const product = response.producto;

const containerProduct = document.querySelector('#container-product');

containerProduct.innerHTML = `
<div>

<h2> 
<h1>${product.description_product} </h1></h2>
</div>
<p> ${product.details_product}</p>
<p> ${product.price_product} </p>
<p> ${product.thumbnail_product} </p>
<h1> ${product.stock_product} </h1>
<p> ${product.measures_product} </p>
    `;

function addCart(){

}