<?php

require 'vendor/slim/slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();


$app = new \Slim\Slim();

$app->get('/', function () {
    echo "Ananas en serie";
});

$app->run();

