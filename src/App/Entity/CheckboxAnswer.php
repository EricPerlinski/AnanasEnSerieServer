<?php

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="checkboxanswer")
 */
class CheckboxAnswer
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
     * @ManyToMany(targetEntity="Item")
     * @JoinTable(name="checkboxanswer_answers",
     *      joinColumns={@JoinColumn(name="checkboxanswer_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="answer_id", referencedColumnName="id")}
     *      )
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
     * Constructor
     */
    public function __construct()
    {
        $this->answer = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add answer
     *
     * @param \App\Entity\Item $answer
     * @return CheckboxAnswer
     */
    public function addAnswer(\App\Entity\Item $answer)
    {
        $this->answer[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \App\Entity\Item $answer
     */
    public function removeAnswer(\App\Entity\Item $answer)
    {
        $this->answer->removeElement($answer);
    }

    /**
     * Get answer
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswer()
    {
        return $this->answer;
    }
}
