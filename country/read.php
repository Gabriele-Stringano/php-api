<?php
// rendere accessibile la pagina read.php a qualsiasi dominio
header("Access-Control-Allow-Origin: *");
// restituire un contenuto di tipo JSON, codificato in UTF-8.
header("Content-Type: application/json; charset=UTF-8");

include_once '../database.php';
include_once '../models/Country.php';

$database = new Database();
$db = $database->getConnection();
$country = new Country($db);

// query products
$stmt = $country->read();

// verificare che il risultato del metodo read() abbia ricevuto dei risultati 
$num = $stmt->rowCount();

if ($num > 0) {
    $countries_arr = array();
    $countries_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $country_item = array(
            "Id" => $Id,
            "Name" => $Name,
        );
        // inseriti in un array PHP
        array_push($countries_arr["records"], $country_item);
    }
    http_response_code(200);
    // ritornati in formato JSON grazie alla conversione data dalla funzione 
    echo json_encode($countries_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No countries found.")
    );
}
?>