<?php

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="radiobuttonanswer")
 */
class RadioButtonAnswer
{

    /**
     * @var integer
     *
     * @Id
     * @Column(name="id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @OneToOne(targetEntity="Item")
     * @JoinColumn(name="answer_id", referencedColumnName="id")
     **/
    private $answer;

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
     * Set answer
     *
     * @param \App\Entity\Item $answer
     * @return RadioButtonAnswer
     */
    public function setAnswer(\App\Entity\Item $answer = null)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return \App\Entity\Item 
     */
    public function getAnswer()
    {
        return $this->answer;
    }
}
