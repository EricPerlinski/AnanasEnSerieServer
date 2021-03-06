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
     * @var integer
     *
     * @Column(name="counterno", type="integer")
     */
    private $counterNo;

    /**
     * @ManyToMany(targetEntity="ClickLog")
     * @JoinTable(name="no_clicklogs",
     *      joinColumns={@JoinColumn(name="yesno_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@JoinColumn(name="clicklog_id", referencedColumnName="id", unique=true)}
     *      )
     **/
    private $clickLogNo;

    /**
     * @var string
     *
     * @Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * Get noPath
     *
     * @return string 
     */
    public function getNoPath()
    {
        return $this->noPrefix . substr($this->getPath(), strlen($this->prefix));
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->clickLogNo = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set counterNo
     *
     * @param integer $counterNo
     * @return YesNo
     */
    public function setCounterNo($counterNo)
    {
        $this->counterNo = $counterNo;

        return $this;
    }

    /**
     * Get counterNo
     *
     * @return integer 
     */
    public function getCounterNo()
    {
        return $this->counterNo;
    }

    /**
     * Add clickLogNo
     *
     * @param \App\Entity\ClickLog $clickLogNo
     * @return YesNo
     */
    public function addClickLogNo(\App\Entity\ClickLog $clickLogNo)
    {
        $this->clickLogNo[] = $clickLogNo;

        return $this;
    }

    /**
     * Remove clickLogNo
     *
     * @param \App\Entity\ClickLog $clickLogNo
     */
    public function removeClickLogNo(\App\Entity\ClickLog $clickLogNo)
    {
        $this->clickLogNo->removeElement($clickLogNo);
    }

    /**
     * Get clickLogNo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClickLogNo()
    {
        return $this->clickLogNo;
    }

    /**
     * Set question
     *
     * @param string $question
     * @return YesNo
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
    * Increment counterNo
    *
    */
    public function incrementNo()
    {
        $this->counterNo++;
    }
}
