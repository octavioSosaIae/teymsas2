<?php

require_once "../../core/Database.php";
require_once "User.php";

class Customer
{

    


    //  Función para registro de clientes

    function register($complete_name_user, $email_user, $password_user, $phone_user, $document_customer,$address_customer, $business_name_customer,	$rut_customer, $id_city	)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $user = (new User())->register($complete_name_user, $email_user, $password_user, $phone_user, 'C');

            $id_user_customer = $user;  // retorna el id_user para insertar foreign key id_user_customer
            
            $stmt = $conn->prepare("INSERT INTO customers (id_user_customer, document_customer,	address_customer, business_name_customer,	rut_customer, id_city	) VALUES(? ,? , ? , ? , ? ,?);");
            $stmt->bind_param("issssi", $id_user_customer ,$document_customer,	$address_customer, $business_name_customer,	$rut_customer, $id_city);

            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error al crear el usuario: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }




    
}
