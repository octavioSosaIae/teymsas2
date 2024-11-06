window.onload = () => {

    obtainProducts();
}

async function obtainProducts() {

    let url = 'http://localhost/teymsas2/app/api/controllers/ProductController.php?function=getAll';
    let query = await fetch(url);
    let data = await query.json();
    productList = data;
    showProducts(data.data);
}

async function showProducts(product) {

    let tbodyElement = document.querySelector("#mostrarProducto");
    tbodyElement.innerHTML = "";
    for (let i = 0; i < product.length; i++) {

        tbodyElement.innerHTML += `               
                <tr>
                <td>${product[i].id_product}</td>
                <td>${product[i].description_product}</td>    
                <td>${product[i].details_product}</td>
                <td>${product[i].price_product}</td>
                <td>${product[i].thumbnail_product}</td>    
                <td>${product[i].stock_product}</td>    
                <td>${product[i].measures_product}</td>    
                <td>${product[i].id_category}</td>    
             <td>
 
             <button>Editar</button>
             <button>Eliminar</button>

             </td>   
                        </tr>
                `;
    }



}

async function addProduct(product) {

    let form = document.querySelector("#agregarProducto");
    

    let url = "http://localhost/teymsas2/app/api/controllers/ProductController.php?function=create";
    let formData = new FormData();


    formData.append("description_product", description_product);
    formData.append("details_product", details_product);
    formData.append("price_product", price_product);
    formData.append("thumbnail_product", thumbnail_product);
    formData.append("stock_product", stock_product);
    formData.append("measures_product", measures_product);
    formData.append("id_category", id_category);


    let config = {
        method: "POST",
        body: formData

    }
    let response = await fetch(url, config);
    let respuesta= await response.json();
    return respuesta;

}



