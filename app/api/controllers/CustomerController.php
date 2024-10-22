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



        if (isset($_POST['complete_name_user']) && isset($_POST['email_user']) && isset($_POST['password_user']) && isset($_POST['phone_user']) && isset($_POST['document_customer']) && isset($_POST['address_customer']) && isset($_POST['business_name_customer']) && isset($_POST['rut_customer']) && isset($_POST['id_city']) && !empty($_POST['complete_name_user']) && !empty($_POST['email_user']) && !empty($_POST['password_user']) && !empty($_POST['phone_user']) && !empty($_POST['document_customer']) && !empty($_POST['address_customer']) && !empty($_POST['business_name_customer']) && !empty($_POST['rut_customer']) && !empty($_POST['id_city'])) {


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

            $customerRegistered =  (new Customer())->register($customer['complete_name_user'], $customer['email_user'], $customer['password_user'], $customer['phone_user'], $customer['document_customer'], $customer['address_customer'], $customer['business_name_customer'], $customer['rut_customer'], $customer['id_city']);

            if ($customerRegistered == true) {

                // Responder con el usuario registrado
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Cliente registrado exitosamente.',
                ]);
            }
        } else {

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



        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['id_customer']) && !empty($_POST['id_customer'])) {

            $id_customer = $_POST['id_customer'];

            $customerById = (new Customer)->getById($id_customer);


            // Responder con los datos obtenidos
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Cliente encontrado exitosamente.',
                'cliente' => $customerById
            ]);


            if ($customerById == null) {

                $response->setStatusCode(404); // Código de estado para solicitud incorrecta
                $response->setBody([
                    'success' => false,
                    'error' => "Cliente no encontrado"
                ]);
            }
        } else {

            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => 'El ID de el cliente es obligatorio.'
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

        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['document_customer']) && isset($_POST['address_customer']) && isset($_POST['business_name_customer']) && isset($_POST['rut_customer']) && isset($_POST['id_city']) && isset($_POST['id_user']) && isset($_POST['document_customer']) && !empty($_POST['address_customer']) && !empty($_POST['business_name_customer']) && !empty($_POST['rut_customer']) && !empty($_POST['id_city']) && !empty($_POST['id_user'])) {

            $customer = [

                "document_customer" => $_POST['document_customer'],
                "address_customer" => $_POST['address_customer'],
                "business_name_customer" => $_POST['business_name_customer'],
                "rut_customer" => $_POST['rut_customer'],
                "id_city" => $_POST['id_city'],
                "id_user" => $_POST['id_user']

            ];

            $CustomerUpdated = (new Customer())->update($customer['document_customer'], $customer['address_customer'], $customer['business_name_customer'], $customer['rut_customer'], $customer['id_city'], $customer['id_user']);


            if ($CustomerUpdated == true) {
                // Responder con el cliente actualizado
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Cliente actualizado exitosamente.'
                ]);
            } else {

                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'error' => "Cliente no encontrado"
                ]);
            }
        } else {

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

function deleteCustomer()
{

    try {

        $response = new Response;



        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['id_user_customer']) && !empty($_POST['id_user_customer'])) {

            $id_user_customer = $_POST['id_user_customer'];


            $customerDeleted = (new Customer)->delete($id_user_customer);


            if ($customerDeleted == true) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Cliente eliminado exitosamente.'
                ]);
            } else {

                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'error' => "Cliente no encontrado"
                ]);
            }
        } else {

            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => 'El ID de usuario del cliente es obligatorio.'
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
