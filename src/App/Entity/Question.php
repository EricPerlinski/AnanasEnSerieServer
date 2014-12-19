<?php

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="question")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"openquestion" = "OpenQuestion", "radiobuttonquestion" = "RadioButtonQuestion", "checkboxquestion" = "CheckboxQuestion"})
 */
abstract class Question implements \JsonSerializable
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
     * @var string
     *
     * @Column(name="text", type="string", length=255)
     */
    private $text;

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
     * Set text
     *
     * @param string $text
     * @return Question
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }
}
