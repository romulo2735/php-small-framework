<?php

$app->get('/hello', function ($params) {
    return 'php small framework';
});

$app->get('/nome/{name}', function ($params) {
    return "Recebendo parametros: {$params[1]}";
});