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
     * @ManyToMany(targetEntity="Question")
     * @JoinTable(name="survey_answers",
     *      joinColumns={@JoinColumn(name="survey_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@JoinColumn(name="question_id", referencedColumnName="id")}
     *      )
     **/
     private $answer;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
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

    public function jsonSerialize() {
        return array(
            'question' =>  json_encode($this->getQuestion()),
            'answer'     =>  json_encode($this->getAnswer()));
    }


    /**
     * Add answer
     *
     * @param \App\Entity\Question $answer
     * @return Survey
     */
    public function addAnswer(\App\Entity\Question $answer)
    {
        $this->answer[] = $answer;

        return $this;
    }

    /**
     * Remove answer
     *
     * @param \App\Entity\Question $answer
     */
    public function removeAnswer(\App\Entity\Question $answer)
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

    public function printSurvey(){
        foreach ($this->getQuestion() as $key => $question) {
            if($question instanceof OpenQuestion){
                echo "Question : ".$question->getQuestion()."<br>";
            }else if($question instanceof CheckboxQuestion){
                foreach ($question->getItem() as $key => $item) {
                    echo $item->getText()." , ";
                }
                echo "<br>";
            }else if($question instanceof RadioButtonQuestion){
                foreach ($question->getItem() as $key => $item) {
                    echo $item->getText()." , ";
                }
                echo "<br>";
            }
        }
    }
}
