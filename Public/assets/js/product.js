
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
                id: id_product
                cant: 
            }
        }

    }
    else {
        alert("agregar una cantidad al producto")
    }
};













function addToCart(product) {
    let producto = JSON.parse(localStorage.getItem('productoadd'));
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Verificar si el producto ya está en el carrito
    const productIndex = cart.findIndex(item => item.id_product == product.id_product);

    if (productIndex == -1) {
        // Si no está, agregar el producto al carrito
        cart.push({
            id_product: product.id_product,
            description_product: product.description_product,
            price_product: product.price_product,
            quantity: 1  // Agregar con cantidad inicial 1
        });
    } else {
        // Si ya está, aumentar la cantidad
        cart[productIndex].quantity += 1;
    }

    // Guardar el carrito en el almacenamiento local
    localStorage.setItem('cart', JSON.stringify(cart));

    // Mostrar mensaje de confirmación
    alert(`${product.description_product} se ha añadido al carrito correctamente!`);


}
