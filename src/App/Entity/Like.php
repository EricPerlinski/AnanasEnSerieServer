<?php

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="likable")
 */
class Like extends QRCode
{

    protected $prefix = "like";

     /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

}
