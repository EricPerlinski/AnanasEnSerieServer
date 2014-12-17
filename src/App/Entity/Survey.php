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
    const prefix = "survey";

    /**
     * @ManyToMany(targetEntity="Question")
     * @JoinTable(name="survey_questions",
     *      joinColumns={@JoinColumn(name="survey_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="question_id", referencedColumnName="id", unique=true)}
     *      )
     **/
    private $question;

    /**
     * Set path
     *
     * @param string $path
     * @return Survey
     */
    public function setPath($path)
    {
        parent::setPath($path);
        $this->path = self::prefix . $this->path;

        return $this;
    }

    /**
     * Set pathAdmin
     *
     * @param string $pathAdmin
     * @return Survey
     */
    public function setPathAdmin($pathAdmin)
    {
        parent::setPathAdmin($path);
        $this->path = self::prefix . $this->pathAdmin;

        return $this;
    }

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
