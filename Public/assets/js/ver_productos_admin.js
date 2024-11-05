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

function showProducts(product) {
    
    console.log(product);
    let tbodyElement = document.querySelector("#mostrarProducto");
    tbodyElement.innerHTML = "";
    for (let i = 0; i < product.length; i++) {

        tbodyElement.innerHTML += `               
                <tr>
                <td>${product[i].id_product}</td>
                <td>${product[i].details_product}</td>
                <td>${product[i].price_product}</td>
                <td>${product[i].thumbnail_product}</td>    
                <td>${product[i].stock_product}</td>    
                <td>${product[i].measures_product}</td>    
                <td>${product[i].category_product}</td>    

                </tr>
                `;
    }

}

