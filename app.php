<?php

require __DIR__ . '/vendor/autoload.php';

use App\Project\Router\Router;
use App\Project\DI\Resolver;

$path_info = $_SERVER['PATH_INFO'] ?? '/';
$request_method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$router = new Router($path_info, $request_method);

$router->get('/hello', function (){
    return 'php small framework';
});

$route = $router->run();

$data = (new Resolver)->method($route['callback'], [
    'params' => $route['params'],
]);

// echo $route['callback']();
echo $data;