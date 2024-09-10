<?php
require_once "../../core/Database.php";


class User{

        //  Función para registro de usuarios
        
    function register($username, $email, $password, $full_name, $phone)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO users (username, password_hash, email, full_name, phone) VALUES('$username','$hashedPassword', '$email','$full_name', '$phone');";
            $response = $conn->query($sql);

            return $response;

        } catch (Exception $e) {
            throw new Exception("Error al crear el usuario: " . $e->getMessage());
        }
    }

    function login(){}




}