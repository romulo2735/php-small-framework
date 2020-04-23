<?php


namespace App\Project;

use App\Project\Router\Router;
use App\Project\DI\Resolver;
use App\Project\Render\PHPRenderInterface;

class App
{
    private $router, $render;

    public function __construct()
    {
        $path_info = $_SERVER['PATH_INFO'] ?? '/';
        $request_method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $this->router = new Router($path_info, $request_method);
    }

    public function setRender(PHPRenderInterface $render)
    {
        $this->render = $render;
    }

    public function get(string $path, $fn)
    {
        $this->router->get($path, $fn);
    }

    public function post(string $path, $fn)
    {
        $this->router->post($path, $fn);
    }

    public function run()
    {
        $route = $this->router->run();
        $resolver = new Resolver;

        $data = $resolver->method($route['callback'], ['params' => $route['params']]);

        $this->render->setData($data);
        $this->render->run();
    }
}
