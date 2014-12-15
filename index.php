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




$app->get('/', function () use($app,$twig){
    echo $twig->render('index.php');
})->name('home');


$app->post('/admin/add', function () use($app,$twig){
    //traitement des params POST
	if(isset($_POST['titre'])){
		$titre = $_POST['titre'];
    }else{
    	$app->notFound();
    }
	//envoie du resultat
    echo "{id:123456,titre:$titre}";
    $app->response->setStatus(200);
})->name('add');



$app->get('/client/view/:id', function ($id) use($app,$twig){
    echo $twig->render('view.php',array('nom'=>"TODO"));
    $app->response->setStatus(200);
})->name('view')->conditions(['id' => '[0-9]+']);

$app->run();

