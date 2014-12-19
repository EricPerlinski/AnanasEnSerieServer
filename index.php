<?php

use Bridge\Doctrine\EntityManager as EM;

use App\Entity\QRCode as QRCode;
use App\Entity\Like as Like;
use App\Entity\Redirect as Redirect;
use App\Entity\YesNo as YesNo;
use App\Entity\Survey as Survey;

use App\Entity\Item as Item;

use App\Entity\CheckboxQuestion as CheckboxQuestion;
use App\Entity\OpenQuestion as OpenQuestion;
use App\Entity\RadioButtonQuestion as RadioButtonQuestion;

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

$app->add(new \Slim\Middleware\SessionCookie(array()));

$em = new EM($app);
$em  = $em->getEntityManager();




/*****************/
/****** WEB ******/
/*****************/

$app->get('/', function () use($app,$twig){
	echo $twig->render('index.php', array('flash' => isset($_SESSION['slim.flash']) ? $_SESSION['slim.flash'] : null ));
})->name('home');



$app->get('/like/:path', function ($path) use($app,$twig,$em){

	$vote = $app->getCookie("$path");
	if($vote){
		echo "Vous avez déjà voté";
		$app->response->setStatus(200);
	}else{

		$qr = $em->getRepository("App\Entity\QRCode")->findOneBy(array('path' => $path));
		if($qr==null){
			$app->notFound();
		}
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
	$qr = $em->getRepository("App\Entity\QRCode")->findOneBy(array('path' => $path));
	if($qr==null){
		$app->notFound();
	}

	if(!$vote){
		$qr->increment();
	}

	$em->persist($qr);
	$cl = new ClickLog();
	$em->persist($cl);
	$qr->addClickLog($cl);
	$em->flush();

	$app->setCookie("$path",true);

	$app->redirect($qr->getUrl());
	$app->response->setStatus(200);
	
})->name('redirect')->conditions(['path' => '[0-9a-zA-Z]+']);



$app->get('/yes/:path', function ($path) use($app,$twig,$em){
	$vote = $app->getCookie("$path");
	if($vote){
		echo "Vous avez déjà voté";
		$app->response->setStatus(200);
	}else{

		$qr = $em->getRepository("App\Entity\QRCode")->findOneBy(array('path' => $path));
		if($qr==null){
			$app->notFound();
		}
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

		echo $twig->render('yes.php',array('name' => $title , 'counter' => $counter));
		$app->response->setStatus(200);
	}
})->name('yes')->conditions(['path' => '[0-9a-zA-Z]+']);

$app->get('/no/:path', function ($path) use($app,$twig,$em){
	$vote = $app->getCookie("$path");
	if($vote){
		echo "Vous avez déjà voté";
		$app->response->setStatus(200);
	}else{

		$qr = $em->getRepository("App\Entity\QRCode")->findOneBy(array('path' => $path));
		if($qr==null){
			$app->notFound();
		}
		$qr->increment();
		$qr->incrementNo();
		$cl = new ClickLog();
		$em->persist($cl);
		$qr->addClickLogNo($cl);
		$em->persist($qr);
		$em->flush();

		$app->setCookie("$path",true);

		//Render
		$title = $qr->getTitle();
		$counter = $qr->getCounter();

		echo $twig->render('no.php',array('name' => $title , 'counter' => $counter));
		$app->response->setStatus(200);
	}
})->name('no')->conditions(['path' => '[0-9a-zA-Z]+']);

$app->get('/survey/:path', function ($path) use($app,$twig,$em){
	$vote = $app->getCookie("$path");
	$vote=false;
	if($vote){
		echo "Vous avez déjà voté";
		$app->response->setStatus(200);
	}else{

		$qr = $em->getRepository("App\Entity\QRCode")->findOneBy(array('path' => $path));
		if($qr==null){
			$app->notFound();
		}
		$qr->increment();
		$cl = new ClickLog();
		$em->persist($cl);
		$em->persist($qr);
		$em->flush();

		$app->setCookie("$path",true);

		//Render
		$title = $qr->getTitle();
		$counter = $qr->getCounter();


		echo $twig->render('survey.php',array('name' => $title , 'survey' => $qr));
		$app->response->setStatus(200);
	}
})->name('survey')->conditions(['path' => '[0-9a-zA-Z]+']);

$app->get('/admin/get/like/:pathAdmin', function ($pathAdmin) use($app,$twig,$em){

	$qr = $em->getRepository("App\Entity\QRCode")->findOneBy(array('pathAdmin' => $pathAdmin));
	if($qr==null){
		$app->notFound();
	}
	//RENDER
	$title = $qr->getTitle();
	$counter = $qr->getCounter();
	$getLog = $app->urlFor('getDailyStats', array('pathAdmin' => $pathAdmin));
	$getDailyLog = $app->urlFor('getHourlyStats', array('pathAdmin' => $pathAdmin));
	$getDailyLog = substr($getDailyLog, 0, $getDailyLog - 5);
	echo $twig->render('adminLike.php',array(
		'name'=> $title,
		'counter' => $counter,
		'getLog' => $getLog,
		'getDailyLog' => $getDailyLog
		));
	$app->response->setStatus(200);

})->name('adminLike')->conditions(['pathAdmin' => '[0-9a-zA-Z]+']);


$app->get('/admin/get/redirect/:pathAdmin', function ($pathAdmin) use($app,$twig,$em){

	$qr = $em->getRepository("App\Entity\QRCode")->findOneBy(array('pathAdmin' => $pathAdmin));
	if($qr==null){
		$app->notFound();
	}
	//RENDER
	$title = $qr->getTitle();
	$counter = $qr->getCounter();
	$url = $qr->getUrl();
	$getLog = $app->urlFor('getDailyStats', array('pathAdmin' => $pathAdmin));
	$getDailyLog = $app->urlFor('getHourlyStats', array('pathAdmin' => $pathAdmin));
	$getDailyLog = substr($getDailyLog, 0, $getDailyLog - 5);
	echo $twig->render('adminRedirect.php',array(
		'name'=> $title, 'counter' => $counter, 'url' => $url ,
		'target' => $app->urlFor('adminRedirectPOST', array('pathAdmin' => $pathAdmin)), 
		'flash' => isset($_SESSION['slim.flash']) ? $_SESSION['slim.flash'] : null,
		'getLog' => $getLog,
		'getDailyLog' => $getDailyLog
		));
	$app->response->setStatus(200);

})->name('adminRedirect')->conditions(['pathAdmin' => '[0-9a-zA-Z]+']);

$app->post('/admin/get/redirect/:pathAdmin', function ($pathAdmin) use($app,$twig,$em){

	$qr = $em->getRepository("App\Entity\QRCode")->findOneBy(array('pathAdmin' => $pathAdmin));
	if($qr==null){
		$app->notFound();
	}

	if($app->request->post('url')){
		$qr->setUrl($app->request->post('url'));
		$em->persist($qr);
		$em->flush();
		$app->flash('success', "Url redirigée avec succès.");
		$app->redirect($app->urlFor('adminRedirect', array('pathAdmin' => $pathAdmin)));
	} else {
		$app->flash('danger', "Le formulaire n'est pas correct.");
		$app->redirect($app->urlFor('adminRedirect', array('pathAdmin' => $pathAdmin)));
	}

})->name('adminRedirectPOST')->conditions(['pathAdmin' => '[0-9a-zA-Z]+']);


$app->get('/admin/get/yes/:pathAdmin', function ($pathAdmin) use($app,$twig,$em){

	$qr = $em->getRepository("App\Entity\QRCode")->findOneBy(array('pathAdmin' => $pathAdmin));
	if($qr==null){
		$app->notFound();
	}
	//RENDER
	$title = $qr->getTitle();
	$counter = $qr->getCounter();
	$counterNo = $qr->getCounterNo();
	$getLog = $app->urlFor('getDailyStats', array('pathAdmin' => $pathAdmin));
	$getDailyLog = $app->urlFor('getHourlyStats', array('pathAdmin' => $pathAdmin));
	$getDailyLog = substr($getDailyLog, 0, $getDailyLog - 5);
	echo $twig->render('adminYesNo.php',array(
		'name'=> $title,
		'counter' => $counter,
		'counterNo' => $counterNo,
		'getLog' => $getLog,
		'getDailyLog' => $getDailyLog,
		'isYesNo' => true
		));	
	$app->response->setStatus(200);

})->name('adminYes')->conditions(['pathAdmin' => '[0-9a-zA-Z]+']);

$app->get('/admin/get/survey/:pathAdmin', function ($pathAdmin) use($app,$twig,$em){

	echo "TODO";
	$app->response->setStatus(200);

})->name('adminSurvey')->conditions(['pathAdmin' => '[0-9a-zA-Z]+']);


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

})->name('addRedirect');

