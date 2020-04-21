<?php

require __DIR__ . '/vendor/autoload.php';

$router = new \App\Project\Router\Router();

$router->get('/hello', function (){
    return 'php small framework';
});