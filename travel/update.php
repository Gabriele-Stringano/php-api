<?php
//headers
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

if (!empty($data->Id) && !empty($data->AvailablePlaces)) {
    $travel->Id = $data->Id;
    $travel->AvailablePlaces = $data->AvailablePlaces;
    try {
        if ($travel->update()) {
            http_response_code(200);
            echo json_encode(array("message" => "Travel updated"));
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Travel not found"));
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(array("message" => "Error updating travel: " . $e->getMessage()));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Error, wrong data for travel."));
}
