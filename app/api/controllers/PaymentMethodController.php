<?php

require_once "../../core/Response.php";
require_once "../models/PaymentMethod.php";

$function = $_GET['function'];

switch ($function) {

    case "create":

        createPaymentMethod();

        break;


    case "getAll":

        getAllPaymentMethods();

        break;

    case "getById":

        getByIdPaymentMethod();

        break;

    case "update":

        updatePaymentMethod();

        break;

    case "delete":

        deletePaymentMethod();

        break;
}


function createPaymentMethod()
{

    try {

        $response = new Response;


        $PaymentMethod = [
            "name_payment_method" => $_POST['name_payment_method']
        ];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['name_payment_method'])) {


            (new PaymentMethod())->create($PaymentMethod['name_payment_method']);


            // Responder con success true si todo sale bien
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => "Metodo de pago agregado exitosamente"
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

function getAllPaymentMethods()
{

    try {

        $response = new Response;

        $PaymentMethods = (new PaymentMethod())->getAll();


        // Responder con los productos obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Metodos de pago obtenidos exitosamente.',
            'Metodos de pago:' => $PaymentMethods
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

function getByIdPaymentMethod()
{


    try {
        $response = new Response;

        $PaymentMethod = [
            "id_payment_method" => $_POST['id_payment_method']
        ];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['id_payment_method'])) {

            $paymentMethodById = (new OrderStatus())->getById($PaymentMethod['id_payment_method']);


            // Responder con OK
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'metodo de pago encontrado',
                'Metodo de pago:' => $paymentMethodById
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

function updatePaymentMethod()
{
    try {
        $response = new Response;


        $PaymentMethod = [
            "name_payment_method" => $_POST['name_payment_method'],
            "id_payment_method" => $_POST['id_payment_method']
        ];


        // para evitar enviar datos vacios a la base de datos



        if (!empty($_POST['name_payment_method']) && !empty($_POST['id_payment_method'])) {


            (new PaymentMethod())->update($PaymentMethod['name_payment_method'], $PaymentMethod['id_payment_method']);


            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Metodo de pago actualizado exitosamente'
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

function deletePaymentMethod()
{

    try {
        $response = new Response;


        $PaymentMethod = [
            "id_payment_method" => $_POST['id_payment_method']
        ];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['id_payment_method'])) {


            (new PaymentMethod())->delete($PaymentMethod['id_payment_method']);


            // Responder con success true si todo sale bien
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Metodo de pago eliminado exitosamente.'
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
