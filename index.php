<?php

use Bridge\Doctrine\EntityManager as EM;

use App\Entity\QRCode as QRCode;
use App\Entity\Like as Like;
use App\Entity\Redirect as Redirect;
use App\Entity\ClickLog as ClickLog;

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




/*****************/
/****** WEB ******/
/*****************/

$app->get('/', function () use($app,$twig){
	echo $twig->render('index.php');
})->name('home');



$app->get('/like/:path', function ($path) use($app,$twig,$em){

	$vote = $app->getCookie("$path");
	if($vote){
		echo "Vous avez déjà voté";
		$app->response->setStatus(200);
	}else{

		$qr = $em->getRepository("App\Entity\QRCode")->findBy(array('path' => $path));
		if(count($qr)!=1){
			$app->notFound();
		}
		$qr = $qr[0];
		$qr->increment();
		$cl = new ClickLog();
		$em->persist($cl);
		$qr->addClickLog($cl);
		$em->persist($qr);
		$em->flush();

		$app->setCookie("$path",true);

		//Render
		$title = $qr->getTitle();
		$counter = $qr->getCounter();

		echo $twig->render('like.php',array('name' => $title , 'counter' => $counter));
		$app->response->setStatus(200);
	}

})->name('like')->conditions(['path' => '[0-9a-zA-Z]+']);

$app->get('/redirect/:path', function ($path) use($app,$twig,$em){

	$vote = $app->getCookie("$path");
	$qr = $em->getRepository("App\Entity\QRCode")->findBy(array('path' => $path));
	if(count($qr)!=1){
		$app->notFound();
	}
	$qr = $qr[0];

	if($vote){
		$qr->increment();
	}

	$em->persist($qr);
	$em->flush();

	$app->setCookie("$path",true);

	$app->redirect($qr->getUrl());
	$app->response->setStatus(200);
	
})->name('redirect')->conditions(['path' => '[0-9a-zA-Z]+']);




$app->get('/admin/get/like/:pathAdmin', function ($pathAdmin) use($app,$twig,$em){

	$qr = $em->getRepository("App\Entity\QRCode")->findBy(array('pathAdmin' => $pathAdmin));
	if(count($qr)!=1){
		$app->notFound();
	}
	$qr = $qr[0];
	//RENDER
	$title = $qr->getTitle();
	$counter = $qr->getCounter();
	echo $twig->render('resultat.php',array('name'=> $title, 'counter' => $counter ));	
	$app->response->setStatus(200);

})->name('adminLike')->conditions(['pathAdmin' => '[0-9a-zA-Z]+']);


$app->get('/admin/get/redirect/:pathAdmin', function ($pathAdmin) use($app,$twig,$em){

	$qr = $em->getRepository("App\Entity\QRCode")->findBy(array('pathAdmin' => $pathAdmin));
	if(count($qr)!=1){
		$app->notFound();
	}
	$qr = $qr[0];
	//RENDER
	$title = $qr->getTitle();
	$counter = $qr->getCounter();
	echo $twig->render('redirect.php',array('name'=> $title, 'counter' => $counter ));	
	$app->response->setStatus(200);

})->name('adminRedirect')->conditions(['pathAdmin' => '[0-9a-zA-Z]+']);


/*****************/
/****** API ******/
/*****************/

$app->get('/api/test', function(){
	echo "ananas";
})->name('test');


$app->post('/api/admin/add/like', function () use($app,$twig,$em){
    //traitement des params POST

	$json;
	if(isset($_POST['objet'])){
		$json = $_POST['objet'];
	}else{ 
		$app->notFound();
	}

	$obj = json_decode($json,true);
	$qr = new Like();
	$qr->setTitle($obj['title']);
	$qr->setPath(rand(1,1000));
	$qr->setPathAdmin(rand(1,1000));
	$em->persist($qr);
	$em->flush();

	$qr->setPath(hash('crc32b', $qr->getCreationDate()->format('Y-m-d H:i:s') . $qr->getId()) . $qr->getId());
	$qr->setPathAdmin(hash('crc32b', $qr->getCreationDate()->format('Y-m-d H:i:s') . 'admin' . $qr->getId()) . $qr->getId());
	$em->persist($qr);
	$em->flush();

	
	//RENDER
	$id=$qr->getId();
	$path=$qr->getPath();
	$pathAdmin=$qr->getPathAdmin();
	echo "[{\"path\":\"$path\",\"pathAdmin\":\"$pathAdmin\"}]";
	$app->response->setStatus(200);

})->name('addLike');


$app->post('/api/admin/add/redirect', function () use($app,$twig,$em){
    //traitement des params POST

	$json;
	if(isset($_POST['objet'])){
		$json = $_POST['objet'];
	}else{ 
		$app->notFound();
	}

	$obj = json_decode($json,true);
	$qr = new Redirect();
	$qr->setTitle($obj['title']);
	$qr->setUrl($obj['url']);
	$qr->setPath(rand(1,1000));
	$qr->setPathAdmin(rand(1,1000));
	$em->persist($qr);
	$em->flush();

	$qr->setPath(hash('crc32b', $qr->getCreationDate()->format('Y-m-d H:i:s') . $qr->getId()) . $qr->getId());
	$qr->setPathAdmin(hash('crc32b', $qr->getCreationDate()->format('Y-m-d H:i:s') . 'admin' . $qr->getId()) . $qr->getId());
	$em->persist($qr);
	$em->flush();

	
	//RENDER
	$id=$qr->getId();
	$path=$qr->getPath();
	$pathAdmin=$qr->getPathAdmin();
	echo "[{\"path\":\"$path\",\"pathAdmin\":\"$pathAdmin\"}]";
	$app->response->setStatus(200);

})->name('addLike');

$app->get('/api/admin/get/:pathAdmin', function ($pathAdmin) use($app,$twig,$em){

	$qr = $em->getRepository("App\Entity\QRCode")->findBy(array('pathAdmin' => $pathAdmin));
	if(count($qr)!=1){
		$app->notFound();
	}
	$qr=$qr[0];

	//JSON Encode
	$qrJson = json_encode($qr);
	echo "[$qrJson]";
	$app->response->setStatus(200);

})->name('viewAdmin')->conditions(['pathAdmin' => '[0-9a-zA-Z]+']);




$app->run();