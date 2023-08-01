<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../database.php';
include_once '../models/Itinerary.php';

$database = new Database();
$db = $database->getConnection();
$itinerary = new Itinerary($db);

$stmt = $itinerary->read();

$num = $stmt->rowCount();

if ($num > 0) {
    $itineraries_arr = array();
    $itineraries_arr_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $itinerary_item = array(
            "Id" => $Id,
            "Country_id" => $Country_id,
            "Travel_id" => $Travel_id
        );
        array_push($itineraries_arr_arr["records"], $itinerary_item);
    }
    http_response_code(200);
    echo json_encode($itineraries_arr_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No Itineraries found.")
    );
}
