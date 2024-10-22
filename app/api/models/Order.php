<?php

require_once dirname(__DIR__) . '../../core/Database.php';

class Order
{

    public function create($date_order, $total_order, $id_payment_method, $id_order_status, $updated_by_order, $orders)
    {

        $id_customer = $_SESSION['id_user'];
        $updated_by_order = $_SESSION['id_user'];

        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("INSERT INTO customer_orders (id_customer, date_order, total_order, id_payment_method, id_order_status, updated_by_order) VALUES (?,?,?,?,?,?);");
            $stmt->bind_param("isiiii", $id_customer, $date_order, $total_order, $id_payment_method, $id_order_status, $updated_by_order);
            if ($stmt->execute()) {

                $id_purchase_order = $stmt->insert_id;
                foreach ($orders as $order) {
                    $stmt = $conn->prepare("INSERT INTO order_products_customer(id_customer_order, id_product, quantity_order_product_customer, unit_price_order_product_customer, total_order_product_customer) VALUES(? , ? , ? , ? , ?);");

                    
                    $id_product = $order['product_id'];
                    $quantity = $order['quantity'];
                    $unit_price = $order['unit_price'];
                    $total_order = $quantity * $unit_price;

                    $stmt->bind_param("iiidd", $id_customer_order, $id_product, $quantity_order_product_customer, $unit_price_order_product_customer, $total_order_product_customer);
                   
                    if ($stmt->execute()) {
                        return true;
                    } else {
                        return false;
                    }
                }

            } else {
                throw new Exception("Error al agregar la orden: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }


    public function getAll(){

        try {
            $connection = new conn;
            $conn = $connection->connect();


            $stmt = $conn->prepare("SELECT co.id_customer_order, co.id_customer, co.date_order, co.total_order, co.id_payment_method, co.id_order_status, co.updated_at_order, co.updated_by_order, u.complete_name_user FROM customer_orders AS co INNER JOIN users AS u ON co.id_customer = u.id_user;");

            if ($stmt->execute()) {

                $result = $stmt->get_result();
                $users = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                throw new Exception("Error al obtener las ordenes: " . $stmt->error);
            }

            return $users;
        } catch (Exception $e) {

            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }

    }

    public function getProductsOrder(){
        
    }

    public function getById($id_customer_order)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();
            $stmt = $conn->prepare("SELECT * FROM order_products_customers WHERE id_order_product_customer = ?");
            $stmt->bind_param("i", $id_customer_order);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $order_status = $result->fetch_assoc();
            } else {
                throw new Exception("Pedido no encontrado " . $stmt->error);
            }
            return $order_status;
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }


    public function update($id_product, $quantity_order_product_customer, $unit_price_order_product_customer, $total_order_product_customer)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $id_customer = $_SESSION['id_user'];

            $stmt = $conn->prepare("UPDATE order_products_customers SET id_order_product_customer = ?, id_customer_order = ?,	id_product = ?,	quantity_order_product_customer = ?, unit_price_order_product_customer = ?,	total_order_product_customer = ? WHERE id_order_product_customer = ?");
            $stmt->bind_param("iiiidd", $id_customer, $id_product, $quantity_order_product_customer, $unit_price_order_product_customer, $total_order_product_customer);
            if (!$stmt->execute()) {
                throw new Exception("Error al actualizar el pedido: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    public static function delete($id_order_product_customer)
    {
        try {
            $connection = new conn;
            $conn = $connection->connect();

            $stmt = $conn->prepare("DELETE FROM order_products_customers WHERE id_order_product_customer = ?");
            $stmt->bind_param("i", $id_order_product_customer);
            if (!$stmt->execute()) {
                throw new Exception("Error al eliminar el producto del pedido: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }
}
