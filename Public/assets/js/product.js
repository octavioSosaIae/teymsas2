
window.onload = () => {

}
import productDAO from "./DAO/productDAO.js";
const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get('productId');


const response = await new productDAO().getById(productId);
const product = response.producto;



// Mostrar los detalles del producto en la página
const producto = document.querySelector('#producto');

producto.innerHTML = `
     <div class="doblecolumna">
        <div class="imgproducto">
            <img src="../storage/imgproductos/Pro1.png" class="product-image">
            <img src="${product.thumbnail_product}" alt="${product.description_product}" />
        </div>

        <div class="contenidoproducto" id="container-product">
            
            <h2 class="product-title">${product.description_product}</h2>
            <p class="product-description">${product.price_product} 
            </p>
            <p class="product-medidas">${product.measures_product}</p>
            <p class="product-price">${product.price_product}</p>
            <p class="product-stock">${product.stock_product}</p>
        </div>
       
    </div>
    `;
const addToCartbuton = document.querySelector('#add-to-cart');
addToCartbuton.onclick = (evento) => {
    evento.preventDefault();
    let cantidad = document.querySelector("#cantidadProducto").value;
    if (cantidad > 1) {
        if (localStorage.getItem("cart")) {

        } else {
            let cart= [];
            let productSelected={
                // id: id_product
                // cart:
            }
        }

    }
    else {
        alert("agregar una cantidad al producto")
    }
};
