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
            <select>
                <option value="">...</option>
                <option value="editar">Editar</option>
                <option value="eliminar">Eliminar</option>
            </select>
        </td>    
                        </tr>
                `;
    }



}

function addProduct(){
    let form = document.querySelector("#agregarProducto");

    formElement.onsubmit = async (e) => {
        e.preventDefault();
        let fromFormData = new FormData(formElement);
        let url = 'http://localhost/teymsas2/app/api/controllers/ProductController.php?function=create';

        let config = {
            method: 'POST',
            body: fromFormData
        };

        let response = await fetch(url, config);
        let data = await response.json();

        console.log(data);

        if (data == true) {
            alert('Producto agregado exitosamente')
        } else (
            alert('Error al agregar el producto')
        )
    }
   
}



