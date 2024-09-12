<?php
require_once "../../core/Database.php";
session_start();

class User
{

    //  Función para registro de usuarios

    function register($complete_name, $email, $password, $phone)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);



            $sql = "INSERT INTO users (complete_name_user, password_user, email_user, phone_user, role_user) VALUES('$complete_name','$hashedPassword', '$email', '$phone','C');";
            $response = $conn->query($sql);

            return $response;
        } catch (Exception $e) {
            throw new Exception("Error al crear el usuario: " . $e->getMessage());
        }
    }

    //  Función para login de usuarios

    function login($email, $password)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $sql = "SELECT * FROM users WHERE email_user='$email';";

            $response = $conn->query($sql);
            $user = $response->fetch_assoc();

            if (!password_verify($password, $user['password_user'])) {
                throw new Exception("Error al loguear el usuario: email o contraseña incorrecto");
            }

            $_SESSION['id_user'] = $user['id_user'];

            return $user;
        } catch (Exception $e) {
            throw new Exception("Error al loguearse: " . $e->getMessage());
        }
    }


    //  Función para que devuelva la informacion de todos los usuarios

    function getAll()
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $sql = "SELECT * FROM users;";

            $response = $conn->query($sql);
            $user = $response->fetch_all(MYSQLI_ASSOC);

            return $user;
            
        } catch (Exception $e) {
            throw new Exception("Error al obtener los usuarios: " . $e->getMessage());
        }
    }

    //  Función para que devuelva la informacion de todos los usuarios por ID

    function getById($id)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $sql = "SELECT * FROM users WHERE id_user = '$id';";

            $response = $conn->query($sql);
            $user = $response->fetch_assoc();
            return $user;
        } catch (Exception $e) {
            throw new Exception("Error al obtener los usuarios: " . $e->getMessage());
        }
    }


    //  Función para actualizar los usuarios sin la contraseña

    function updateWithoutPassword($complete_name, $email, $phone)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();


            $id_user = $_SESSION['id_user'];

            $sql = "UPDATE users SET complete_name_user = '$complete_name', email_user = '$email',  phone_user = '$phone' WHERE id_user = '$id_user';";
            $response = $conn->query($sql);
            return $response;
        } catch (Exception $e) {
            throw new Exception("Error al actualizar el usuario: " . $e->getMessage());
        }
    }


    //  Función para actualizar la contraseña


    public function updatePassword($currentPassword, $newPassword)
    {

        try {
            $connection = new conn;
            $conn = $connection->connect();

            $id_user = $_SESSION['id_user'];

            $sql = "SELECT password_user FROM users WHERE id_user = '$id_user'";
            $response = $conn->query($sql);
            $result = $response->fetch_assoc();

            if ($result == NULL) {
                throw new Exception("No se encontro la contraseña del usuario");
            } else {
                if (!password_verify($currentPassword, $result['password_user'])) {
                    throw new Exception("La contraseña actual no coincide");
                }
            }

            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT); // para hashear la contraseña 

            $sql = "UPDATE users SET password_user = '$hashedPassword' WHERE id_user = '$id_user'";
            $response = $conn->query($sql);

            return $response;
        } catch (Exception $e) {
            throw new Exception("Error al actualizar la contraseña: " . $e->getMessage());
        }
    }




    //  Función para que un admin cree a otro admin

    function adminCreateAdmin($complete_name, $email, $password, $phone)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);



            $sql = "INSERT INTO users (complete_name_user, password_user, email_user, phone_user, role_user) VALUES('$complete_name','$hashedPassword', '$email', '$phone','A');";
            $response = $conn->query($sql);

            return $response;
        } catch (Exception $e) {
            throw new Exception("Error al crear el usuario: " . $e->getMessage());
        }
    }


    // funcion para salir de la sesion
    
    function logout()
    {}
}
