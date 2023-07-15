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

if (!empty($data->Id))
 {
    $itinerary->Id = $data->Id;
    $itinerary->Country_id = !empty($data->Country_id) ? $data->Country_id : '';
    $itinerary->Travel_id = !empty($data->Travel_id) ? $data->Travel_id : '';
    try {
        if ($itinerary->update()) {
            http_response_code(200);
            echo json_encode(array("message" => "Itinerary updated"));
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Itinerary not found"));
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(array("message" => "Error updating itinerary: " . $e->getMessage()));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Error, missing field Id."));
}
