<?php

require_once "../models/Provider.php";


$function = $_GET['function'];

switch ($function) {

    case "add":

        addProvider();

        break;


    case "getAll":

        getAllProviders();

        break;


    case "update":
        updateProvider();


        break;


    case "delete":

        deleteProvider();
        break;
}


function addProvider()
{

    try {

        $response = new Response;


        $provider = [
            "name_provider" => $_POST['name_provider']
        ];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['name_provider'])) {


            (new Provider())->create($provider['name_provider']);


            // Responder con el proveedor registrado
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'proveedor agregado exitosamente.',
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

function getAllProviders()
{
    try {

        $response = new Response;

        $users = (new Provider())->getAll();


        // Responder con los proveedores obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'proveedores obtenidos exitosamente.',
            'users' => $users
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


function updateProvider()
{

    try {

        $response = new Response;


        $provider = [
            "name_provider" => $_POST['name_provider'],
            "id_provider" => $_POST['id_provider']
        ];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['name_provider']) && !empty($_POST['id_provider'])) {


            (new Provider())->update($provider['name_provider'], $provider['id_provider']);


            // Responder con mensaje de exito
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'proveedor actualizado exitosamente.',
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

function deleteProvider()
{
    try {

        $response = new Response;


        $provider = [
            "id_provider" => $_POST['id_provider']
        ];


        if (!empty($_POST['id_provider'])) {


            (new Provider())->delete($provider['id_provider']);


            // Responder con mensaje de exito
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'proveedor eliminado exitosamente.',
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
