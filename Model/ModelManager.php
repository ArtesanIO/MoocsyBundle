<?php

namespace ArtesanIO\MoocsyBundle\Model;

use Doctrine\ORM\EntityManager;

class CoursesManager
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
        return new $this->getClass();
    }

    public function find($id)
    {
        return $this->repository->find($id);
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
        $model->setPassword($this->encoder->setUserPassword($model, $model->getPassword()));
        $this->_save($model);
    }

    protected function _save($model)
    {
        $this->em->persist($model);
        $this->em->flush();
    }

    public function update()
    {
        $this->em->flush();
    }

}



?>
