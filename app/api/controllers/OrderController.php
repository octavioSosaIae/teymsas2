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


        $order = [
            "description_status" => $_POST['description_status']
        ];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['description_status'])) {


            $OrderCreated = (new OrderStatus())->create($order['description_status']);


            // Responder con success true si todo sale bien
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'Orden creada:' => $OrderCreated

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

function getAllOrders()
{

    try {

        $response = new Response;

        $Orders = (new OrderStatus())->getAll();


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

        $order = [
            "id_order_status" => $_POST['id_order_status']
        ];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['id_order_status'])) {

            $orderById = (new OrderStatus())->getById($order['id_order_status']);


            // Responder con OK
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'orden encontrada',
                'Orden:' => $orderById
            ]);

            
            if ($orderById == null) {

                $response->setStatusCode(404); // Código de estado para solicitud incorrecta
                $response->setBody([
                    'success' => false,
                    'error' => "Orden no encontrada"
                ]);
            }
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

function updateOrder()
{
    try {
        $response = new Response;


        $order = [
            "description_status" => $_POST['description_status'],
            "id_order_status" => $_POST['id_order_status']
        ];


        // para evitar enviar datos vacios a la base de datos



        if (!empty($_POST['description_status']) && !empty($_POST['id_order_status'])) {


            (new OrderStatus())->update($order['description_status'], $order['id_order_status']);


            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'orden actualizada exitosamente'
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

function deleteOrder()
{

    try {
        $response = new Response;


        $order = [
            "id_order_status" => $_POST['id_order_status']
        ];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['id_order_status'])) {


            (new OrderStatus())->delete($order['id_order_status']);


            // Responder con success true si todo sale bien
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Orden eliminada exitosamente.'
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
