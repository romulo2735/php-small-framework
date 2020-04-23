<?php


namespace App\Project\Render;


class PHPRender implements PHPRenderInterface
{
    private $data;

    public function setData($data)
    {
        $this->data = $data;
    }

    public function run()
    {
        if (is_string($this->data)){
            header('Content-type:text/html; charset=UTF-8');

            echo $this->data;
            exit;
        } elseif (is_array($this->data)){
            header('Content-type: application/json');

            echo $this->data;
            exit;
        }

        throw new \Exception("Route return is invalid");
    }
}