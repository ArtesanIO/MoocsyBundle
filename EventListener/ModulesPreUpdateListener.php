<?php

namespace ArtesanIO\MoocsyBundle\EventListener;

use ArtesanIO\ArtesanusBundle\Utils\Slugger;
use ArtesanIO\MoocsyBundle\Event\ModulesEvent;
use ArtesanIO\MoocsyBundle\Event\MoocsyEvents;
use Symfony\Component\Security\Core\SecurityContext;

class ModulesPreUpdateListener
{
    protected $security;

    public function __construct(SecurityContext $security)
    {
        $this->security = $security;
    }

    /**
     * @param \ArtesanIO\ArtesanusBundle\Event\CoursesEvent $event
     */
    public function onModulesPreUpdate(ModulesEvent $event)
    {
        $module = $event->getModule();

        $user = $this->security->getToken()->getUser();

        $module->setUpdater($user);
        $module->setUpdated(new \Datetime('now'));
    }

    public static function getSubscribedEvents()
    {
        return array(
            MoocsyEvents::MOOCSY_MODULES_PRE_UPDATE => 'onModulesPreUpdate',
        );
    }
}

?>
