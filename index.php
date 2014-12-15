<?php

require 'vendor/autoload.php';

require 'vendor/slim/slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();




$app = new \Slim\Slim(array(
	'view' => new \Slim\Views\Twig()
	));

$app->get('/', function () {
    echo "Ananas en serie";
});

$app->run();

