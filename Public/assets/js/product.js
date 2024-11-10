
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


let cart = [];

const addToCartbuton = document.querySelector('#add-to-cart');
addToCartbuton.onclick = (evento) => {
    evento.preventDefault();
    let cantidad = document.querySelector("#cantidadProducto").value;
    if (cantidad >= 1) {
        if (localStorage.getItem("cart")) {

            cart = JSON.parse(localStorage.getItem("cart"));

            let productSelected = {
                id: product.id_product,
                cant: parseInt(cantidad)
            }


            let productExists = false;

            cart = cart.map(item => {
                if (item.id === productSelected.id) {
                    item.cant += productSelected.cant;
                    productExists = true;
                }
                return item;
            });

            if (!productExists) {
                cart.push(productSelected);
            }


            localStorage.setItem("cart", JSON.stringify(cart));
            alert("Producto agregado al carrito");

        } else {
            let productSelected = {
                id: product.id_product,
                cant: parseInt(cantidad)
            }

            cart.push(productSelected);
            localStorage.setItem("cart", JSON.stringify(cart));
            alert("Producto agregado al carrito");
        }

    }
    else {
        alert("agregar una cantidad al producto")
    }
};
