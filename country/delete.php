<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../database.php';
include_once '../models/Country.php';

$database = new Database();
$db = $database->getConnection();

$country = new Country($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->Name)) {
    $uppercaseName = ucfirst($data->Name);
    $country->Name = $uppercaseName;
    try {

        if ($country->delete()) {
            http_response_code(200);
            echo json_encode(array("message" => "Country deleted"));
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Country not found"));
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(array("message" => "Error deleting country: " . $e->getMessage()));
    }
} else {
    //400 bad request
    http_response_code(400);
    echo json_encode(array("message" => "Error, wrong data for country."));
}
