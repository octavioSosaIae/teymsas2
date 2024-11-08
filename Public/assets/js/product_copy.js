import productDAO from "./DAO/productDAO.js";

const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get('productId');


const response = await new productDAO().getById(productId);
const product = response.producto;

const containerProduct = document.querySelector('#container-product');

const form = document.createElement('form');
form.setAttribute('method', 'POST');
form.setAttribute('enctype', 'multipart/form-data');
form.classList.add('profile-form');

form.innerHTML = `
        <label for="description_product">Descripción del producto:</label>
        <input type="text" id="description_product" name="description_product" value="${product.description_product}" required>

        <label for="details_product">Detalles del producto:</label>
        <input type="text" id="details_product" name="details_product" value="${product.details_product}" required>

        <label for="price_product">Precio del producto:</label>
        <input type="text" id="price_product" name="price_product" value="${product.price_product}" required>

        <label for="thumbnail_product">Miniatura del producto actual:</label>
        <div style="margin-bottom: 15px;">
            <!-- Muestra la imagen actual -->
            <img src="./../storage/thumbnails/${product.thumbnail_product}" alt="Miniatura del producto" style="max-width: 150px; height: auto; display: block; margin-bottom: 10px;">
                
            <!-- Input para cargar una nueva imagen -->
            <label for="new_thumbnail_product">Subir nueva miniatura:</label>
            <input type="file" id="new_thumbnail_product" name="new_thumbnail_product" accept="image/*">
        </div>

        <label for="stock_product">Stock del producto:</label>
        <input type="number" id="stock_product" name="stock_product" value="${product.stock_product}" required>

        <label for="measures_product">Medidas del producto:</label>
        <input type="text" id="measures_product" name="measures_product" value="${product.measures_product}" required>

        <button type="submit" class="btn">Actualizar Datos</button>
    `;

containerProduct.appendChild(form);