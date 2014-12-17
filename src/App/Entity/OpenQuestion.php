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
     * @var string
     *
     * @Column(name="answer", type="text")
     */
    private $answer;


    /**
     * Set answer
     *
     * @param string $answer
     * @return OpenQuestion
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string 
     */
    public function getAnswer()
    {
        return $this->answer;
    }
}
