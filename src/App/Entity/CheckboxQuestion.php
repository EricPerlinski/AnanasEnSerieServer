<?php

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="checkboxquestion")
 */
class CheckboxQuestion extends Question
{
	/**
     * @OneToOne(targetEntity="Item")
     * @JoinColumn(name="answer_id", referencedColumnName="id")
     **/
    private $answer;

	/**
     * @ManyToMany(targetEntity="Item")
     * @JoinTable(name="checkbox_items",
     *      joinColumns={@JoinColumn(name="checkbox_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@JoinColumn(name="item_id", referencedColumnName="id", unique=true)}
     *      )
     **/
    private $item;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->item = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set answer
     *
     * @param \App\Entity\Item $answer
     * @return CheckboxQuestion
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

    /**
     * Add item
     *
     * @param \App\Entity\Item $item
     * @return CheckboxQuestion
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
}
