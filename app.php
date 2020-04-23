<?php

require __DIR__ . '/vendor/autoload.php';

$path_info = $_SERVER['PATH_INFO'] ?? '/';
$request_method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$router = new \App\Project\Router\Router($path_info, $request_method);

$router->get('/hello', function (){
    return 'php small framework';
});

$route = $router->run();
echo $route['callback']();