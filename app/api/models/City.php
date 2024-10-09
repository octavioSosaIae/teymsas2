<?php

require_once dirname(__DIR__) . '../../core/Database.php';

class City
{

    public function create($nameCity, $idDepartment)
    {
        try{
        $connection = new conn;
        $conn = $connection->connect();
        $stmt = $conn->prepare("INSERT INTO cities (name_city, id_departament) VALUES (?, ?)");
        $stmt->bind_param("si", $nameCity, $idDepartment);
        if ($stmt->execute()) {
            return $nameCity, $idDepartment;
        } else {
            throw new Exception("Error al crear la ciudad: " . $stmt->error);
        }
    }catch(Exception $e){
        throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
    }
    }

    public static function getAll()
    {
        try{
        $connection = new conn;
        $conn = $connection->connect();
        $stmt = $conn->prepare("SELECT * FROM cities");
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $cities = $result->fetch_assoc(MYSQLI_ASSOC);
            }
            
         else {
            throw new Exception("Error al obtener las ciudades: " . $stmt->error);
        }return $cities; 
    }catch(Exception $e){
        throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
    }
    }

    public function getById($idCity)
    {
        try{
        $connection = new conn;
        $conn = $connection->connect();
        $stmt = $conn->prepare("SELECT * FROM cities WHERE id_city = ?");
        $stmt->bind_param("i", $idCity);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $id_city = $result->fetch_assoc();
            } 
         else {
            throw new Exception("Error al obtener la ciudad: " . $stmt->error);
        } 
    }catch(Exception $e){
        throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
    }
    }

    public function update()
    {
        try{
        $connection = new conn;
        $conn = $connection->connect();
        $stmt = $conn->prepare("UPDATE cities SET name_city = ?, id_departament = ? WHERE id_city = ?");
        $stmt->bind_param("sii", $this->nameCity, $this->idDepartment, $this->idCity);
        if (!$stmt->execute()) {
            throw new Exception("Error al actualizar la ciudad: " . $stmt->error);
        }
    }catch(Exception $e){
        throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
    }
    }

    public function delete($idCity)
    {
        try{
        $connection = new conn;
        $conn = $connection->connect();
        $stmt = $conn->prepare("DELETE FROM cities WHERE id_city = ?");
        $stmt->bind_param("i", $idCity);
        if (!$stmt->execute()) {
            throw new Exception("Error al eliminar la ciudad: " . $stmt->error);
        }
    }catch(Exception $e){
        throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
    }
    }
}


