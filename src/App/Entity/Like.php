<?php

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="like")
 */
class Like extends QRCode
{

    protected $prefix = "like";

}
