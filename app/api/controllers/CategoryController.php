<?php
require_once "../../core/Response.php";
require_once "../models/Category.php";

$function = $_GET['function'];

switch ($function) {
    case "create":
        create();
        break;

    case "getById":
        getById();
        break;

    case "getAll":
        getAll();
        break;

    case "update":
        update();
        break;

    case "delete":
        delete();
        break;
}

function create() {
  
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

function getById(){

}

function getAll(){

}

function update(){

}

function delete(){
    
}