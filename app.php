<?php

require __DIR__ . '/vendor/autoload.php';

use App\Project\Router\Router;
use App\Project\DI\Resolver;
use App\Project\Render\PHPRender;

$path_info = $_SERVER['PATH_INFO'] ?? '/';
$request_method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$router = new Router($path_info, $request_method);

require __DIR__.'/routes.php';

$route = $router->run();

$data = (new Resolver)->method($route['callback'], [
    'params' => $route['params'],
]);

$render = new PHPRender();
$render->setData($data);
$render->run();

// echo $route['callback']();
echo $data;