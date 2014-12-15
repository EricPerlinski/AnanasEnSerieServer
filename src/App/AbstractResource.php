<?php

namespace App;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

abstract class AbstractResource
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager = null;

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        if ($this->entityManager === null) {
            $this->entityManager = $this->createEntityManager();
        }

        return $this->entityManager;
    }

    /**
     * @return EntityManager
     */
    public function createEntityManager()
    {
        $path = array('Path/To/Entity');
        $devMode = true;

        $config = Setup::createAnnotationMetadataConfiguration($path, $devMode);

        $connectionOptions = array(
            'driver'   => 'pdo_mysql',
            'host'     => 'https://webpanel.telecomnancy.univ-lorraine.fr/alternc-sql/',
            'dbname'   => 'codingweek_prj11',
            'user'     => 'codingweek_prj11',
            'password' => 'i1FpwTi0a',
            );

        return EntityManager::create($connectionOptions, $config);
    }
}