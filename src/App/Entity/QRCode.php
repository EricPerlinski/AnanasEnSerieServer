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

    public function __construct(){
        $this->counter = 0;
        $this->creationDate = new \DateTime();
    }

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

    /**
     * @var string
     *
     * @Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var \DateTime
     *
     * @Column(name="creationDate", type="datetimetz")
     */
    protected $creationDate;

     /**
     * @var string
     *
     * @Column(name="path", type="string", length=255)
     */
    protected $path;

     /**
     * @var string
     *
     * @Column(name="pathAdmin", type="string", length=255)
     */
    protected $pathAdmin;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set counter
     *
     * @param integer $counter
     * @return QRCode
     */
    public function setCounter($counter)
    {
        $this->counter = $counter;

        return $this;
    }

    /**
     * Get counter
     *
     * @return integer 
     */
    public function getCounter()
    {
        return $this->counter;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return QRCode
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set creationDate
     *
     * @param \datetimez $creationDate
     * @return QRCode
     */
    public function setCreationDate(\datetimez $creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \datetimez 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return QRCode
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set pathAdmin
     *
     * @param string $pathAdmin
     * @return QRCode
     */
    public function setPathAdmin($pathAdmin)
    {
        $this->pathAdmin = $pathAdmin;

        return $this;
    }

    /**
     * Get pathAdmin
     *
     * @return string 
     */
    public function getPathAdmin()
    {
        return $this->pathAdmin;
    }


    /**
    * Increment counter
    *
    */
    public function increment()
    {
        $this->counter++;
    }
}
