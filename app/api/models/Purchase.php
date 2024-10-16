<?php
require_once dirname(__DIR__) . '../../core/Database.php';

class Purchase{

    function create($id_purchase_order,$id_provider,$date_purchase_order,$total_purchase_order,$id_payment_method){
    try{
        $connection = new conn;
        $conn = $connection->connect();
        $stmt = $conn->prepare("INSERT INTO purchase (id_purchase_order,id_provider,date_purchase_order,total_purchase_order,id_payment_method) VALUES( ? , ? , ? , ? ,?);");
        $stmt->bind_param("sssis", $id_purchase_order,$id_provider,$date_purchase_order,$total_purchase_order,$id_payment_method);
        if($stmt->execute()){
            return true;
        } else{
            throw new Exception("Error al agregar la compra: " . $stmt->error);
        }
    }catch(Exception $e){
        throw new Exception("Error al conectar con la base de datos: " . $e->getMessage()); 
    }      
    }

    function getAll(){
    try{
        $connection = new conn;
        $conn = $connection->connect();
        $stmt = $conn->prepare("SELECT * FROM purchase;");
        if($stmt->execute()){
            $result = $stmt->get_result();
            $purchase = $result->fetch_all(MYSQLI_ASSOC);   
        }else{
            throw new Exception("Error al obtener las compras: " . $stmt->error);
        }
        return $purchase;
    }catch(Exception $e){
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    
    }

    function getById($id_purchase_order){
    try{
        $connection = new conn;
        $conn = $connection->connect();
        $stmt = $conn->prepare("SELECT * FROM purchase WHERE id_purchase_order = ?;");
        $stmt->bind_param("i", $id_purchase_order);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $purchase = $result->fetch_assoc();
        } else {
            throw new Exception("Error al obtener la compra: " . $stmt->error);
        }

        return $purchase;
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
            throw new Exception("Error al actualizar la compra: " . $stmt->error);
        }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
        }   

    
   function delete($id_purchase_order)
    {
    try {
        $connection = new conn;
        $conn = $connection->connect();

        $stmt = $conn->prepare("DELETE FROM purchase WHERE id_purchase_order = ?;");
        $stmt->bind_param("i", $id_purchase_order);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Error al eliminar la compra: " . $stmt->error);
        }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    } 




}    
