<?php

require_once "../../core/Response.php";
require_once "../models/Department.php";

$function = $_GET['function'];

switch ($function) {

    case "create":

        createDepartment();

        break;


    case "getAll":

        getAllDepartments();

        break;

    case "getById":

        getByIdDepartment();

        break;

    case "update":

        updateDepartment();

        break;

    case "delete":

        deleteDepartment();

        break;
}



function createDepartment()
{

    try {

        $response = new Response;


        $Department = [
            "name_department" => $_POST['name_department']
        ];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['name_department'])) {


            $DepartmentCreated = (new Department())->create($Department['name_department']);


            // Responder con success true si todo sale bien
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'Departamento creado:' => $DepartmentCreated

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

function getAllDepartments()
{

    try {

        $response = new Response;

        $Departments = (new Department())->getAll();


        // Responder con los productos obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'departamentos obtenidos exitosamente.',
            'Departamentos:' => $Departments
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

function getByIdDepartment()
{


    try {
        $response = new Response;

        $Department = [
            "id_department" => $_POST['id_department']
        ];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['id_department'])) {

            $departmentById = (new Product())->getById($Department['id_department']);


            // Responder con OK
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'departamento encontrado',
                'Departamento:' => $departmentById
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

function updateDepartment()
{
    try {
        $response = new Response;


        $department = [
            "name_department" => $_POST['name_department'],
            "id_department" => $_POST['id_department']
        ];


        // para evitar enviar datos vacios a la base de datos



        if (!empty($_POST['name_department']) && !empty($_POST['id_department'])) {


            (new Department())->update($department['name_department'], $department['id_department']);


            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'departamento actualizado exitosamente'
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

function deleteDepartment()
{

    try {
        $response = new Response;


        $department = [
            "id_department" => $_POST['id_department']
        ];


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['id_department'])) {


            (new Department())->delete($department['id_department']);


            // Responder con success true si todo sale bien
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'Departamento eliminado exitosamente.'
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
