<?php

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="redirect")
 */
class Redirect extends QRCode
{
    const prefix = "redirect";

    /**
     * @var string
     *
     * @Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * Set path
     *
     * @param string $path
     * @return Redirect
     */
    public function setPath($path)
    {
        parent::setPath($path);
        $this->path = self::prefix  . '/' .  $this->path;

        return $this;
    }

    /**
     * Set pathAdmin
     *
     * @param string $pathAdmin
     * @return Redirect
     */
    public function setPathAdmin($pathAdmin)
    {
        parent::setPathAdmin($path);
        $this->path = self::prefix . $this->pathAdmin;

        return $this;
    }


    /**
     * Set url
     *
     * @param string $url
     * @return Redirect
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }
}
