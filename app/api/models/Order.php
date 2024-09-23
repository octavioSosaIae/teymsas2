<?php

require_once dirname(__DIR__) . '../../core/Database.php';

class OrderStatus
{

    public function create($descriptionStatus)
    {
        try{
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("INSERT INTO order_status (description_status) VALUES (?)");
            $stmt->bind_param("s", $descriptionStatus);
          
            if ($stmt->execute()) {

            return true;


            } else {
            throw new Exception("Error al crear el estado del pedido: " . $stmt->error);
        } return true;
        }catch(Exception $e){
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
      
            


    public function getAll()
    {
        try{
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM order_status");
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $order_status=$result->fetch_assoc(MYSQLI_ASSOC);
            
            
        } else {
            throw new Exception("Error al obtener los estados del pedido: " . $stmt->error);
        }
        return $order_status;  
    }catch(Exception $e){
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    public function getById($idOrderStatus)
    {
        try{
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM order_status WHERE id_order_status = ?");
            $stmt->bind_param("i", $idOrderStatus);
            if ($stmt->execute()) {
            $result = $stmt->get_result();
            $order_status=$result->fetch_assoc();
            } else {
                throw new Exception("Estado del pedido no encontrado".$stmt->error);
            }
            
        } 
         catch(Exception $e){
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage()); 
        }
    }
     

    public function update()
    {
        try{
        $connection = new conn;
        $conn = $connection->connect();
        $stmt = $conn->prepare("UPDATE order_status SET description_status = ? WHERE id_order_status = ?");
        $stmt->bind_param("si", $descriptionStatus, $idOrderStatus);
        if (!$stmt->execute()) {
            throw new Exception("Error al actualizar el estado del pedido: " . $stmt->error);
        }
        }catch(Exception $e){
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());  
        }
    }

    public static function delete($idOrderStatus)
    {
        try{
        $connection = new conn;
        $conn = $connection->connect();
        $stmt = $conn->prepare("DELETE FROM order_status WHERE id_order_status = ?");
        $stmt->bind_param("i", $idOrderStatus);
        if (!$stmt->execute()) {
            throw new Exception("Error al eliminar el estado del pedido: " . $stmt->error);
        }
        }catch(Exception $e){
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage()); 
        }
    }
}

