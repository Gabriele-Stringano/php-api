<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../database.php';
include_once '../models/Country.php';

$database = new Database();
$db = $database->getConnection();

$country = new Country($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->Name) && !empty($data->NewName)) {
    $uppercaseName = ucfirst($data->Name);
    $uppercaseNewName = ucfirst($data->NewName);
    $country->NewName = $uppercaseNewName;
    $country->Name = $uppercaseName;
    try {
        if ($country->update()) {
            http_response_code(200);
            echo json_encode(array("message" => "Country updated"));
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Country not found"));
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(array("message" => "Error updating country: " . $e->getMessage()));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Error, wrong data for country."));
}
