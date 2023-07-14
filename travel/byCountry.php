<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../database.php';
include_once '../models/Travel.php';

$database = new Database();
$db = $database->getConnection();
$travel = new Travel($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->countryName)) {

    $travel->countryName = $data->countryName;

    // query products
    $stmt = $travel->byCountry();

    // verificare che il risultato del metodo read() abbia ricevuto dei risultati 
    $num = $stmt->rowCount();

    if ($num > 0) {
        $travels_arr = array();
        $travels_arr["records"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $travel_item = array(
                "Id" => $Id,
                "AvailablePlaces" => $AvailablePlaces,
            );
            // inseriti in un array PHP
            array_push($travels_arr["records"], $travel_item);
        }
        http_response_code(200);
        // ritornati in formato JSON grazie alla conversione data dalla funzione 
        echo json_encode($travels_arr);
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "No travels found.")
        );
    }
}else{
        //400 bad request
        http_response_code(400);
        echo json_encode(array("message" => "Error, wrong data, undefined property countryName."));
}
