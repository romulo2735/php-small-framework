<?php

namespace App\Project\Router;

class Router
{
    private $collection;
    private $path, $method;

    /**
     * Router constructor.
     */
    public function __construct(string $path, string $method)
    {
        $this->collection = new RouterCollection();
        $this->path = $path;
        $this->method = $method;
    }

    public function get($path, $fn)
    {
        $this->request('GET', $path, $fn);
    }

    public function post($path, $fn)
    {
        $this->request('POST', $path, $fn);
    }

    public function request($method, $path, $fn)
    {
        $this->collection->add($method, $path, $fn);
    }

    /**
     * Verifica se a url tem parametros
     */
    private function checkUrl(string $toFind, $subject)
    {
        preg_match_all('/\{([^\}]*)/', $toFind, $variables);

        $regex = str_replace('/', '\/', $toFind);

        foreach ($variables[1] as $key => $variable ) {
            $as = explode(':', $variable);
            $replament = $as[1] ?? '([a-zA-Z0-9\-\_\ ]+)';
            $regex = str_replace($variables[$key], $replament, $regex);
        }

        $regex = preg_replace('/{([a-zA-Z]+)}/', '([a-zA-Z0-9+])', $regex);
        $result = preg_match('/^'. $regex.'$/', $subject, $params);

        return compact('result', 'params');
    }

    public function run()
    {
        $data = $this->collection->filter($this->method);

        foreach ($data as $key => $value) {
            $result = $this->checkUrl($key, $this->path);
            $callback = $value;
            if ($result['result']){
                break;
            }
        }

        if (!$result['result']){
            $callback = null;
        }

        return [
            'params' => $result['params'],
            'callback' => $callback
        ];
    }
}
