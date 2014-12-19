<?php

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="openquestion")
 */
class OpenQuestion extends Question
{

    /**
     * @ManyToMany(targetEntity="OpenAnswer")
     * @JoinTable(name="openquestion_answers",
     *      joinColumns={@JoinColumn(name="question_id", referencedColumnName="id", onDelete="CASCADE"  )},
     *      inverseJoinColumns={@JoinColumn(name="answer_id", referencedColumnName="id", unique=true)}
     *      )
     **/
    private $answer;

    /**
     * @var string
     *
     * @Column(name="question", type="text")
     */
    private $question;

    /**
     * @var string
     *
     * @Column(name="answer", type="text")
     */
    

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
     * @param \App\Entity\OpenAnswer $answer
     * @return OpenQuestion
     */
    public function addAnswer(\App\Entity\OpenAnswer $answer)
    {
        $this->answer[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \App\Entity\OpenAnswer $answer
     */
    public function removeAnswer(\App\Entity\OpenAnswer $answer)
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
        return array('question' => json_encode($this->getQuestion()), 
            'answer' => json_encode($this->getAnswer()));
    }

    /**
     * Set question
     *
     * @param string $question
     * @return OpenQuestion
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

    public function getType(){
        return "OpenQuestion";
    }
}
