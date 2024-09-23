<?php

require_once "../../core";

class Provider
{


    function add($name_provider)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("INSERT INTO providers (name_provider) VALUES(?);");
            $stmt->bind_param("s", $name_provider);

            if ($stmt->execute()) {

                return $stmt->insert_id;
            } else {
                throw new Exception("Error al agregar el proovedor: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }


    function getAll()
    {

        try {
            $connection = new conn;
            $conn = $connection->connect();


            $stmt = $conn->prepare("SELECT * FROM providers;");

            if ($stmt->execute()) {


                $result = $stmt->get_result();
                $users = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                throw new Exception("Error al obtener los proovedores: " . $stmt->error);
            }

            return $users;
        } catch (Exception $e) {

            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    function update($name_provider, $id_provider)
    {

        try {
            $connection = new conn;
            $conn = $connection->connect();

            $stmt = $conn->prepare("UPDATE providers SET name_provider = ? WHERE id_provider = ? ;");
            $stmt->bind_param("ssii", $name_provider, $id_provider);

            if ($stmt->execute()) {

                return true;
            } else {
                throw new Exception("Error al actualizar proovedor: " . $stmt->error);
            }
        } catch (Exception $e) {

            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }


    function delete($id_provider)
    {

        try {
            $connection = new conn;
            $conn = $connection->connect();

            $stmt = $conn->prepare("DELETE FROM providers WHERE id_provider = ?;");
            $stmt->bind_param("i", $id_provider);

            if ($stmt->execute()) {

                return true;
            } else {
                throw new Exception("Error al eliminar proovedor: " . $stmt->error);
            }

            return $users;
        } catch (Exception $e) {

            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
}
