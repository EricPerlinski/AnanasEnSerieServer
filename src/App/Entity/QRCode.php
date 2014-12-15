<?php

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="qrcode")
 */
class QRCode
{
    /**
     * @var integer
     *
     * @Id
     * @Column(name="id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @Column(name="counter", type="integer")
     */
    protected $counter;
    
}