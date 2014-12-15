<?php
use Doctrine\ORM\Tools\Setup;

require 'vendor/autoload.php';

$path = array('src/App/Entity');
$devMode = true;

$config = Setup::createAnnotationMetadataConfiguration($path, $devMode);

$connectionOptions = array(
	'driver'   => 'pdo_mysql',
	//'host'     => 'https://webpanel.telecomnancy.univ-lorraine.fr/alternc-sql/',
	'host'     => 'localhost',
	'dbname'   => 'codingweek_prj11',
	//'user'     => 'codingweek_prj11',
	'user'     => 'root',
	//'password' => 'i1FpwTi0a'
	'password' => ''
);

$em = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);

$helpers = new Symfony\Component\Console\Helper\HelperSet(array(
	'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
	'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
	));