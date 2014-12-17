<?php

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="survey")
 */
class Survey extends QRCode
{
    protected $prefix = "survey";

    /**
     * @ManyToMany(targetEntity="Question")
     * @JoinTable(name="survey_questions",
     *      joinColumns={@JoinColumn(name="survey_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@JoinColumn(name="question_id", referencedColumnName="id", unique=true)}
     *      )
     **/
    private $question;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent();
        $this->question = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add question
     *
     * @param \App\Entity\Question $question
     * @return Survey
     */
    public function addQuestion(\App\Entity\Question $question)
    {
        $this->question[] = $question;

        return $this;
    }

    /**
     * Remove question
     *
     * @param \App\Entity\Question $question
     */
    public function removeQuestion(\App\Entity\Question $question)
    {
        $this->question->removeElement($question);
    }

    /**
     * Get question
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
