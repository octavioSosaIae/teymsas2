<?php

require_once dirname(__DIR__) . '../../core/Database.php';

class Category
{
    // Funcion para crear una categoria
    public function create($description_category)
    {

        try {

            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("INSERT INTO categories (description_category) VALUES (?)");
            $stmt->bind_param("s", $description_category);
            if ($stmt->execute()) {
                return $description_category;
            } else {
                throw new Exception("Error al crear la categoría: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    public function getById($idCategory)
    {
        try {

            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM categories WHERE id_category = ?");

            $stmt->bind_param("i", $idCategory);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $category = $result->fetch_assoc();
            } else {
                throw new Exception("Categoría no encontrada" . $stmt->error);
            }
            return $category;
        } catch (Exception $e) {
            throw new Exception("Error al obtener la categoría: " . $e->getMessage());
        }
    }

    public function getAll()
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM categories");
            if ($stmt->execute()) {

                $result = $stmt->get_result();
                $categories = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                throw new Exception("Error al obtener las categorías: " . $stmt->error);
            }
            return $categories;
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
    public function update($description_category, $id_category)
    {
        try {

            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("UPDATE categories SET description_category = ? WHERE id_category = ?");
            $stmt->bind_param("si", $description_category, $id_category);
            if (!$stmt->execute()) {
                throw new Exception("Error al actualizar la categoría: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos:" . $e->getMessage());
        }
    }

    public function delete($id_category)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("DELETE FROM categories WHERE id_category = ?");
            $stmt->bind_param("i", $id_category);
            if (!$stmt->execute()) {
                throw new Exception("Error al eliminar la categoria: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos:" . $e->getMessage());
        }
    }
}