$app->post('/api/admin/add/yesno', function () use($app,$twig,$em){
    //traitement des params POST

	$json;
	if(isset($_POST['objet'])){
		$json = $_POST['objet'];
	}else{ 
		$app->notFound();
	}

	$obj = json_decode($json,true);
	$qr = new YesNo();
	$qr->setCounter(0);
	$qr->setCounterNo(0);
	$qr->setTitle($obj['title']);
	$qr->setQuestion($obj['question']);
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
	$yespath=$qr->getPath();
	$nopath=$qr->getNoPath();
	$pathAdmin=$qr->getPathAdmin();
	echo "[{\"path\":\"$yespath\",\"nopath\":\"$nopath\",\"pathAdmin\":\"$pathAdmin\"}]";
	$app->response->setStatus(200);

})->name('addYesno');


$app->post('/api/admin/add/survey', function () use($app,$twig,$em){
    //traitement des params POST

	$json;
	if(isset($_POST['objet'])){
		$json = $_POST['objet'];
	}else{ 
		$app->notFound();
	}

	$obj = json_decode($json,true);
	$qr = new Survey();
	
	$qr->setTitle($obj['title']);

	$questions = $obj['questions'];
	foreach ($questions as $key => $question) {
		$type = $question['type'];
		$q=null;
		if($type=="OpenQuestion"){
			$q = new OpenQuestion();
			$q->setQuestion($question['object']['question']);
			
		}else if($type=="RadioButtonQuestion"){
			$q = new RadioButtonQuestion();
			foreach ($question['object']['items'] as $key => $item) {
				$i = new Item();
				$i->setText($item);
				$q->addItem($i);
				$em->persist($i);
			}
		}else if($type=="CheckBoxQuestion"){
			$q = new CheckboxQuestion();
			foreach ($question['object']['items'] as $key => $item) {
				$i = new Item();
				$i->setText($item);
				$q->addItem($i);
				$em->persist($i);
			}
		}
		$text = $question['object']['name'];
		$q->setText($text);
		$em->persist($q);

		$qr->addQuestion($q);
	}



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

})->name('addSurvey');


