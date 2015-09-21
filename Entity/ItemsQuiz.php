<?php

namespace ArtesanIO\MoocsyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemsQuiz
 *
 * @ORM\Table(name="moocsy_items_quiz")
 * @ORM\Entity(repositoryClass="ArtesanIO\MoocsyBundle\Entity\ItemsQuizRepository")
 */
class ItemsQuiz
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
    * @ORM\OneToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\Items", inversedBy="itemsQuiz")
    * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
    */
    private $items;

    /**
     * @var string
     *
     * @ORM\Column(name="quiz", type="string", length=255)
     */
    private $quiz;

    /**
     * @ORM\OneToMany(targetEntity="ArtesanIO\MoocsyBundle\Entity\Questions", mappedBy="itemsQuiz", cascade={"persist", "remove"})
     */

    private $questions;

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
     * Set items
     *
     * @param integer $items
     * @return ItemsQuiz
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Get items
     *
     * @return integer
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set quiz
     *
     * @param string $quiz
     * @return ItemsQuiz
     */
    public function setQuiz($quiz)
    {
        $this->quiz = $quiz;

        return $this;
    }

    /**
     * Get quiz
     *
     * @return string
     */
    public function getQuiz()
    {
        return $this->quiz;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add questions
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\Questions $questions
     * @return ItemsQuiz
     */
    public function addQuestion(\ArtesanIO\MoocsyBundle\Entity\Questions $questions)
    {
        $this->questions[] = $questions;

        return $this;
    }

    /**
     * Remove questions
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\Questions $questions
     */
    public function removeQuestion(\ArtesanIO\MoocsyBundle\Entity\Questions $questions)
    {
        $this->questions->removeElement($questions);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestions()
    {
        return $this->questions;
    }
}
