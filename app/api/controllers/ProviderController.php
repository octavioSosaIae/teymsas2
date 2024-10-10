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


            // Responder con el usuario registrado
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'proovedor agregado exitosamente.',
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


        // Responder con los usuarios obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'proovedores obtenidos exitosamente.',
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


}

function deleteProvider()
{

}
