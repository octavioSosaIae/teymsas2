<?php

require_once dirname(__DIR__) . '../../core/Database.php';

class Product
{
    public function create($name)
    {
        try{
        $connection = new conn;
        $conn = $connection->connect();
        $stmt = $conn->prepare("INSERT INTO providers (name_provider) VALUES (?)");
        $stmt->bind_param("s", $name);
        if ($stmt->execute()) {
            return $name;
        } else {
            throw new Exception("Error al crear el proveedor: " . $stmt->error);
        }
    }catch(Exception $e){
        throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
    }
    }
    public static function getById($idProvider)
    {
        try{
        $connection = new conn;
        $conn = $connection->connect();
        $stmt = $conn->prepare("SELECT * FROM providers WHERE id_provider = ?");
        $stmt->bind_param("i", $idProvider);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $privides= $result->fetch_assoc() 
        } else {
                throw new Exception("Proveedor no encontrado". $stmt->error);
            }
         
        }catch(Exception $e){
        throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
    public function getAll()
    {
        try{
        $connection = new conn;
        $conn = $connection->connect();
        $stmt = $conn->prepare("SELECT * FROM providers");
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $provides= $result->fetch_assoc(MYSQLI_ASSOC);
            }
            
         else {
            throw new Exception("Error al obtener los proveedores: " . $stmt->error);
        }return $providers;
    }catch(Exception $e){
        throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
    }
    }
    public function update()
    {
        try{
        $connection = new conn;
        $conn = $connection->connect();
        $stmt = $conn->prepare("UPDATE providers SET name_provider = ? WHERE id_provider = ?");
        $stmt->bind_param("si", $name, $idProvider);
        if (!$stmt->execute()) {
            throw new Exception("Error al actualizar el proveedor: " . $stmt->error);
        }
    }catch(Exception $e){
        throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
    }
    }
    public function delete($idProvider)
    {
        try{
        $connection = new conn;
        $conn = $connection->connect();
        $stmt = $conn->prepare("DELETE FROM providers WHERE id_provider = ?");
        $stmt->bind_param("i", $idProvider);
        if (!$stmt->execute()) {
            throw new Exception("Error al eliminar el proveedor: " . $stmt->error);
        }
        }catch(Exception $e){
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
}   