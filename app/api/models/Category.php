<?php
class Category
{
    // Funcion para crear una categoria
    public function create($description)
    {
        $connection = new conn;
        $conn = $connection->connect();
        $mysqli = Database::getInstanceDB();
        $sql = ("INSERT INTO categories (description_category) VALUES (?)");
        $stmt->bind_param("s", $description);
        if ($stmt->execute()) {
            return new self($stmt->insert_id, $description);
        } else {
            throw new Exception("Error al crear la categoría: " . $stmt->error);
        }
    }
    public static function getById($idCategory)
    {
        $mysqli = Database::getInstanceDB();
        $stmt = $mysqli->prepare("SELECT * FROM categories WHERE id_category = ?");
        $stmt->bind_param("i", $idCategory);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                return new self($row['id_category'], $row['description_category']);
            } else {
                throw new Exception("Categoría no encontrada");
            }
        } else {
            throw new Exception("Error al obtener la categoría: " . $stmt->error);
        }
    }

    public static function getAll()
    {
        $mysqli = Database::getInstanceDB();
        $stmt = $mysqli->prepare("SELECT * FROM categories");
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $categories = [];
            while ($row = $result->fetch_assoc()) {
                $categories[] = [
                    'idCategory' => $row['id_category'],
                    'description' => $row['description_category']
                ];    
            }
            return $categories;
        } else {
            throw new Exception("Error al obtener las categorías: " . $stmt->error);
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