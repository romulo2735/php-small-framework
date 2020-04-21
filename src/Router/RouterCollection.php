<?php


namespace App\Project\Router;

use Illuminate\Support\Collection;

class RouterCollection
{
    protected $collection = [];

    /**
     * @param string $method
     * @param string $path
     * @param $callback
     */
    public function add(string $method, string $path, $callback)
    {
        if (!isset($this->collection[$method])) {
            $this->collection[$method] = new Collection();
        }

        $this->collection[$method]->put($path, $callback);
    }

    /**
     * @param $method
     * @return mixed
     */
    public function filter($method)
    {
        if (!isset($this->collection[$method])) {
            $this->collection[$method] = new Collection();
        }
        return $this->collection[$method];
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->collection;
    }
}
