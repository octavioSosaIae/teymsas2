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
