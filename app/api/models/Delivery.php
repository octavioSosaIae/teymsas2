<?php
require_once dirname(__DIR__) . '../../core/Database.php';

class Delivery{

    public function create($id_customer_order,$address_delivery,$date_delivery)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("INSERT INTO deliveries ('id_customer_order','address_delivery','date_delivery') VALUES (?,?,?)");
            $stmt->bind_param("i", $id_customer_order);
            $stmt->bind_param("s", $address_delivery;
            $stmt->bind_param("s", $date_delivery);

            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error al crear un envio: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }


        public static function getAll()
        {
            try {
                $connection = new conn;
                $conn = $connection->connect();
                $stmt = $conn->prepare("SELECT * FROM deliveries");
                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    $deliveries = $result->fetch_all(MYSQLI_ASSOC); // fetch_all para múltiples filas
                } else {
                    throw new Exception("Error al obtener las entregas: " . $stmt->error);
                }
                return $deliveries;
            } catch (Exception $e) {
                throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
            }
        }
    
        public function getById($id_delivery)
        {
            try {
                $connection = new conn;
                $conn = $connection->connect();
                $stmt = $conn->prepare("SELECT * FROM deliveries WHERE id_delivery = ?");
                $stmt->bind_param("i", $id_delivery);
                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                } else {
                    throw new Exception("Error al obtener la entrega: " . $stmt->error);
                }
            } catch (Exception $e) {
                throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
            }
        }
    
        public function update($delivery_person, $address, $status, $id_delivery)
        {
            try {
                $connection = new conn;
                $conn = $connection->connect();
                $stmt = $conn->prepare("UPDATE deliveries SET delivery_person = ?, address = ?, status = ? WHERE id_delivery = ?");
                $stmt->bind_param("sssi", $delivery_person, $address, $status, $id_delivery);
                if (!$stmt->execute()) {
                    throw new Exception("Error al actualizar la entrega: " . $stmt->error);
                }
            } catch (Exception $e) {
                throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
            }
        }
    
        public function delete($id_delivery)
        {
            try {
                $connection = new conn;
                $conn = $connection->connect();
                $stmt = $conn->prepare("DELETE FROM deliveries WHERE id_delivery = ?");
                $stmt->bind_param("i", $id_delivery);
                if (!$stmt->execute()) {
                    throw new Exception("Error al eliminar la entrega: " . $stmt->error);
                }
            } catch (Exception $e) {
                throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
            }
        }
    
     
}