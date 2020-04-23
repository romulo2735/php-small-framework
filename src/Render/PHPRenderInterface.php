<?php


namespace App\Project\Render;

interface PHPRenderInterface
{
    public function setData($data);

    public function run();
}
