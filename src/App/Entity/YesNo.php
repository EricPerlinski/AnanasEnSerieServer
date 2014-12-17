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
     * @var string
     *
     * @Column(name="nopath", type="string", length=255)
     */
    private $noPath;


    /**
     * Set noPath
     *
     * @param string $noPath
     * @return YesNo
     */
    private function setNoPath($noPath)
    {
        $this->noPath = $noPath;

        return $this;
    }

    /**
     * Get noPath
     *
     * @return string 
     */
    public function getNoPath()
    {
        return $this->noPrefix . "/" . $this->noPath;
    }
}
