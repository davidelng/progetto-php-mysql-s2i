<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once('core/bootstrap.php');

$request = new Request;
$request->decodeHttpRequest();

$db = new Database();
$db->openConnection($dbconfig);

$city = new City($db);

$recordset = $city->selectAll();

if ($recordset !== false) {
    http_response_code(201);
    echo json_encode($recordset);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Nessuna citta rovata."));
}
