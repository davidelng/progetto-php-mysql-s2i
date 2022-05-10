<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'core/bootstrap.php';

$request = new Request;
$request->decodeHttpRequest();
$data = $request->getBody();

$db = new Database();
$db->openConnection($dbconfig);

$flight = new Flight($db);

if (!empty($data['id'])) {
    if ($flight->delete($data)) {
        http_response_code(200);
        echo json_encode(array("message" => "Volo eliminato."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Impossibile eliminare il volo."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Dati incompleti."));
}
