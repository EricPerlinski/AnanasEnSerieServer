<?php

require 'vendor/autoload.php';

require 'vendor/slim/slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();


$loader = new Twig_Loader_Filesystem('view');
Twig_Autoloader::register();
$twig = new Twig_Environment($loader, array());

$app = new \Slim\Slim(array(
	'view' => new \Slim\Views\Twig()
	));

$app->get('/', function () use($twig){
    echo $twig->render('index.php');
})->name('home');

$app->run();

