<?php
class Category
{
    // Funcion para crear una categoria
    public function create($description)
    {
    try{
        $connection = new conn;
        $conn = $connection->connect();
        $sql = "INSERT INTO categories (description_category) VALUES (?)";
        $response = $conn->query($sql);
        return $response;
    }catch(Exception $e){
        throw new Exception("Error al obtener la categoría: " . $e);
    }
   

    }

    public function getById($idCategory)
    {
        try {
        
        $connection = new conn;
        $conn = $connection->connect();

        
        $sql = ("SELECT * FROM categories WHERE id_category = ?");
        $respose = $conn->query($sql);
        return $respose;
       
        } catch (Exception $e) {
        throw new Exception("Error al obtener la categoría: " . $e);
    }
}


    public static function getAll()
    {
        try{
        $connection = new conn;
        $conn = $connection->connect();
        $sql = ("SELECT * FROM categories");
        $response = $conn->query($sql);
        $categories = $response-> fetch_all(MYSQLI_ASSOC);
        return $categories;

       }catch(Exception $e){
            throw new Exception("Error al obtener las categorías: " . $e);
        }
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
            throw new Exception("Error al actualizar la categoría: " . $e);
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
            throw new Exception("Error al eliminar la categoría: " . $e);
        }
    }

    
}

?>