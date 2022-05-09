<?php

// include_once 'core/bootstrap.php';

// $request = new Request;
// $request->decodeHttpRequest();

// $db = new Database();
// $db->openConnection($dbconfig);

// $test = new City($db);
// $test = new Flight($db);
// $test->create();
// $test->update();
// $test->delete();
// $test->selectByCity();
// $test->selectBySeats();
// $test->selectAll();

// $routes = include_once('routes.php');
// $path = trim($_SERVER['REQUEST_URI'], '/');
// $method =  $_SERVER['REQUEST_METHOD'];

// if (array_key_exists($path, $routes[$method])) {
//     require $routes[$method][$path];
// } else {
//     http_response_code(404);
//     echo json_encode(array("message" => "Route inesistente."));
// }

include_once 'core/Router.php';
include_once 'core/Request.php';
$routes = include_once 'routes.php';

$request = new Request;
$request->decodeHttpRequest();

$router = new Router;
$router->load($routes);
$router->direct($request->getPath(), $request->getMethod());
