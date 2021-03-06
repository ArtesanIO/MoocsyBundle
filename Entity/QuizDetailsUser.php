<?php

namespace ArtesanIO\MoocsyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuizDetailsUser
 *
 * @ORM\Table(name="moocsy_quiz_details")
 * @ORM\Entity(repositoryClass="ArtesanIO\MoocsyBundle\Entity\QuizDetailsUserRepository")
 */
class QuizDetailsUser
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
    * @ORM\ManyToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\Questions", inversedBy="quizDetailsUser")
    * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
    */
    private $questions;

    /**
    * @ORM\ManyToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\Options", inversedBy="quizDetailsUser")
    * @ORM\JoinColumn(name="option_id", referencedColumnName="id")
    */
    private $options;

    /**
     * @var boolean
     *
     * @ORM\Column(name="value", type="boolean")
     */
    private $value;

    /**
    * @ORM\ManyToOne(targetEntity="ArtesanIO\ArtesanusBundle\Entity\User", inversedBy="quizDetailsUser")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    */
    private $users;

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
     * Set itemsQuiz
     *
     * @param integer $itemsQuiz
     * @return QuizDetailsUser
     */
    public function setItemsQuiz($itemsQuiz)
    {
        $this->itemsQuiz = $itemsQuiz;

        return $this;
    }

    /**
     * Get itemsQuiz
     *
     * @return integer
     */
    public function getItemsQuiz()
    {
        return $this->itemsQuiz;
    }

    /**
     * Set questions
     *
     * @param integer $questions
     * @return QuizDetailsUser
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
     * Set options
     *
     * @param integer $options
     * @return QuizDetailsUser
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get options
     *
     * @return integer
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set value
     *
     * @param boolean $value
     * @return QuizDetailsUser
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
     * Set users
     *
     * @param \ArtesanIO\ArtesanusBundle\Entity\User $users
     * @return QuizDetailsUser
     */
    public function setUsers(\ArtesanIO\ArtesanusBundle\Entity\User $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return \ArtesanIO\ArtesanusBundle\Entity\User 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
