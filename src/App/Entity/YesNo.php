<?php

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="yesno")
 */
class YesNo extends QRCode
{
    protected $prefix = "yes";
    protected $noPrefix = "no";

    /**
     * Get noPath
     *
     * @return string 
     */
    public function getNoPath()
    {
        return $this->noPrefix . "/" . $this->path;
    }
}
