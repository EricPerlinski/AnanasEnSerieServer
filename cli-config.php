<?php
define('ROOT', __DIR__);

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $app = new Slim\Slim(array(
        'debug'         => true
    ));

    $app->config = require(__DIR__ . '/app/config/config.php');


    $em = new Bridge\Doctrine\EntityManager($app);
    $em  = $em->getEntityManager();

    return ConsoleRunner::createHelperSet($em);

} catch (Exception $e) {
    print_r($e->getMessage());
}