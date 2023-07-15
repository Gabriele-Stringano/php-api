<?php
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

if (!empty($data->Id)) {

    $country->Id = $data->Id;

    $stmt = $country->byTravel();

    $num = $stmt->rowCount();

    if ($num > 0) {
        $countries_arr = array();
        $countries_arr["records"] = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $country_item = array(
                "Name" => $Name,
            );
            // inseriti in un array PHP
            array_push($countries_arr["records"], $country_item);
        }
        http_response_code(200);
        echo json_encode($countries_arr);
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "No travels found.")
        );
    }
} else {
    //400 bad request
    http_response_code(400);
    echo json_encode(array("message" => "Error, wrong data, undefined property Id."));
}
