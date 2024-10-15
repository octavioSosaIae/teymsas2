<?php

require_once "../models/Customer.php";
require_once "../../core/Response.php";

$function = $_GET['function'];


switch ($function) {

    case "register":

        registerCustomer();

        break;

    case "getAll":

        getAllCustomers();

        break;
    case "getById":

        getByIdCustomer();

        break;

    case "update":

        updateCustomer();

        break;

    case "delete":

        deleteCustomer();

        break;
}





function registerCustomer()
{

    try {

        $response = new Response;



        $customer = [

            'complete_name_user' => $_POST['complete_name_user'],
            'email_user' => $_POST['email_user'],
            'password_user' => $_POST['password_user'],
            'phone_user' => $_POST['phone_user'],
            'document_customer' => $_POST['document_customer'],
            'address_customer' => $_POST['address_customer'],
            'business_name_customer' => $_POST['business_name_customer'],
            'rut_customer' => $_POST['rut_customer'],
            'id_city' => $_POST['id_city']
        ];


        if (!empty($customer['complete_name_user'] && $customer['email_user'] && $customer['password_user'] && $customer['phone_user'] && $customer['document_customer'] && $customer['address_customer'] && $customer['business_name_customer'] && $customer['rut_customer'] && $customer['id_city'])) {


            (new Customer())->register($customer['complete_name_user'], $customer['email_user'], $customer['password_user'], $customer['phone_user'], $customer['document_customer'], $customer['address_customer'], $customer['business_name_customer'], $customer['rut_customer'], $customer['id_city']);


            // Responder con el usuario registrado
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Cliente registrado exitosamente.',
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

function getAllCustomers()
{

    try {

        $response = new Response;



            $customers = (new Customer)->getAll();


            // Responder con los datos obtenidos
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Clientes encontrados exitosamente.',
                'clientes' => $customers
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

function getByIdCustomer()
{

    try {

        $response = new Response;

        $id_customer = $_POST['id_customer'];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['id_customer'])) {


            $customer = (new Customer)->getById($id_customer);


            // Responder con los datos obtenidos
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Cliente encontrado exitosamente.',
                'cliente' => $customer
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

function updateCustomer()
{

    try {

        $response = new Response;

        $customer = [
     
            "document_customer" => $_POST ['document_customer'],
            "address_customer" => $_POST ['address_customer'],
            "business_name_customer" => $_POST ['business_name_customer'],
            "rut_customer" => $_POST ['rut_customer'],
            "id_city" => $_POST ['id_city'],
            "id_user" => $_POST ['id_user'] 
            
        ];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['document_customer']) && !empty($_POST['address_customer']) && !empty($_POST['business_name_customer']) && !empty($_POST['rut_customer']) && !empty($_POST['id_city']) && !empty($_POST['id_user'])) {

            (new Customer())->update($customer['document_customer'], $customer['address_customer'], $customer['business_name_customer'], $customer['rut_customer'], $customer['id_city'], $customer['id_user']);


            // Responder con el cliente actualizado
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Cliente actualizado exitosamente.'
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

function deleteCustomer()
{

    try {

        $response = new Response;

        $id_customer = $_POST['id_customer'];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['id_customer'])) {


            (new City)->delete($id_customer);


            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Cliente eliminado exitosamente.'
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
