<?php

namespace ArtesanIO\MoocsyBundle\Model;

use ArtesanIO\ArtesanusBundle\Model\ModelManager;
use ArtesanIO\MoocsyBundle\Model\RequestResponseManager;
use ArtesanIO\ArtesanusBundle\Model\UserManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;

class NotificationsManager extends ModelManager
{
    protected $em;
    protected $class;
    protected $repository;
    protected $container;
    protected $security;
    protected $userManager;
    protected $requestResponse;

    /**
     * Constructor.
     *
     * @param EntityManager  $em
     * @param string   $class
     */
    public function __construct(EntityManager $em, $class, SecurityContext $security, UserManager $userManager, RequestResponseManager $requestResponse) {

        $this->em = $em;
        $this->repository = $this->em->getRepository($class);
        $metadata = $this->em->getClassMetadata($class);
        $this->class = $metadata->name;
        $this->security = $security;
        $this->userManager = $userManager;
        $this->requestResponse = $requestResponse;

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

    /**
     * Create model object
     *
     * @return BaseModel
     */
    public function create() {
        $class = $this->getClass();
        return new $class;
    }
    /**
     * Persist the model
     *
     * @param $model
     * @param boolean $flush
     * @return BaseModel
     */
    public function save($model, $flush= true) {


        $user = $this->userManager->find($this->getUser());
        $model->setUsers($user);
        // $this->getDispatcher()->dispatch('model_before_save', new ModelEvent($model, $this->getContainer()));
        // $this->getDispatcher()->dispatch($model->getEventPrefix() . '_before_save', new ModelEvent($model, $this->getContainer()));
        $this->_save($model, $flush);
        // $this->getDispatcher()->dispatch('model_after_save', new ModelEvent($model, $this->getContainer()));
        // $this->getDispatcher()->dispatch($model->getEventPrefix() . '_after_save', new ModelEvent($model, $this->getContainer()));
        return $model;
    }
    
    /**
     *    This is basic save function. Child model can overwrite this.
     */
    protected function _save($model, $flush=true) {
        $this->em->persist($model);
        if ($flush) {
            $this->em->flush();
        }
    }
    /**
     * Delete a model.
     *
     * @param BaseModel $model
     */
    public function delete($model, $flush = true) {
        // $this->getDispatcher()->dispatch('model_before_delete', new ModelEvent($model, $this->getContainer()));
        // $this->getDispatcher()->dispatch($model->getEventPrefix() . '_before_delete', new ModelEvent($model, $this->getContainer()));
        $this->_delete($model, $flush);
        // $this->getDispatcher()->dispatch('model_after_delete', new ModelEvent($model, $this->getContainer()));
        // $this->getDispatcher()->dispatch($model->getEventPrefix() . '_after_delete', new ModelEvent($model, $this->getContainer()));
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
    /**
     * Reload the model data.
     */
    public function reload($model) {
        $this->em->refresh($model);
    }
    /**
     * Returns the user's fully qualified class name.
     *
     * @return string
     */
    public function getClass() {
        return $this->class;
    }
    /**
     * @param $id
     * @return BaseModel
     */
    public function find($id) {
        return $this->repository->findOneBy(array('id' => $id));
    }

    public function findUserNotifications($id) {
        return $this->repository->findUserNotifications($id);
    }

    public function isDebug() {
        return $this->container->get('kernel')->isDebug();
    }

    public function findNotificationsUnanswered()
    {
        return $this->repository->findNotificationsUnanswered();
    }

    public function findNotificationsAnswered()
    {
        return $this->repository->findNotificationsAnswered();
    }

}

?>
