<?php
require_once "../../core/Response.php";
require_once "../models/City.php";

$function = $_GET['function'];

switch ($function) {

    case "create":
        createCity();
        break;

    case "getById":
        getByIdCity();
        break;

    case "getAll":
        getAllCities();
        break;

    case "update":
        updateCity();
        break;

    case "delete":
        deleteCity();
        break;
}



function createCity()
{

    try {

        $response = new Response;

        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['name_city']) && isset($_POST['id_department']) && !empty($_POST['name_city']) && !empty($_POST['id_department'])) {

            $City = [
                "name_city" => $_POST['name_city'],
                "id_department" => $_POST['id_department']
            ];

            $CityCreated = (new City())->create($City['name_city'], $City['id_department']);

            // Responder con success true si todo sale bien
            $response->setStatusCode(201);
            $response->setBody([
                'success' => true,
                'message' => 'Ciudad agregada con exito'
            ]);
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

function getByIdCity()
{

    try {

        $response = new Response;



        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['id_city']) && !empty($_POST['id_city'])) {

            $id_city = $_POST['id_city'];


            $cityById = (new City)->getById($id_city);


            // Responder con los datos obtenidos
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Ciudad encontrada exitosamente.',
                'ciudad' => $cityById
            ]);

            if ($cityById == null) {

                $response->setStatusCode(404); // Código de estado para solicitud incorrecta
                $response->setBody([
                    'success' => false,
                    'error' => "Ciudad no encontrada"
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

function getAllCities()
{

    try {

        $response = new Response;


        $cities = (new City())->getAll();


        // Responder con los datos obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Ciudades encontradas exitosamente.',
            'Ciudades' => $cities
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

function updateCity()
{

    try {

        $response = new Response;





        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['name_city']) && isset($_POST['id_department']) && isset($_POST['id_city']) && !empty($_POST['name_city']) && !empty($_POST['id_department']) && !empty($_POST['id_city'])) {

            $City = [
                "name_city" => $_POST['name_city'],
                "id_department" => $_POST['id_department'],
                "id_city" => $_POST['id_city']
            ];

            (new City())->update($City['name_city'], $City['id_department'], $City['id_city']);


            // Responder con la ciudad actualizado
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Ciudad actualizada exitosamente.'
            ]);
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

function deleteCity()
{

    try {

        $response = new Response;




        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['id_city']) && !empty($_POST['id_city'])) {

            $id_city = $_POST['id_city'];

            $CityDeleted = (new City)->delete($id_city);

            if ($CityDeleted == true) {
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'Ciudad eliminada exitosamente.'
                ]);
            }else{

                $response->setStatusCode(404);
                $response->setBody([
                    'success' => false,
                    'error' => "Ciudad no encontrada"
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
