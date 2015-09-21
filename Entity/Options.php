<?php

namespace ArtesanIO\MoocsyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Options
 *
 * @ORM\Table(name="moocsy_question_options")
 * @ORM\Entity(repositoryClass="ArtesanIO\MoocsyBundle\Entity\OptionsRepository")
 */
class Options
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="options", type="string", length=255)
     */
    private $options;

    /**
    * @ORM\ManyToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\Questions", inversedBy="options")
    * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
    */
    private $questions;

    /**
     * @ORM\OneToMany(targetEntity="ArtesanIO\MoocsyBundle\Entity\QuizDetailsUser", mappedBy="questions" , cascade={"persist", "remove"})
     */

    private $quizDetailsUser;

    /**
     * @var boolean
     *
     * @ORM\Column(name="value", type="boolean")
     */
    private $value;


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
     * Set options
     *
     * @param string $options
     * @return Options
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get options
     *
     * @return string
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set questions
     *
     * @param integer $questions
     * @return Options
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;

        return $this;
    }

    /**
     * Get questions
     *
     * @return integer
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Set value
     *
     * @param boolean $value
     * @return Options
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return boolean
     */
    public function getValue()
    {
        return $this->value;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->quizDetailsUser = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add quizDetailsUser
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\QuizDetailsUser $quizDetailsUser
     * @return Options
     */
    public function addQuizDetailsUser(\ArtesanIO\MoocsyBundle\Entity\QuizDetailsUser $quizDetailsUser)
    {
        $this->quizDetailsUser[] = $quizDetailsUser;

        return $this;
    }

    /**
     * Remove quizDetailsUser
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\QuizDetailsUser $quizDetailsUser
     */
    public function removeQuizDetailsUser(\ArtesanIO\MoocsyBundle\Entity\QuizDetailsUser $quizDetailsUser)
    {
        $this->quizDetailsUser->removeElement($quizDetailsUser);
    }

    /**
     * Get quizDetailsUser
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuizDetailsUser()
    {
        return $this->quizDetailsUser;
    }
}
