<?php

namespace ArtesanIO\MoocsyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Questions
 *
 * @ORM\Table(name="moocsy_quiz_questions")
 * @ORM\Entity(repositoryClass="ArtesanIO\MoocsyBundle\Entity\QuestionsRepository")
 */
class Questions
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
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
    * @ORM\ManyToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\ItemsQuiz", inversedBy="questions")
    * @ORM\JoinColumn(name="quiz_id", referencedColumnName="id")
    */

    private $itemsQuiz;

    /**
     * @ORM\OneToMany(targetEntity="ArtesanIO\MoocsyBundle\Entity\Options", mappedBy="questions", cascade={"persist", "remove"})
     */

    private $options;

    /**
     * @ORM\OneToMany(targetEntity="ArtesanIO\MoocsyBundle\Entity\QuizDetailsUser", mappedBy="questions" , cascade={"persist", "remove"})
     */

    private $quizDetailsUser;

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
     * Set question
     *
     * @param string $question
     * @return Questions
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

    /**
     * Set itemsQuiz
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsQuiz $itemsQuiz
     * @return Questions
     */
    public function setItemsQuiz(\ArtesanIO\MoocsyBundle\Entity\ItemsQuiz $itemsQuiz = null)
    {
        $this->itemsQuiz = $itemsQuiz;

        return $this;
    }

    /**
     * Get itemsQuiz
     *
     * @return \ArtesanIO\MoocsyBundle\Entity\ItemsQuiz
     */
    public function getItemsQuiz()
    {
        return $this->itemsQuiz;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->options = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add options
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\Options $options
     * @return Questions
     */
    public function addOption(\ArtesanIO\MoocsyBundle\Entity\Options $options)
    {
        $this->options[] = $options;

        return $this;
    }

    /**
     * Remove options
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\Options $options
     */
    public function removeOption(\ArtesanIO\MoocsyBundle\Entity\Options $options)
    {
        $this->options->removeElement($options);
    }

    /**
     * Get options
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Add quizDetailsUser
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\QuizDetailsUser $quizDetailsUser
     * @return Questions
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
