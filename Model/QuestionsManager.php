<?php

namespace ArtesanIO\MoocsyBundle\Model;

use ArtesanIO\MoocsyBundle\Event\MoocsyEvents;
use ArtesanIO\MoocsyBundle\Event\ItemsEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAware;
use Doctrine\Common\Collections\ArrayCollection;

class QuestionsManager extends ContainerAware
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

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function findQuestionQuizItemModuleCourse($question, $quiz, $item, $module, $course)
    {
        return $this->repository->findQuestionQuizItemModuleCourse($question, $quiz, $item, $module, $course);
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

    public function update()
    {
        // $this->container->get('event_dispatcher')->dispatch(
        //     MoocsyEvents::MOOCSY_ITEMS_PRE_UPDATE, new ItemsEvent($model)
        // );

        $this->em->flush();
    }

    public function optionsOriginales($model)
    {
        $options = new ArrayCollection();

        foreach($model->getOptions() as $option){
            $options->add($option);
        }

        return $options;
    }

    public function updateQuestionsOptions($model, $original)
    {
        foreach($original as $i){
            if(false === $model->getOptions()->contains($i)){
                $this->em->remove($i);
            }
        }

        $this->update();
    }

    public function delete($model, $flush = true) {
        $this->_delete($model, $flush);
    }
    /**
     * Remove model.
     */
    public function _delete($model, $flush = true) {
        $this->em->remove($model);
        if ($flush) {
            $this->em->flush();
        }
    }

}



?>
