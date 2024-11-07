import productDAO from "./DAO/productDAO.js";

const urlParams = new URLSearchParams(window.location.search);

let formAgregar = document.querySelector("#formAgregar");

formAgregar.onsubmit = async (e) => {

    e.preventDefault();
    let description_product = document.querySelector('#description_product').value;
    let details_product = document.querySelector('#details_product').value;
    let price_product = document.querySelector('#price_product').value;
    let thumbnail_product = document.querySelector('#thumbnail_product').value;
    let stock_product = document.querySelector('#stock_product').value;
    let measures_product = document.querySelector('#measures_product').value;
    let id_category = document.querySelector('#id_category').value;

    const response = await new productDAO().createProduct(description_product, details_product, price_product, thumbnail_product, stock_product, measures_product, id_category);
    const product = response.producto;

    alert("PRODUCTO AGREGADO");


}

const containerProduct = document.querySelector('#container-product');

const form = document.createElement('form');
form.setAttribute('action', 'update_product.php');
form.setAttribute('method', 'POST');
form.setAttribute('enctype', 'multipart/form-data');
form.classList.add('profile-form');
