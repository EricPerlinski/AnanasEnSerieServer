<?php

use Bridge\Doctrine\EntityManager as EM;

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


	//envoie du resultat
	echo "{id:123456}";
	$app->response->setStatus(200);
})->name('add');



$app->get('/client/view/:id', function ($id) use($app,$twig){
	echo $twig->render('view.php',array('nom'=>"TODO"));
	$app->response->setStatus(200);
})->name('view')->conditions(['id' => '[0-9]+']);

$app->run();

//mini manuel d utilisation d entity manager
// pour creer l'em
// $em = new EM($app)->getEntityManager();
// pour recuperer un repository avec des fonctions toutes faites
// $em->getRepository('Machin')->findBy(array('email' => $email, 'pw' => $pswd));
// pour recuperer par ID
// $em->getRepository('Machin')->findById(4);
// pour recuperer tout
// $em->getRepository('Machin')->findAll();
// pour enregistrer
// $em->persist($machin)
// $em->flush();
//de memoire machin a son id qui a ete mis a jour apres le flush, mais pas sur
//dans tous les cas il y a moyen de le recuperer