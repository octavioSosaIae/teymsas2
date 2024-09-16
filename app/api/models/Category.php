<?php
class Category
{
    // Funcion para crear una categoria
    public function create($description)
{
   
    $connection = new conn;
    $conn = $connection->connect();

   
    $sql = "INSERT INTO categories (description_category) VALUES (?)";
    $stmt = $conn->prepare($sql);

    if ($stmt == false) {
        throw new Exception("Error al preparar la consulta: " . $conn->error);
    }

    
    $stmt->bind_param("s", $description);


    if ($stmt->execute()) {
       
        $insert_id = $stmt->insert_id;
    
        return new self($insert_id, $description);
    } else {
        throw new Exception("Error al crear la categoría: " . $stmt->error);
    }
}

public function getById($idCategory)
{
    try {
        
        $connection = new conn;
        $conn = $connection->connect();

        
        $stmt = $conn->prepare("SELECT * FROM categories WHERE id_category = ?");
        if ($stmt === false) {
            throw new Exception("Error al preparar la consulta: " . $conn->error);
        }

        
        $stmt->bind_param("i", $idCategory);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                return new self($row['id_category'], $row['description_category']);
            } else {
                throw new Exception("Categoría no encontrada");
            }
        } else {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }
    } catch (Exception $e) {
        throw new Exception("Error al obtener la categoría: " . $e->getMessage());
    }
}


    public static function getAll()
    {
        try{
        $connection = new conn;
        $conn = $connection->connect();

       $sql = ("SELECT * FROM categories");
       $categories = $response-> feche_all(MYSQL_ASSOC);
       return $categories;
       $response = $conn->query($sql);
       return $categories;
       

       }catch(Exception $e)
            throw new Exception("Error al obtener las categorías: " . $e->error);
        }
    
    public function update()
    {
        try{
        
        $connection = new conn;
        $conn = $connection->connect();
        $sql=("UPDATE categories SET description_category = ? WHERE id_category = ?");
        $response = $conn->query($sql);
        return $response;
        }
        catch (Exception $e){
            throw new Exception("Error al actualizar la categoría: " . $e->error);
        }
    }

    public static function delete($idCategory)
    {
       try{
        $connection = new conn;
        $conn = $connection->connect();
        $sql=("DELETE FROM categories WHERE id_category = ?");
        $response = $conn->query($sql);
        return $response;
       }catch (Exception $e){
            throw new Exception("Error al eliminar la categoría: " . $e->error);
        }
    }

}

?>