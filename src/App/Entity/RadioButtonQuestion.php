<?php

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="radiobuttonquestion")
 */
class RadioButtonQuestion extends Question
{

	/**
     * @ManyToMany(targetEntity="RadioButtonAnswer")
     * @JoinTable(name="radiobuttonquestion_answers",
     *      joinColumns={@JoinColumn(name="question_id", referencedColumnName="id", onDelete="CASCADE"  )},
     *      inverseJoinColumns={@JoinColumn(name="answer_id", referencedColumnName="id", unique=true)}
     *      )
     **/
    private $answer;

	/**
     * @ManyToMany(targetEntity="Item")
     * @JoinTable(name="radiobutton_items",
     *      joinColumns={@JoinColumn(name="radiobutton_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@JoinColumn(name="item_id", referencedColumnName="id", unique=true)}
     *      )
     **/
    private $item;

    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answer = new \Doctrine\Common\Collections\ArrayCollection();
        $this->item = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add item
     *
     * @param \App\Entity\Item $item
     * @return RadioButtonQuestion
     */
    public function addItem(\App\Entity\Item $item)
    {
        $this->item[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param \App\Entity\Item $item
     */
    public function removeItem(\App\Entity\Item $item)
    {
        $this->item->removeElement($item);
    }

    /**
     * Get item
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Add answer
     *
     * @param \App\Entity\RadioButtonAnswer $answer
     * @return RadioButtonQuestion
     */
    public function addAnswer(\App\Entity\RadioButtonAnswer $answer)
    {
        $this->answer[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \App\Entity\RadioButtonAnswer $answer
     */
    public function removeAnswer(\App\Entity\RadioButtonAnswer $answer)
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

    public function jsonSerialize() {
        return array('answer' => json_encode($this->getAnswer()),
            'item' => json_encode($this->getItem()));
    }

}