$app->get('/api/admin/get/:pathAdmin', function ($pathAdmin) use($app,$twig,$em){

	$qr = $em->getRepository("App\Entity\QRCode")->findOneBy(array('pathAdmin' => $pathAdmin));
	if($qr==null){
		$app->notFound();
	}

	//JSON Encode
	$qrJson = json_encode($qr);
	echo "[$qrJson]";
	$app->response->setStatus(200);

})->name('viewAdmin')->conditions(['pathAdmin' => '[0-9a-zA-Z]+']);

$app->get('/api/admin/getdailystats/:pathAdmin', function ($pathAdmin) use($app,$twig,$em){

	$qr = $em->getRepository("App\Entity\QRCode")->findOneBy(array('pathAdmin' => $pathAdmin));
	if($qr==null){
		$app->notFound();
	}

	$clickLogs = array();
	$noClickLogs = array();

	$date = new \DateTime();
	$date = $date->sub(DateInterval::createFromDateString('7 days'));
	for($i= 0; $i < 7; $i ++){
		$date = $date->add(DateInterval::createFromDateString('1 days'));
		$clickLogs[] = array('time' => $date->format('Y-m-d'), 'y' => 0);
		$noClickLogs[] = array('time' => $date->format('Y-m-d'), 'y' => 0);
	}

	foreach ($qr->getClickLog() as $clickLog) {
		$index = 7 - 1 - $clickLog->getDate()->diff($date)->days;
		if($days >= 0){
			$clickLogs[7 - 1 - $clickLog->getDate()->diff($date)->days]['y'] ++;
		}
	}

	if($qr instanceof YesNo){
		foreach ($qr->getClickLogNo() as $clickLog) {
			$index = 7 - 1 - $clickLog->getDate()->diff($date)->days;
			if($days >= 0){
				$noClickLogs[7 - 1 - $clickLog->getDate()->diff($date)->days]['y'] ++;
			}
		}
	}

	$clickLogs = json_encode($clickLogs);
	$noClickLogs = json_encode($noClickLogs);

	if($qr instanceof YesNo){
		echo "[$clickLogs,$noClickLogs]";
	} else{
		echo "[$clickLogs]";
	}
	
	$app->response->setStatus(200);

})->name('getDailyStats')->conditions(['pathAdmin' => '[0-9a-zA-Z]+']);

$app->get('/api/admin/gethourlystats/:pathAdmin/:days', function ($pathAdmin, $days) use($app,$twig,$em){

	$qr = $em->getRepository("App\Entity\QRCode")->findOneBy(array('pathAdmin' => $pathAdmin));
	if($qr==null){
		$app->notFound();
	}

	$clickLogs = array();
	$noClickLogs = array();

	$compareTo = new \DateTime();
	$compareTo = $compareTo->sub(DateInterval::createFromDateString("$days days"));
	$compareTo = $compareTo->format('Y-m-d');

	for($i= 0; $i < 24; $i ++){
		$clickLogs[] = array('time' => "$i", 'y' => 0);
		$noClickLogs[] = array('time' => "$i", 'y' => 0);
	}


	foreach ($qr->getClickLog() as $clickLog) {
		if($compareTo == $clickLog->getDate()->format('Y-m-d')){
			$clickLogs[intval($clickLog->getDate()->format('H'))]['y'] ++;
		}
	}

	if($qr instanceof YesNo){
		foreach ($qr->getClickLogNo() as $clickLog) {
			if($compareTo == $clickLog->getDate()->format('Y-m-d')){
				$noClickLogs[intval($clickLog->getDate()->format('H'))]['y'] ++;
			}
		}
	}

	$clickLogs = json_encode($clickLogs);
	$noClickLogs = json_encode($noClickLogs);

	if($qr instanceof YesNo){
		echo "[$clickLogs,$noClickLogs]";
	} else{
		echo "[$clickLogs]";
	}	

	$app->response->setStatus(200);

})->name('getHourlyStats')->conditions(['pathAdmin' => '[0-9a-zA-Z]+', 'date' => '[0-9]+']);

$app->run();