<?php
require_once dirname(__DIR__) . '../../core/Database.php';

class Review{

    function create($id_review,$id_customer_order,$id_product,$id_customer,$rating_review,$comment_review,$created_at_review){
        try{
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("INSERT INTO review ($id_review,$id_customer_order,$id_product,$id_customer,$rating_review,$comment_review,$created_at_review) VALUES( ? , ? , ? , ? , ?, ?, ?);");
            $stmt->bind_param("sssis", $id_review,$id_customer_order,$id_product,$id_customer,$rating_review,$comment_review,$created_at_review);
            if($stmt->execute()){
                return true;
            } else{
                throw new Exception("Error al agregar el comentario: " . $stmt->error);
            }
        }catch(Exception $e){
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage()); 
        }      
        }

    function getAll(){
        try{
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM review;");
            if($stmt->execute()){
                $result = $stmt->get_result();
                $review = $result->fetch_all(MYSQLI_ASSOC);   
            }else{
                throw new Exception("Error al obtener el comentario: " . $stmt->error);
            }
                return $review;
            }catch(Exception $e){
                    throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
                }
            }

    function getById($id_review){
        try{
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM review WHERE id_review = ?;");
            $stmt->bind_param("i", $id_review);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $review = $result->fetch_assoc();
            } else {
                throw new Exception("Error al obtener el comentario: " . $stmt->error);
            }
            return $review;
            } catch (Exception $e) {
                throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
            }
            }


    function update()
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            
            $stmt = $conn->prepare("UPDATE purchase SET  = ? WHERE = ? ;");
            $stmt->bind_param("ssii", , );
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Error al actualizar el comentario: " . $stmt->error);
            }
            } catch (Exception $e) {
                throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
            }
            }               


    function delete($id_review)
    {
    try {
        $connection = new conn;
        $conn = $connection->connect();

        $stmt = $conn->prepare("DELETE FROM review WHERE id_review = ?;");
        $stmt->bind_param("i", $id_review);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Error al eliminar el comentario: " . $stmt->error);
        }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    } 


}