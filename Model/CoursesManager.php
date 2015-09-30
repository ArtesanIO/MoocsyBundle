<?php

namespace ArtesanIO\MoocsyBundle\Model;

use ArtesanIO\MoocsyBundle\Event\MoocsyEvents;
use ArtesanIO\MoocsyBundle\Event\CoursesEvent;
use ArtesanIO\ArtesanusBundle\Model\ModelManager;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Security\Core\SecurityContext;

class CoursesManager extends ModelManager
{
    protected $em;
    protected $class;
    protected $repository;
    protected $security;

    public function __construct(EntityManager $em, $class, SecurityContext $security)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository($class);
        $metadata = $this->em->getClassMetadata($class);
        $this->class = $metadata->name;
        $this->security = $security;
    }

    public function setContainer($container) {
        $this->container = $container;
    }
    public function getContainer() {
        return $this->container;
    }

    public function getDispatcher() {
        return $this->getContainer()->get('event_dispatcher');
    }

    protected function getUser()
    {
        return $this->security->getToken()->getUser();
    }

    public function create()
    {
        $class = $this->getClass();
        return new $class;
    }

    public function find($id)
    {
        return $this->repository->findOneBy(array('id' => $id));
    }

    public function findOneBySlug($id)
    {
        return $this->repository->findOneBySlug($id);
    }

    public function findOneBySKU($id)
    {
        return $this->repository->findOneBySku($id);
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

    public function save($model, $flush = true)
    {
        $this->getDispatcher()->dispatch('moocsy.courses_pre_create', new CoursesEvent($model));

        $this->_save($model);
    }

    protected function _save($model,$flush = true)
    {
        $this->em->persist($model);
        $this->em->flush();
    }

    public function update($model)
    {

        $this->getDispatcher()->dispatch('moocsy.courses_pre_update', new CoursesEvent($model));

        $this->em->flush();
    }

    public function coursesUsersOriginales($model)
    {
        $options = new ArrayCollection();

        foreach($model->getCoursesUsers() as $option){
            $options->add($option);
        }

        return $options;
    }

    public function updateCoursesUsers($model, $original)
    {
        foreach($original as $i){
            if(false === $model->getCoursesUsers()->contains($i)){
                $this->em->remove($i);
            }

            echo $i->getUsers()->getid()."<br />";
        }

        exit();

        $this->update($model);
    }

    public function findCourseUser($course, $user)
    {
        return $this->repository->findCourseUser($course, $user->getId());
    }

    public function findCoursesUser()
    {
        return $this->repository->findCoursesUser($this->getUser()->getId());
    }

    public function interval($course)
    {
        $publishedCourse = $course->getCourses()->getPublished();
        $registredCourse = $course->getRegistered();

        $startPublished = ($publishedCourse > $registredCourse) ? $publishedCourse : $registredCourse;

        $now = new \Datetime('now');

        if($startPublished > $now){
            return $startPublished;
        }

        $interval = ($startPublished->diff($now)->format("%d")) + 1;

        return $interval;
    }

    public function temporality($course)
    {
        $temporality = $course->getCourses()->getTemporality();

        $interval = ceil($this->interval($course) / $temporality);

        return $interval;
    }

    public function modulesReleased($course)
    {
        $courseModules = $course->getCourses()->getModules();

        $modules = array();

        foreach($courseModules as $key => $module){
            $modules[$key] = $module->getId();
        }

        $released = array();

        if (!$this->security->isGranted("ROLE_ADMIN")) {

            for($i = 0; $i < count($this->temporality($course)); $i++){
                $released[$modules[$i]] = $modules[$i];
            }

            return $released;
        }

        for($i = 0; $i < count($modules); $i++){
            $released[$modules[$i]] = $modules[$i];
        }

        return $released;
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
