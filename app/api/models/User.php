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
            $role = 'C';
            $stmt = $conn->prepare("INSERT INTO users (complete_name_user, email_user , password_user, phone_user, role_user) VALUES( ? , ? , ? , ? ,?);");
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt->bind_param("sssis", $complete_name, $email, $hashedPassword, $phone, $role);

            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error al crear el usuario: " . $stmt->error);
            }
        }catch(Exception $e)
        {
            throw new Exception("Error al conectar con la base de datos: ". $e->getMessage());
        }
    
    }


    //  Función para login de usuarios

    function login($email, $password)
    {

        $user=[];
        try {
            $connection = new conn;
            $conn = $connection->connect();

           $stmt= $conn->prepare("SELECT * FROM users WHERE email_user= ? ;");
           $stmt->bind_param("s" ,$email);



           if ($stmt->execute()) {

        
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

             if (!password_verify($password, $user['password_user'])) {
                 throw new Exception("Error al loguear el usuario: email o contraseña incorrecto");
             }

             $_SESSION['id_user'] = $user['id_user'];
            }  else {
            throw new Exception("Error al obtener los usuarios: " . $stmt->error);
        }

        return $user;

        
        }catch(Exception $e){

            throw new Exception("Error al conectar con la base de datos: ". $e->getMessage());
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


    //  Función para eliminar un usuario



    function delete()
    {


        try {
            $connection = new conn;
            $conn = $connection->connect();

            $id_user = $_SESSION['id_user'];

            $sql = "DELETE FROM users WHERE id_user='$id_user';";
            $response = $conn->query($sql);
            return $response;
        } catch (Exception $e) {
            throw new Exception("Error al eliminar los usuarios: " . $e->getMessage());
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
    {


        if (isset($_SESSION['id_user'])) {


            session_destroy();

            // Opcionalmente, borra la cookie de la sesión
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params["path"],
                    $params["domain"],
                    $params["secure"],
                    $params["httponly"]
                );
            }
        } else {

            return false;
        }

        return true;
    }
}
