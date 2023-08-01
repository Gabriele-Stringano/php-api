<?php
// rendere accessibile la pagina read.php a qualsiasi dominio
header("Access-Control-Allow-Origin: *");
// restituire un contenuto di tipo JSON, codificato in UTF-8.
header("Content-Type: application/json; charset=UTF-8");

include_once '../database.php';
include_once '../models/Travel.php';

$database = new Database();
$db = $database->getConnection();
$travel = new Travel($db);

// query products
$stmt = $travel->read();

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
