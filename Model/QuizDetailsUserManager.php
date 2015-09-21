<?php

namespace ArtesanIO\MoocsyBundle\Model;

use ArtesanIO\MoocsyBundle\Event\MoocsyEvents;
use ArtesanIO\MoocsyBundle\Event\ItemsEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAware;

class QuizDetailsUserManager extends ContainerAware
{
    protected $em;
    protected $class;
    protected $repository;
    protected $form;


    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->repository = $em->getRepository($class);
        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->name;

    }

    public function create()
    {
        $class = $this->getClass();
        return new $class;
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function findOptionsQuestionQuiz($id)
    {
        return $this->repository->findOptionsQuestionQuiz($id);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function getClass()
    {
        return $this->class;
    }

    public function save($model)
    {
        // $this->container->get('event_dispatcher')->dispatch(
        //     MoocsyEvents::MOOCSY_ITEMS_PRE_CREATE, new ItemsEvent($model)
        // );

        $this->_save($model);
    }

    protected function _save($model)
    {
        $this->em->persist($model);
        $this->em->flush();
    }

    public function update($model)
    {
        // $this->container->get('event_dispatcher')->dispatch(
        //     MoocsyEvents::MOOCSY_ITEMS_PRE_UPDATE, new ItemsEvent($model)
        // );

        $this->em->flush();
    }

    public function findQuizItemModuleCourse($quiz, $item, $module, $course)
    {
        return $this->repository->findQuizItemModuleCourse($quiz, $item, $module, $course);
    }

    public function getQuestion($model)
    {
        $quiz = $model->getItemsQuiz();
        $questions = $quiz->getQuestions();

        $questionQuantity = count($questions);

        $questionQualified = $this->findOptionsQuestionQuiz($quiz->getId());

        if($questionQuantity != count($questionQualified)){
            $questionsQuizQualified = array();

            foreach($questionQualified as $option){
                $questionsQuizQualified[$option->getQuestions()->getId()] = $option->getQuestions()->getId();
            }

            $questionsQuiz = array();

            foreach($questions as $question){

                if(!in_array($question->getId(), $questionsQuizQualified)){
                    $questionsQuiz[$question->getId()] = $question;
                }
            }

            return current($questionsQuiz);
        }

        return null;

    }

    public function quizResponded($model)
    {
        $quiz = $model->getItemsQuiz();
        $questions = $quiz->getQuestions();

        $questionQuantity = count($questions);

        $questionQualified = count($this->findOptionsQuestionQuiz($quiz->getId()));

        if($questionQuantity === $questionQualified){
            return true;
        }

        return false;
    }

}



?>
