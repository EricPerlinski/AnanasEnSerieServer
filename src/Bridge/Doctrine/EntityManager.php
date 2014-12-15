<?php

namespace Bridge\Doctrine;

use Doctrine\ORM\EntityManager as EM;
use Doctrine\ORM\Tools\Setup;
use Slim\Slim;

class EntityManager
{

    private $em;
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
        if (null !== $this->em) {
            return $this->em;
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

        return EM::create($connectionOptions, $config);
    }

    public function getRepository($repository)
    {
        if (null === $this->em) {
            $this->em = $this->createEntityManager();
        }
        return $this->em->getRepository(sprintf('App\\Entity\\' . $repository));
    }
}