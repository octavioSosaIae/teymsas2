<?php
require_once dirname(__DIR__) . '../../core/Database.php';

class Delivery{

    public function create($id_delivery,$id_customer_order,$address_delivery,$date_delivery)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("INSERT INTO deliveries ($id_delivery,$id_customer_order,$address_delivery,$date_delivery) VALUES (?,)");
            $stmt->bind_param("s", $name_department);
            if ($stmt->execute()) {
                return $name_department;
            } else {
                throw new Exception("Error al crear el departamento: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }







    
}
