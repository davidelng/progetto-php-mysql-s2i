<?php

include_once 'app/controllers/CityController.php';
include_once 'app/controllers/FlightController.php';

class Router
{
    protected $routes;

    function load($routes)
    {
        $this->routes = $routes;
    }

    function direct($path, $method)
    {
        if (array_key_exists($path, $this->routes[$method])) {
            return $this->callAction(...explode('@', $this->routes[$method][$path]));
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Route inesistente."));
        }
    }

    protected function callAction($controller, $action)
    {
        $controller = new $controller;

        if (!method_exists($controller, $action)) {
            throw new Exception(
                "{$controller} non ha l'azione {$action}."
            );
        }

        return $controller->$action();
    }
}
