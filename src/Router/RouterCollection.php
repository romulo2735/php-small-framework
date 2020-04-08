<?php


namespace App\Project\Router;


class RouterCollection
{
    protected $collection = [];

    public function add(string $method, string $path, $callback)
    {
        if (!isset($this->collection[$method])) {

        }
    }
}