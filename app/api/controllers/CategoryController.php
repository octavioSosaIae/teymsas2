<?php
require_once "../../core/Response.php";
require_once "../models/Category.php";

$function = $_GET['function'];

switch ($function) {
    case "create":
        create();
        break;

    case "getById":
        getById();
        break;

    case "getAll":
        getAll();
        break;

    case "update":
        update();
        break;

    case "delete":
        delete();
        break;
}

function create() {
  
        $response = new Response();
        $description = $_POST['description'];
        try {
            if (!$description) {
                throw new Exception("Descripción es requerida");
            }
            }
}