<?php

namespace Bridge\Doctrine;

use Doctrine\ORM\EntityManager as EM;
use Doctrine\ORM\Tools\Setup;
use Slim\Slim;

class EntityManager
{

    private static $em;
    private $app;

    public function __construct(Slim $app)
    {
        $this->app = $app;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        if (null !== self::$em) {
            return self::$em;
        }
        $path = array(ROOT . '/src/App/Entity');

        $config = Setup::createAnnotationMetadataConfiguration($path, true);

        $connectionOptions = array(
            'driver'   => $this->app->config['database']['driver'],
            'host'     => $this->app->config['database']['host'],
            'dbname'   => $this->app->config['database']['dbname'],
            'user'     => $this->app->config['database']['user'],
            'password' => $this->app->config['database']['password']
        );
        self::$em = EM::create($connectionOptions, $config); 
        return self::$em;
    }

}