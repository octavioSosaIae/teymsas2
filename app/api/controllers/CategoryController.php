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
        $response = new Response();
        $description = $_POST['description'];

        if (empty($description)) {
            throw new Exception("Descripción es requerida");
        }

        $category = Categorycreate($description);

        $response->setStatusCode(201);
        $response->setBody(['id' => $category->getIdCategory(), 'message' => 'Categoría creada exitosamente']);
    } catch (Exception $e) {
        $response->setStatusCode(400);
        $response->setBody(['success' => false, 'error' => $e->getMessage()]);
    }

    $response->send();
}

function getById() {
    try {
        $response = new Response();
        $id = $_GET['id'] ?? null; // Assuming the ID comes from the query parameters

        if (!is_numeric($id)) {
            throw new Exception("ID de categoría inválido");
        }

        $category = Category::getById(intval($id));

        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'idCategory' => $category->getIdCategory(),
            'description' => $category->getDescription()
        ]);
    } catch (Exception $e) {
        $response->setStatusCode(404);
        $response->setBody(['success' => false, 'error' => $e->getMessage()]);
    }

    $response->send();
}

function getAll() {
    try {
        $response = new Response();
        $categories = Category::getAll();

        $response->setStatusCode(200);
        $response->setBody(['success' => true, 'categories' => $categories]);
    } catch (Exception $e) {
        $response->setStatusCode(500);
        $response->setBody(['success' => false, 'error' => $e->getMessage()]);
    }

    $response->send();
}

function update() {
    try {
        $response = new Response();
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $_GET['id'] ?? null; // Assuming the ID comes from the query parameters

        if (!is_numeric($id)) {
            throw new Exception("ID de categoría inválido");
        }

        $category = Category::getById(intval($id));
        $description = $data['description'] ?? $category->getDescription();

        if (empty($description)) {
            throw new Exception("Descripción es requerida");
        }

        $category->setDescription($description);
        $category->update();

        $response->setStatusCode(200);
        $response->setBody(['success' => true, 'message' => 'Categoría actualizada exitosamente']);
    } catch (Exception $e) {
        $response->setStatusCode(400);
        $response->setBody(['success' => false, 'error' => $e->getMessage()]);
    }

    $response->send();
}

function delete() {
    try {
        $response = new Response();
        $id = $_GET['id'] ?? null; // Assuming the ID comes from the query parameters

        if (!is_numeric($id)) {
            throw new Exception("ID de categoría inválido");
        }

        Category::getById(intval($id));
        Category::delete(intval($id));

        $response->setStatusCode(200);
        $response->setBody(['success' => true, 'message' => 'Categoría eliminada exitosamente']);
    } catch (Exception $e) {
        $response->setStatusCode(400);
        $response->setBody(['success' => false, 'error' => $e->getMessage()]);
    }

    $response->send();
}

   