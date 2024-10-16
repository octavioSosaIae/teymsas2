<?php

require_once dirname(__DIR__) . '../../core/Database.php';
class PaymentMethod
{
    public function create($name_payment_method)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("INSERT INTO payment_methods (name_payment_method) VALUES (?)");
            $stmt->bind_param("s", $name_payment_method);
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error al crear el método de pago: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
    public function getAll()
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM payment_methods");
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $payment_methods = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                throw new Exception("Error al obtener los métodos de pago: " . $stmt->error);
            }
            return $payment_methods;
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
    public function getById($id_payment_method)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM payment_methods WHERE id_payment_method = ?");
            $stmt->bind_param("i", $id_payment_method);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $payment_methods = $result->fetch_assoc();
            } else {
                throw new Exception("Método de pago no encontrado");
            }

            // throw new Exception("Error al obtener el método de pago: " . $stmt->error);

            return $payment_methods;
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    public function update($name_payment_method, $id_payment_method)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("UPDATE payment_methods SET name_payment_method = ? WHERE id_payment_method = ?");
            $stmt->bind_param("si", $name_payment_method, $id_payment_method);
            if (!$stmt->execute()) {
                throw new Exception("Error al actualizar el método de pago: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
    public function delete($id_payment_method)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("DELETE FROM payment_methods WHERE id_payment_method = ?");
            $stmt->bind_param("i", $id_payment_method);
            if (!$stmt->execute()) {
                throw new Exception("Error al eliminar el método de pago: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
}
