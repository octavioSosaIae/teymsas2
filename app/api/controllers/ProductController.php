<?php
require_once "../../core/Response.php";
require_once "../models/Product.php";


$function = $_GET['function'];

switch ($function) {

    case "create":

        createProduct();

        break;


    case "getAll":

        getAllProducts();

        break;

    case "getById":

        getByIdProduct();

        break;

    case "update":

        updateProduct();

        break;

    case "delete":

        deleteProduct();

        break;
}




function createProduct()
{

    try {

        $response = new Response;


        $product = [
            "description_product" => $_POST['description_product'],
            "details_product" => $_POST['details_product'],
            "price_product" => $_POST['price_product'],
            "thumbnail_product" => $_POST['thumbnail_product'],
            "stock_product" => $_POST['stock_product'],
            "measures_product" => $_POST['measures_product'],
            "id_category" => $_POST['id_category']

        ];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['description_product']) && !empty($_POST['details_product']) && !empty($_POST['price_product']) && !empty($_POST['thumbnail_product']) && !empty($_POST['stock_product']) && !empty($_POST['measures_product']) && !empty($_POST['id_category'])) {


            $productCreated = (new Product())->create($product['description_product'], $product['details_product'], $product['price_product'], $product['thumbnail_product'], $product['stock_product'], $product['measures_product'], $product['id_category']);


            // Responder con success true si todo sale bien
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'producto creado:' => $productCreated

            ]);
        }
    } catch (Exception $e) {

        // Responder con un error

        $response->setStatusCode(400); // Código de estado para solicitud incorrecta
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }

    $response->send();
}

function getAllProducts()
{

    try {

        $response = new Response;

        $products = (new Product())->getAll();


        // Responder con los productos obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'productos obtenidos exitosamente.',
            'products' => $products
        ]);
    } catch (Exception $e) {

        // Responder con un error
        $response->setStatusCode(400); // Código de estado para solicitud incorrecta
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
    $response->send();
}

function getByIdProduct()
{


    try {
        $response = new Response;

        $product = [
            "id_product" => $_POST['id_product']
        ];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['id_product'])) {

            $productById = (new Product())->getById($product['id_product']);


            // Responder con OK
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'producto encontrado',
                'producto:' => $productById
            ]);
        }
    } catch (Exception $e) {

        // Responder con un error
        $response->setStatusCode(400); // Código de estado para solicitud incorrecta
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }

    $response->send();
}

function updateProduct()
{
    try {
        $response = new Response;


        $product = [
            "description_product" => $_POST['description_product'],
            "details_product" => $_POST['details_product'],
            "price_product" => $_POST['price_product'],
            "thumbnail_product" => $_POST['thumbnail_product'],
            "stock_product" => $_POST['stock_product'],
            "measures_product" => $_POST['measures_product'],
            "id_category" => $_POST['id_category'],
            "id_product" => $_POST['id_product']
        ];


        // para evitar enviar datos vacios a la base de datos



        if (!empty($_POST['description_product']) && !empty($_POST['details_product']) && !empty($_POST['price_product']) && !empty($_POST['thumbnail_product']) && !empty($_POST['stock_product']) && !empty($_POST['measures_product']) && !empty($_POST['id_category']) && !empty($_POST['id_product'])) {


            (new Product())->update($product['description_product'], $product['details_product'], $product['price_product'], $product['thumbnail_product'], $product['stock_product'], $product['measures_product'], $product['id_category'], $product['id_product']);


            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'producto actualizado exitosamente'
            ]);
        }
    } catch (Exception $e) {

        // Responder con un error

        $response->setStatusCode(400); // Código de estado para solicitud incorrecta
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
}

function deleteProduct()
{

    try {
        $response = new Response;


        $product = [
            "id_product" => $_POST['id_product']
        ];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['id_product'])) {


            (new Product())->delete($product['id_product']);


            // Responder con success true si todo sale bien
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Producto eliminado exitosamente.'
            ]);
        }
    } catch (Exception $e) {

        // Responder con un error

        $response->setStatusCode(400); // Código de estado para solicitud incorrecta
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
}
