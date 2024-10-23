<?php
require_once "../../core/Response.php";
require_once "../models/Order.php";

$function = $_GET['function'];

switch ($function) {
    case "create":
        createOrder();
        break;

    case "getAll":
        getAllOrders();
        break;

    case "getById":
        getByIdOrder();
        break;

    case "getProducts":
        getProductsOrder();
        break;

    case "update":
        updateOrder();
        break;

    case "delete":
        deleteOrder();
        break;
}

function createOrder()
{

    try {

        $response = new Response;

        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['date_order']) && isset($_POST['total_order']) && isset($_POST['id_payment_method']) && isset($_POST['id_order_status']) && !empty($_POST['date_order']) && !empty($_POST['total_order']) && !empty($_POST['id_payment_method']) && !empty($_POST['id_order_status'])) {


            $Order = [
                "date_order" => $_POST['date_order'],
                "total_order" => $_POST['total_order'],
                "id_payment_method" => $_POST['id_payment_method'],
                "id_order_status" => $_POST['id_order_status']

            ];

            if (isset($_POST['list_products']) && !empty($_POST['list_products']) && is_array($_POST['list_products'])) {

                $products = $_POST['list_products'];


                $orderCreated = (new Order())->create($Order['date_order'], $Order['total_order'], $Order['id_payment_method'], $Order['id_order_status'], $products['list_products']);


                if ($orderCreated == true) {
                    // Responder con success true si todo sale bien
                    $response->setStatusCode(200);
                    $response->setBody([
                        'success' => true,
                        'message' => "Orden agregada exitosamente"
                    ]);
                } else {

                    $response->setStatusCode(400);
                    $response->setBody([
                        'success' => false,
                        'message' => "No se pudo agregar la orden."
                    ]);
                }
            } else {
                // Responder con error si el nombre del producto está vacío
                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'message' => "No se puede registrar una orden sin productos."
                ]);
            }
        } else {
            // Responder con error si el nombre del producto está vacío
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'message' => "Todos los campos son obligatorios."
            ]);
        }
    } catch (Exception $e) {

        // Responder con un error

        $response->setStatusCode(400); // Código de estado para solicitud incorrecta
        $response->setBody([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }

    $response->send();
}

function getAllOrders()
{

    try {

        $response = new Response;

        $Orders = (new Order())->getAll();


        // Responder con los productos obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'ordenes obtenidas exitosamente.',
            'Ordenes:' => $Orders
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

function getByIdOrder()
{

    try {
        $response = new Response;

        // para evitar enviar datos vacios a la base de datos

        if (isset($_GET['customerOrderId']) && !empty($_GET['customerOrderId'])) {

            $order = [
                "customerOrderId" => $_GET['customerOrderId']
            ];

            $orderById = (new Order())->getById($order['customerOrderId']);


            if ($orderById) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'orden encontrada',
                    'Orden:' => $orderById
                ]);
            } else {

                $response->setStatusCode(404); // Código de estado para solicitud incorrecta
                $response->setBody([
                    'success' => false,
                    'error' => "Orden no encontrada"
                ]);
            }
        } else {

            // Responder con un error
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => 'Todos los campos son obligatorios.'
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

function getProductsOrder(){

    try {

        $response = new Response;

        $ProductsOrder = (new Order())->getProductsOrder();


        // Responder con los productos obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Productos obtenidos exitosamente.',
            'Productos:' => $ProductsOrder
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

function updateOrder(){

    try {
        $response = new Response;


        // para evitar enviar datos vacios a la base de datos


        if (isset($_POST['date_order']) && isset($_POST['total_order']) && isset($_POST['id_payment_method']) && isset($_POST['id_order_status']) && isset($_POST['id_customer_order']) && !empty($_POST['date_order']) && !empty($_POST['total_order']) && !empty($_POST['id_payment_method']) && !empty($_POST['id_order_status']) && !empty($_POST['id_customer_order'])) {


            $order = [
                "date_order" => $_POST['date_order'],
                "total_order" => $_POST['total_order'],
                "id_payment_method" => $_POST['id_payment_method'],
                "id_order_status" => $_POST['id_order_status'],
                "id_customer_order" => $_POST['id_customer_order']
            ];

            $orderUpdated = (new Order())->update($order['date_order'], $order['total_order'], $order['id_payment_method'], $order['id_order_status'], $order['id_customer_order']);


            if ($orderUpdated == true) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'orden actualizada exitosamente'
                ]);
            } else {
                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'error' => "Orden no encontrada"
                ]);
            }
        } else {

            // Responder con un error
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => 'Todos los campos son obligatorios.'
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

function deleteOrder(){
    
    try {
        $response = new Response;


        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['id_customer_order']) && !empty($_POST['id_customer_order'])) {


            $order = [
                "id_customer_order" => $_POST['id_customer_order']
            ];

            $orderDeleted = (new Order())->delete($order['id_customer_order']);


            if ($orderDeleted == true) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Orden eliminada exitosamente.'
                ]);
            } else {

                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'error' => "Orden no encontrada"
                ]);
            }
        } else {
            // Responder con un error
            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => 'Todos los campos son obligatorios.'
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
