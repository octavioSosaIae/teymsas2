<?php

class Category{
  
    public function create($description){
        //$response = new Response();

        $connection = new conn;
        $conn = $connection->connect();
        $sql = ("INSERT INTO categories (description_category) VALUES (?)");
        $response = $conn->query($sql);
        $result = $response->fetch_assoc();

        if ($result()) {
            return new self($conn, $description);
        } else {
            throw new Exception("Error al crear la categoría: " . error);
        }
    }
    public function update()
    {
   
        $sql =("UPDATE categories SET description_category = ? WHERE id_category = ?");
        $stmt->bind_param("si", $this->description, $this->idCategory);
        if (!$stmt->execute()) {
            throw new Exception("Error al actualizar la categoría: " . $stmt->error);
        }
    }

    public function delete($idCategory){

        {
            $mysqli = Database::getInstanceDB();
            $stmt = $mysqli->prepare("DELETE FROM categories WHERE id_category = ?");
            $stmt->bind_param("i", $idCategory);
            if (!$stmt->execute()) {
                throw new Exception("Error al eliminar la categoría: " . $stmt->error);
            }
        }
    }
    

}
?>