<?php

namespace ArtesanIO\MoocsyBundle\Model;

use ArtesanIO\MoocsyBundle\Event\MoocsyEvents;
use ArtesanIO\MoocsyBundle\Event\ItemsEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAware;

class ItemsManager extends ContainerAware
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

    public function findOneBySlug($id)
    {
        return $this->repository->findOneBySlug($id);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function findOneItemModuleCourse($course, $module, $item)
    {
        return $this->repository->findOneItemModuleCourse($course, $module, $item);
    }

    public function getClass()
    {
        return $this->class;
    }

    public function save($model)
    {
        $this->container->get('event_dispatcher')->dispatch(
            MoocsyEvents::MOOCSY_ITEMS_PRE_CREATE, new ItemsEvent($model)
        );

        $this->_save($model);
    }

    protected function _save($model)
    {
        $this->em->persist($model);
        $this->em->flush();
    }

    public function update($model)
    {
        $this->container->get('event_dispatcher')->dispatch(
            MoocsyEvents::MOOCSY_ITEMS_PRE_UPDATE, new ItemsEvent($model)
        );

        $this->em->flush();
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
