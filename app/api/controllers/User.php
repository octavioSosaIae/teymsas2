<?php
require_once "../../core/Response.php";
require_once "../models/User.php";


$function = $_GET['function'];

switch ($function) {

    case "login":

        login();

        break;


    case "register":

        register();

        break;

    case "getAll":

        getAllUsers();

        break;

    case "getById":

        getUsersById();

        break;

    case "updateWithoutPassword":

        updateWithoutPass();

        break;

    case "updatePassword":

        updatePasswordUser();

        break;

    case "adminCreateAdmin":

        break;
}




function login()
{
    try {

        $response = new Response;


        $user = [
            "email_user" => $_POST['email_user'],
            "password_user" => $_POST['password_user']
        ];


        (new User())->login($user['email_user'], $user['password_user']);

        // Responder con el usuario logueado
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Usuario logueado exitosamente.'
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



function register()
{
    try {

        $response = new Response;


        $user = [
            "complete_name_user" => $_POST['complete_name_user'],
            "email_user" => $_POST['email_user'],
            "password_user" => $_POST['password_user'],
            "phone_user" => $_POST['phone_user']

        ];


        (new User())->register($user['complete_name_user'], $user['email_user'], $user['password_user'], $user['phone_user']);


        // Responder con el usuario registrado
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Usuario registrado exitosamente.',
            $user
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


function getAllUsers()
{

    try {

        $response = new Response;

        $users = (new User())->getAll();


        // Responder con los usuarios obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Usuarios obtenidos exitosamente.',
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

function getUsersById()
{

    try {

        $response = new Response;

        $id_user = $_POST['id_user'];

        $users = (new User())->getById($id_user);


        // Responder con los usuarios obtenidos
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Usuario obtenido exitosamente.',
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

function updateWithoutPass()
{

    try {

        $response = new Response;


        $user = [
            "complete_name_user" => $_POST['complete_name_user'],
            "email_user" => $_POST['email_user'],
            "phone_user" => $_POST['phone_user']

        ];


        (new User())->updateWithoutPassword($user['complete_name_user'], $user['email_user'], $user['phone_user']);


        // Responder con el usuario actualizado
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Usuario actualizado exitosamente.'
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

function updatePasswordUser()
{

    try {

        $response = new Response;


        $password = [
            "current_password" => $_POST['current_password'],
            "new_password" => $_POST['new_password']

        ];


        (new User())->updatePassword($password['current_password'], $password['new_password']);


        // Responder con el usuario actualizado
        $response->setStatusCode(200);
        $response->setBody([
            'success' => true,
            'message' => 'Contraseña actualizada exitosamente.'
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
