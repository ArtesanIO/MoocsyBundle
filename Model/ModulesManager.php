<?php

namespace ArtesanIO\MoocsyBundle\Model;

use ArtesanIO\MoocsyBundle\Event\MoocsyEvents;
use ArtesanIO\MoocsyBundle\Event\ModulesEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAware;

class ModulesManager extends ContainerAware
{
    protected $em;
    protected $class;
    protected $repository;

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

    public function findOneModuleCourse($course, $module)
    {
        return $this->repository->findOneModuleCourse($course, $module);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function usernameOREmail($username)
    {
        return $this->repository->findUsernameOREmail($username);
    }

    public function getClass()
    {
        return $this->class;
    }

    public function save($model)
    {
        $this->container->get('event_dispatcher')->dispatch(
            MoocsyEvents::MOOCSY_MODULES_PRE_CREATE, new ModulesEvent($model)
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
            MoocsyEvents::MOOCSY_MODULES_PRE_UPDATE, new ModulesEvent($model)
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
