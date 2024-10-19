<?php
require_once "../../core/Response.php";
require_once "../models/Delivery.php";

$function = $_GET['function'];

switch ($function) {

    case "create":
        createDelivery();
        break;

    case "getById":
        getByIdDelivery();
        break;

    case "getAll":
        getAllDeliveries();
        break;

    case "update":
        updateDelivery();
        break;

    case "delete":
        deleteDelivery();
        break;
}



function createDelivery()
{
    try {
        $response = new Response;

        $Delivery = [
            "delivery_person" => $_POST['delivery_person'],
            "delivery_address" => $_POST['delivery_address'],
            "status" => $_POST['status'],
            "order_id" => $_POST['order_id']
        ];

        // Validar que los campos no estén vacíos
        if (!empty($_POST['delivery_person']) && !empty($_POST['delivery_address']) && !empty($_POST['order_id'])) {

            $DeliveryCreated = (new Delivery())->create($Delivery['delivery_person'], $Delivery['delivery_address'], $Delivery['status'], $Delivery['order_id']);

            // Responder con success true si todo sale bien
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Entrega agregada con éxito',
                'data' => $DeliveryCreated
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

function getByIdDelivery()
{
    try {
        $response = new Response;

        $id_delivery = $_POST['id_delivery'];

        // Validar que no esté vacío
        if (!empty($_POST['id_delivery'])) {

            $deliveryById = (new Delivery)->getById($id_delivery);

            // Responder con los datos obtenidos
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Entrega encontrada exitosamente.',
                'entrega' => $deliveryById
            ]);

            if ($deliveryById == null) {
                $response->setStatusCode(404); // Código de estado para no encontrado
                $response->setBody([
                    'success' => false,
                    'error' => "Entrega no encontrada"
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

function getAllDeliveries()
{
    try {
        $response = new Response;

        $deliveries = (new Delivery())->getAll();

        // Responder con los datos obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Entregas encontradas exitosamente.',
            'entregas' => $deliveries
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

function updateDelivery()
{
    try {
        $response = new Response;

        $Delivery = [
            "delivery_person" => $_POST['delivery_person'],
            "delivery_address" => $_POST['delivery_address'],
            "status" => $_POST['status'],
            "id_delivery" => $_POST['id_delivery']
        ];

        // Validar que los campos no estén vacíos
        if (!empty($_POST['delivery_person']) && !empty($_POST['delivery_address']) && !empty($_POST['id_delivery'])) {

            (new Delivery())->update($Delivery['delivery_person'], $Delivery['delivery_address'], $Delivery['status'], $Delivery['id_delivery']);

            // Responder con la entrega actualizada
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Entrega actualizada exitosamente.'
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

function deleteDelivery()
{
    try {
        $response = new Response;

        $id_delivery = $_POST['id_delivery'];

        // Validar que no esté vacío
        if (!empty($_POST['id_delivery'])) {

            (new Delivery)->delete($id_delivery);

            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Entrega eliminada exitosamente.'
            ]);
        }
    } catch (Exception $e) {
    
        $response ->send();

