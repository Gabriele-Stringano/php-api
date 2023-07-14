<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../database.php';
include_once '../models/Itinerary.php';

$database = new Database();
$db = $database->getConnection();
$itinerary = new Itinerary($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->Country_id) && !empty($data->Travel_id)) {
    $itinerary->Country_id = $data->Country_id;
    $itinerary->Travel_id = $data->Travel_id;
    try {
        if ($itinerary->create()) {
            http_response_code(201);
            echo json_encode(array("message" => "Itinerary added correctly."));
        } else {
            //503 service not foud
            http_response_code(503);
            echo json_encode(array("message" => "Error during creation of itinerary."));
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(array("message" => "Error creating itinerary: " . $e->getMessage()));
    }
} else {
    //400 bad request
    http_response_code(400);
    echo json_encode(array("message" => "Error, wrong data for itinerary."));
}
