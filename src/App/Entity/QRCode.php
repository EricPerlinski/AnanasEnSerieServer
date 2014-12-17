<?php

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="qrcode")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"redirect" = "Redirect", "yesno" = "YesNo", "like" = "Like", "survey" = "Survey"})
 */
abstract class QRCode implements \JsonSerializable
{


    protected $prefix;


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
    private $id;

    /**
     * @var integer
     *
     * @Column(name="counter", type="integer")
     */
    private $counter;

    /**
     * @var string
     *
     * @Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @Column(name="creationDate", type="datetimetz")
     */
    private $creationDate;

     /**
     * @var string
     *
     * @Column(name="path", type="string", length=255)
     */
    private $path;

     /**
     * @var string
     *
     * @Column(name="pathAdmin", type="string", length=255)
     */
    private $pathAdmin;

    /**
     * @ManyToMany(targetEntity="ClickLog")
     * @JoinTable(name="qrcode_clicklogs",
     *      joinColumns={@JoinColumn(name="qrcode_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@JoinColumn(name="clicklog_id", referencedColumnName="id", unique=true)}
     *      )
     **/
    private $clickLog;

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
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
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

    public function jsonSerialize() {
        return array(   'path'      =>  $this->path,
                        'pathAdmin' =>  $this->pathAdmin,
                        'title'     =>  $this->title,
                        'counter'   =>  $this->counter);
    }

<<<<<<< HEAD
    /**
     * Add clickLog
     *
     * @param \App\Entity\ClickLog $clickLog
     * @return QRCode
     */
    public function addClickLog(\App\Entity\ClickLog $clickLog)
    {
        $this->clickLog[] = $clickLog;
=======



     /**
     * Set path
     *
     * @param string $path
     * @return Like
     */
    public function setPath($path)
    {
        $this->path = $this->prefix . $path;
>>>>>>> df34ec60a4b0cfb427fc2b1c465a85f76114367f

        return $this;
    }

    /**
<<<<<<< HEAD
     * Remove clickLog
     *
     * @param \App\Entity\ClickLog $clickLog
     */
    public function removeClickLog(\App\Entity\ClickLog $clickLog)
    {
        $this->clickLog->removeElement($clickLog);
    }

    /**
     * Get clickLog
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClickLog()
    {
        return $this->clickLog;
=======
     * Set pathAdmin
     *
     * @param string $pathAdmin
     * @return Like
     */
    public function setPathAdmin($pathAdmin)
    {
        $this->pathAdmin = $this->prefix . $pathAdmin;

        return $this;
>>>>>>> df34ec60a4b0cfb427fc2b1c465a85f76114367f
    }
}
