<?php

class Category{
  
    public static function create($description)
    {
        $mysqli = Database::getInstanceDB();
        $stmt = $mysqli->prepare("INSERT INTO categories (description_category) VALUES (?)");
        $stmt->bind_param("s", $description);
        if ($stmt->execute()) {
            return new self($stmt->insert_id, $description);
        } else {
            throw new Exception("Error al crear la categoría: " . $stmt->error);
        }
    }
    public function update()
    {
        $mysqli = Database::getInstanceDB();
        $stmt = $mysqli->prepare("UPDATE categories SET description_category = ? WHERE id_category = ?");
        $stmt->bind_param("si", $this->description, $this->idCategory);
        if (!$stmt->execute()) {
            throw new Exception("Error al actualizar la categoría: " . $stmt->error);
        }
    }

    public static function delete($idCategory)
    {
        $mysqli = Database::getInstanceDB();
        $stmt = $mysqli->prepare("DELETE FROM categories WHERE id_category = ?");
        $stmt->bind_param("i", $idCategory);
        if (!$stmt->execute()) {
            throw new Exception("Error al eliminar la categoría: " . $stmt->error);
        }
    }





}
?>