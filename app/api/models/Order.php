<?php

require_once dirname(__DIR__) . '../../core/Database.php';

class OrderStatus
{

    public function create($descriptionStatus)
    {
        try{
            $connection = new conn;
            $conn = $connection->connect();
            $sql=("INSERT INTO order_status (description_status) VALUES (?)");
            $response = $conn->query($sql);
            return $response;
            }catch(Exception $e){
                throw new Exception("Error al crear el estado del pedido: " . $e->getMessage());
            }    
    } 
      
            


    public function getAll()
    {
        try{
            $connection = new conn;
            $conn = $connection->connect();
            $sql=("SELECT * FROM order_status");
            $response = $conn ->query($sql);
            $statuses= $response->fetch_all(MYSQLI_ASSOC);
            return $statuses;

        }catch(Exception $e){
        
        throw new Exception("Error al obtener los estados del pedido: " . $e);
        }
    }

    public function getById($idOrderStatus)
    {
        try{
            $connection = new conn;
            $conn = $connection->connect();
            $sql=("SELECT * FROM order_status WHERE id_order_status = ?");
            $respo
        
                throw new Exception("Estado del pedido no encontrado");
            }catch(Exception $e)
            throw new Exception("Error al obtener el estado del pedido: " . $e);
        }
    }

    public function update()
    {
        $mysqli = Database::getInstanceDB();
        $stmt = $mysqli->prepare("UPDATE order_status SET description_status = ? WHERE id_order_status = ?");
        $stmt->bind_param("si", $this->descriptionStatus, $this->idOrderStatus);
        if (!$stmt->execute()) {
            throw new Exception("Error al actualizar el estado del pedido: " . $stmt->error);
        }
    }

    public static function delete($idOrderStatus)
    {
        $mysqli = Database::getInstanceDB();
        $stmt = $mysqli->prepare("DELETE FROM order_status WHERE id_order_status = ?");
        $stmt->bind_param("i", $idOrderStatus);
        if (!$stmt->execute()) {
            throw new Exception("Error al eliminar el estado del pedido: " . $stmt->error);
        }
    }

}