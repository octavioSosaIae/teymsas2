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
    $response = new Response;

    try {
        $Delivery = [
            "id_customer_order" => $_POST['id_customer_order'],
            "address_delivery" => $_POST['address_delivery'],
            "date_delivery" => $_POST['date_delivery']
        ];

      
        if (!empty($Delivery['id_customer_order']) && !empty($Delivery['address_delivery']) && !empty($Delivery['date_delivery'])) {

            // Crear una nueva entrega en la base de datos
            $DeliveryCreated = (new Delivery())->create($Delivery['id_customer_order'],$Delivery['address_delivery'],$Delivery['date_delivery']);

            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Entrega agregada con éxito',
                'data' => $DeliveryCreated
            ]);
        } else {
            throw new Exception("Faltan campos obligatorios.");
        }
    } catch (Exception $e) {
        $response->setStatusCode(400);
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
        $id_delivery = $_GET['id_delivery'];

        // Validar que no esté vacío
        if (!empty($id_delivery)) {

            $deliveryById = (new Delivery)->getById($id_delivery);

            // Responder con los datos obtenidos
            if ($deliveryById) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Entrega encontrada exitosamente.',
                    'entrega' => $deliveryById
                ]);
            } else {
                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'error' => "Entrega no encontrada"
                ]);
            }
        } 
    } catch (Exception $e) {
        $response->setStatusCode(400);
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

        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Entregas encontradas exitosamente.',
            'entregas' => $deliveries
        ]);
    } catch (Exception $e) {
        $response->setStatusCode(400);
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }

    $response->send();
}

function updateDelivery()
{
    $response = new Response;

    try {
        $Delivery = [
            "id_delivery" => $_POST['id_delivery'],
            "address_delivery" => $_POST['address_delivery'],
            "date_delivery" => $_POST['date_delivery'],
            "status" => $_POST['status']
        ];

        // Validar que los campos no estén vacíos
        if (!empty($Delivery['id_delivery']) && !empty($Delivery['address_delivery']) && !empty($Delivery['date_delivery'])) {

            (new Delivery())->update($Delivery['id_customer_order'], $Delivery['address'], $Delivery['status'], $Delivery['date_delivery'],$Delivery['id_delivery']);

            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Entrega actualizada exitosamente.'
            ]);
        } else {
            throw new Exception("ID de entrega no proporcionado.");
        }
    } catch (Exception $e) {
        $response->setStatusCode(400);
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

        if (!empty($_POST['id_delivery'])) {

      $id_delivery = $_POST['id_delivery'];
            (new Delivery)->delete($id_delivery);

            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Entrega eliminada exitosamente.'
            ]);
        } else {
            throw new Exception("ID de entrega no proporcionado.");
        }
    } catch (Exception $e) {
        $response->setStatusCode(400);
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }

    $response->send();
}
?>
