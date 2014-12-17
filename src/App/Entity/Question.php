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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function jsonSerialize() {
        return array();
    }
}
