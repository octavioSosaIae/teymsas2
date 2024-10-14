<?php
require_once "../../core/Response.php";
require_once "../models/Category.php";

$function = $_GET['function'];

switch ($function) {
    case "create":
        createCategory();
        break;

    case "getById":
        getByIdCategory();
        break;

    case "getAll":
        getAllCategories();
        break;

    case "update":
        updateCategory();
        break;

    case "delete":
        deleteCategory();
        break;
}

function createCategory()
{

    try {

        $response = new Response;


        $category = [
            "description_category" => $_POST['description_category'],

        ];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['description_category'])) {


            (new Category())->create($category['description_category']);


            // Responder con success true si todo sale bien
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Categoria agregada con exito'
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

function getByIdCategory()
{

    try {

        $response = new Response;

        $id_category = $_POST['id_category'];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['id_category'])) {


            $category = (new Category)->getById($id_category);


            // Responder con los usuarios obtenidos
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Categoria encontrada exitosamente.',
                'categoria' => $category
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

function getAllCategories()
{

    try {

        $response = new Response;




        $categories = (new Category)->getAll();


        // Responder con los usuarios obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Categorias encontradas exitosamente.',
            'categorias' => $categories
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

function updateCategory()
{

    try {

        $response = new Response;


        $category = [
            "description_category" => $_POST['description_category'],
            "id_category" => $_POST['id_category']
        ];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['description_category']) && !empty($_POST['id_category'])) {

            (new Category())->update($category['description_category'], $category['id_category']);


            // Responder con el usuario actualizado
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Categoria actualizada exitosamente.'
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

function deleteCategory()
{

    try {

        $response = new Response;

        $id_category = $_POST['id_category'];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['id_category'])) {


            $category = (new Category)->delete($id_category);


            // Responder con los usuarios obtenidos
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Categoria eliminada exitosamente.'
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
