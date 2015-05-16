<?php

namespace Vgks\SigtranBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Answers
 *
 * @ORM\Table(name="answers")
 * @ORM\Entity
 */
class Answers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="q_id", type="integer", nullable=true)
     */
    private $qId;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    private $text;

    /**
     * @var boolean
     *
     * @ORM\Column(name="correct", type="boolean", nullable=true)
     */
    private $correct;



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
     * Set qId
     *
     * @param integer $qId
     * @return Answers
     */
    public function setQId($qId)
    {
        $this->qId = $qId;

        return $this;
    }

    /**
     * Get qId
     *
     * @return integer 
     */
    public function getQId()
    {
        return $this->qId;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Answers
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

    /**
     * Set correct
     *
     * @param boolean $correct
     * @return Answers
     */
    public function setCorrect($correct)
    {
        $this->correct = $correct;

        return $this;
    }

    /**
     * Get correct
     *
     * @return boolean 
     */
    public function getCorrect()
    {
        return $this->correct;
    }
}
