import orderDAO from "../js/DAO/orderDAO.js";

window.onload = () => {
    obtainProducts();

}



async function obtainProducts() {
    const result = await new orderDAO().getByCustomer();
    showProducts(result.Orden);
}

async function showProducts(product) {

    let tbodyElement = document.querySelector("#mostrarProductos");
    tbodyElement.innerHTML = "";
    for (let i = 0; i < product.length; i++) {
        tbodyElement.innerHTML += `               
                <tr>
                <td>${product[i].id_product}</td>
                <td>${product[i].description_product}</td>    
                <td>${product[i].details_product}</td>
                <td>${product[i].price_product}</td>
                <td>${product[i].stock_product}</td>    
                <td>${product[i].measures_product}</td>    
                <td>${product[i].description_category}</td>     
                </tr>`;


    }



}