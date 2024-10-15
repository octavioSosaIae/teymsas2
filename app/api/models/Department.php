<?php

require_once dirname(__DIR__) . '../../core/Database.php';

class Department
{
    public function create($nameDepartment)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("INSERT INTO departments (name_departament) VALUES (?)");
            $stmt->bind_param("s", $nameDepartment);
            if ($stmt->execute()) {
                return $nameDepartment;
            } else {
                throw new Exception("Error al crear el departamento: " . $stmt->error);
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
            $stmt = $conn->prepare("SELECT * FROM departments");
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $departments = $result->fetch_assoc(MYSQLI_ASSOC);
            } else {
                throw new Exception("Error al obtener los departamentos: " . $stmt->error);
            }
            return $departments;
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
    public function getById($idDepartment)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM departments WHERE id_departament = ?");
            $stmt->bind_param("i", $idDepartment);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $departments = $result->fetch_assoc();
            } else {
                throw new Exception("Departamento no encontrado");
            }
            return $departments;
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
    public function update($nameDepartment, $idDepartment)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("UPDATE departments SET name_departament = ? WHERE id_departament = ?");
            $stmt->bind_param("si", $nameDepartment, $idDepartment);
            if (!$stmt->execute()) {
                throw new Exception("Error al actualizar el departamento: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
    public static function delete($idDepartment)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("DELETE FROM departments WHERE id_departament = ?");
            $stmt->bind_param("i", $idDepartment);
            if (!$stmt->execute()) {
                throw new Exception("Error al eliminar el departamento: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
}
