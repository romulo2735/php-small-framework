<?php

require __DIR__ . '/vendor/autoload.php';

$app = new \App\Project\App();
$app->setRender(new \App\Project\Render\PHPRender());

require __DIR__.'/routes.php';

$app->run();