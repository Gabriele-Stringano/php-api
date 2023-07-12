<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// Una richiesta POST viene infatti utilizzata quando si ha la necessità di inviare al server alcune informazioni aggiuntive all'interno del suo body
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../database.php';
include_once '../models/Travel.php';

$database = new Database();
$db = $database->getConnection();
$travel = new Travel($db);

// Riceve una stringa codificata in formato JSON e la converte in una variabile PHP
// permette di recuperare il contenuto da file locali o URL tradizionali e memorizzarli in una stringa
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->AvailablePlaces)) {
    $travel->AvailablePlaces = $data->AvailablePlaces;
    try {
        if ($travel->create()) {
            http_response_code(201);
            echo json_encode(array("message" => "Travel added correctly."));
        } else {
            //503 service not foud
            http_response_code(503);
            echo json_encode(array("message" => "Error during creation of travel."));
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(array("message" => "Error creating travel: " . $e->getMessage()));
    }
} else {
    //400 bad request
    http_response_code(400);
    echo json_encode(array("message" => "Error, wrong data for travel, expected AvailablePlaces : int"));
}
