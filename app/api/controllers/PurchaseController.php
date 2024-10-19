<?php
$function = $_GET['function'];

switch ($function) {

    case "create":

        createPurchase();

        break;


    case "getAll":

        getAllPurchase();

        break;

    case "getById":

        getByIdPurchase();

        break;

    case "update":

        updatePurchase();

        break;

    case "delete":

        deletePurchase();

        break;
}

function createPurchase ()
{

    try {

        $response = new Response;
        
        $id_provider = $_POST['id_privider'];
        $date_purchase_order = $_POST['date_purchase_order'];
        $total_purchase_order = $_POST['total_purchase_order'];
        $id_payment_method = $_POST['id_payment_method'];
        $products = $_POST['list_products'];
        


        // para evitar enviar datos vacios a la base de datos

        if (!empty($_POST['id_privider','date_purchase_order','total_purchase_order','id_payment_method'])) {
        
            // valida que sea una array y no este vacia
            if(!empty($_POST['list_products']) && is_array($_POST['list_products'])){

            
            $purchase = (new Purchase())->create([$id_privider,$date_purchase_order,$total_purchase_order,$id_payment_method,$products]);
                if($purchase){

                
            // Responder de la orden de compra 
            $response->setStatusCode(200);
            $response->setBody([
                'success' => true,
                'message' => 'se agrego correctamente la orden de compra.',
            ]);
            } else{
                $response->setStatusCode(400);
                $response->setBody([
                'success' => true,
                'message' => 'no se pudo registrar la orden de compra.',
            ]);
            }  
         }
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