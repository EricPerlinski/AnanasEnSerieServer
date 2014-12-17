<?php

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="clicklog")
 */
class ClickLog implements \JsonSerializable
{

    public function __construct(){
        $this->date = new \DateTime();
    }

    /**
     * @var integer
     *
     * @Id
     * @Column(name="id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @Column(name="date", type="datetimetz")
     */
    private $date;

    public function jsonSerialize() {
        return array();
    }
}
