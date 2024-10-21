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



        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['name_department']) && !empty($_POST['name_department'])) {


            $Department = [
                "name_department" => $_POST['name_department']
            ];

            $DepartmentCreated = (new Department())->create($Department['name_department']);


            // Responder con success true si todo sale bien
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'Departamento creado:' => $DepartmentCreated

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



        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['id_department']) && !empty($_POST['id_department'])) {



            $Department = [
                "id_department" => $_POST['id_department']
            ];

            $departmentById = (new Department())->getById($Department['id_department']);


            if ($departmentById == null || empty($departmentById)) {

                $response->setStatusCode(404); // Código de estado para solicitud incorrecta
                $response->setBody([
                    'success' => false,
                    'error' => "Departamento no encontrado"
                ]);
            } else {

                // Responder con un error
                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'error' => 'encontrado existosamente.',
                    'Departamento:' => $departmentById
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

function updateDepartment()
{
    try {
        $response = new Response;

        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['name_department']) && isset($_POST['id_department']) && !empty($_POST['name_department']) && !empty($_POST['id_department'])) {


            $department = [
                "name_department" => $_POST['name_department'],
                "id_department" => $_POST['id_department']
            ];

            $departmentUpdated = (new Department())->update($department['name_department'], $department['id_department']);


            if ($departmentUpdated == true) {

                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'departamento actualizado exitosamente'
                ]);
            } else {

                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'message' => 'no se pudo actualizar'
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

function deleteDepartment()
{

    try {
        $response = new Response;





        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['id_department']) && !empty($_POST['id_department'])) {


            $department = [
                "id_department" => $_POST['id_department']
            ];


            $departmentDeleted = (new Department())->delete($department['id_department']);


            if ($departmentDeleted == true) {

                $response->setStatusCode(200);
                $response->setBody([
                    'success' => true,
                    'message' => 'departamento eliminado exitosamente'
                ]);
            } else {

                $response->setStatusCode(400);
                $response->setBody([
                    'success' => false,
                    'message' => 'no se pudo eliminar nada, departamento no existente'
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
