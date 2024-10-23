<?php
$function = $_GET['function'];

switch ($function) {

    case "create":

        createPurchase();

        break;
}
//     case "getAll":

//         getAllPurchase();

//         break;

//     case "getById":

//         getByIdPurchase();

//         break;

//     case "update":

//         updatePurchase();

//         break;

//     case "delete":

//         deletePurchase();

//         break;
// }

function createPurchase()
{

    try {

        $response = new Response;


        // para evitar enviar datos vacios a la base de datos

        if (isset($_POST['id_provider']) && isset($_POST['date_purchase_order']) && isset($_POST['total_purchase_order']) && isset($_POST['id_payment_method']) && !empty($_POST['id_provider']) && !empty($_POST['date_purchase_order']) && !empty($_POST['total_purchase_order']) && !empty($_POST['id_payment_method'])) {



            // valida que sea una array y no este vacia
            if (isset($_POST['list_products']) && !empty($_POST['list_products']) && is_array($_POST['list_products'])) {

                $id_provider = $_POST['id_provider'];
                $date_purchase_order = $_POST['date_purchase_order'];
                $total_purchase_order = $_POST['total_purchase_order'];
                $id_payment_method = $_POST['id_payment_method'];
                $products = $_POST['list_products'];


                $purchase = (new Purchase())->create($id_provider, $date_purchase_order, $total_purchase_order, $id_payment_method, $products);
                if ($purchase == true) {


                    // Responder de la orden de compra 
                    $response->setStatusCode(200);
                    $response->setBody([
                        'success' => true,
                        'message' => 'se agrego correctamente la orden de compra.',
                    ]);
                } else {
                    $response->setStatusCode(400);
                    $response->setBody([
                        'success' => true,
                        'message' => 'no se pudo registrar la orden de compra.',
                    ]);
                }
            }
        } else {

            $response->setStatusCode(400);
            $response->setBody([
                'success' => false,
                'error' => 'Todos los campos son obligatorios.'
            ]);
        }
    } catch (Exception $e) {

        // Responder con un error
        $response->setStatusCode(400); // Código de estado para solicitud incorrecta
        $response->setBody([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }

    $response->send();
}
// function getAll(){

// }

// function getById(){

// }
// function update(){

// }

// function delete(){
    
// }