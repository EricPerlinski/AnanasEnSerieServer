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
    const prefix = "yes";
    const noPrefix = "no";

    /**
     * @var string
     *
     * @Column(name="nopath", type="string", length=255)
     */
    private $noPath;

    /**
     * Set path
     *
     * @param string $path
     * @return YesNo
     */
    public function setPath($path)
    {
        parent::setPath($path);
        $this->path = self::prefix . $this->path;
        $this->noPath = self::noPrefix . $this->path;

        return $this;
    }

    /**
     * Set pathAdmin
     *
     * @param string $pathAdmin
     * @return YesNo
     */
    public function setPathAdmin($pathAdmin)
    {
        parent::setPathAdmin($path);
        $this->path = self::prefix . $this->pathAdmin;

        return $this;
    }


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
        return $this->noPath;
    }
}
