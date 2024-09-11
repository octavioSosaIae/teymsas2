<?php
require_once "../../core/Database.php";


class User{

        //  Función para registro de usuarios

    function register($complete_name, $email, $password, $full_name, $phone)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);



            $sql = "INSERT INTO users (complete_name_user, password_user, email_user, phone_user) VALUES('$complete_name','$hashedPassword', '$email','$full_name', '$phone');";
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

            session_start();
            $_SESSION['id_user'] = $user['id_user'];

            return $user;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
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
            throw new Exception($e->getMessage());
        }
    }
    
    //  Función para que devuelva la informacion de todos los usuarios por ID

    function getAllById($id)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $sql = "SELECT * FROM users WHERE id_user = '$id';";

            $response = $conn->query($sql);
            $user = $response->fetch_all(MYSQLI_ASSOC);
            return $user;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    
        //  Función para actualizar los usuarios sin la contraseña

         function updateWithoutPassword($complete_name, $email, $phone)
        {
            try {           
                $connection = new conn;
                $conn = $connection->connect();
                          
    
                $sql = "UPDATE users SET complete_name_user = '$complete_name', email_user = '$email',  phone_user = '$phone';";
                $response = $conn->query($sql);
                return $response;
            } catch (Exception) {
                return "Error";
            }
        }


     
    
}