<?php

return $routes = [
    'GET' => [
        'cities' => 'controllers/cities/read.php',
        'flights' => 'controllers/flights/read.php',
        'flights/cities' => 'controllers/flights/filter.php',
        "flights/seats" => 'controllers/flights/filter.php'
    ],
    'POST' => [
        'cities' => 'controllers/cities/create.php',
        'flights' => 'controllers/flights/create.php'
    ],
    'PUT' => [
        'cities' => 'controllers/cities/update.php',
        'flights' => 'controllers/flights/update.php'
    ],
    'DELETE' => [
        'cities' => 'controllers/cities/delete.php',
        'flights' => 'controllers/flights/delete.php'
    ]
];
