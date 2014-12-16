<?php

use Bridge\Doctrine\EntityManager as EM;

use App\Entity\QRCode as QRCode;

require 'vendor/autoload.php';

require 'vendor/slim/slim/Slim/Slim.php';

define('ROOT', __DIR__);


\Slim\Slim::registerAutoloader();

$loader = new Twig_Loader_Filesystem('src/App/view');
Twig_Autoloader::register();
$twig = new Twig_Environment($loader, array());

$app = new \Slim\Slim(array(
	'view' => new \Slim\Views\Twig()
	));
$app->config = require(__DIR__ . '/app/config/config.php');

$em = new EM($app);
$em  = $em->getEntityManager();


$app->get('/', function () use($app,$twig){
	echo $twig->render('index.php');
})->name('home');




$app->post('/api/admin/add', function () use($app,$twig,$em){
    //traitement des params POST
	$titre;
	if(isset($_POST['titre'])){
		$titre = $_POST['titre'];
	}else{
		$app->notFound();
	}

	$qr = new QRCode();
	$qr->setTitle($titre);
	$qr->setPath(rand(1,1000));
	$qr->setPathAdmin(rand(1,1000));
	
	$em->persist($qr);
	$em->flush();

	
	//RENDER
	$id=$qr->getId();
	$path=$qr->getPath();
	$pathAdmin=$qr->getPathAdmin();
	echo "[{\"path\":\"$path\",\"pathAdmin\":\"$pathAdmin\"}]";
	$app->response->setStatus(200);

})->name('add');




$app->get('api/admin/get/:pathAdmin', function ($pathAdmin) use($app,$twig,$em){

	$qr = $em->getRepository("App\Entity\QRCode")->findBy(array('pathAdmin' => $pathAdmin));

	//RENDER
	echo $twig->render('resultat.php',array('nom'=> $qr->getTitle(), 'nb' => $qr->getCounter() ));	
	$app->response->setStatus(200);

})->name('viewAdmin')->conditions(['pathAdmin' => '[0-9a-zA-Z]+']);




$app->get('/api/get/:path', function ($path) use($app,$twig,$em){

	$qr = $em->getRepository("App\Entity\QRCode")->findBy(array('path' => $path));
	if(count($qr)==0){
		$app->notFound();
	}
	$qr = $qr[0];
	$qr->increment();
	$em->persist($qr);
	$em->flush();

	//Render
	$titre = $qr->getTitle();
	

	echo $twig->render('vote.php',array('nom' => $titre));
	$app->response->setStatus(200);

})->name('view')->conditions(['path' => '[0-9a-zA-Z]+']);

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