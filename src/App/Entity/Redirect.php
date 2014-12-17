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
    protected $prefix = "redirect";

    /**
     * @var string
     *
     * @Column(name="url", type="string", length=255)
     */
    private $url;

     /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
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
