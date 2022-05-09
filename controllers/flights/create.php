<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'core/bootstrap.php';

$request = new Request;
$request->decodeHttpRequest();
$data = $request->getBody();

$db = new Database();
$db->openConnection($dbconfig);

$flight = new Flight($db);

if (
    !empty($data['departure']) &&
    !empty($data['arrival']) &&
    !empty($data['availableSeats'])
) {
    if ($flight->create($data)) {
        http_response_code(201);
        echo json_encode(array("message" => "Volo inserito correttamente."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Impossibile inserire il volo."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Dati incompleti."));
}
