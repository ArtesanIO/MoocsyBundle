<?php

namespace ArtesanIO\MoocsyBundle\EventListener;

use ArtesanIO\ArtesanusBundle\Utils\Slugger;
use ArtesanIO\MoocsyBundle\Event\CoursesEvent;
use ArtesanIO\MoocsyBundle\Event\MoocsyEvents;
use Symfony\Component\Security\Core\SecurityContext;

class CoursesPreUpdateListener
{
    protected $security;

    public function __construct(SecurityContext $security)
    {
        $this->security = $security;
    }

    /**
     * @param \ArtesanIO\ArtesanusBundle\Event\CoursesEvent $event
     */
    public function onCoursePreUpdate(CoursesEvent $event)
    {
        $course = $event->getCourse();

        $user = $this->security->getToken()->getUser();

        $course->setUpdater($user);
        $course->setUpdated(new \Datetime('now'));
    }

    public static function getSubscribedEvents()
    {
        return array(
            MoocsyEvents::MOOCSY_COURSES_PRE_UPDATE => 'onCoursePreUpdate',
        );
    }
}

?>
