<?php

namespace ArtesanIO\MoocsyBundle\EventListener;

use ArtesanIO\ArtesanusBundle\Utils\Slugger;
use ArtesanIO\MoocsyBundle\Event\CoursesEvent;
use ArtesanIO\MoocsyBundle\Event\MoocsyEvents;
use Symfony\Component\Security\Core\SecurityContext;

class CoursesPreCreateListener
{
    protected $slug;
    protected $security;

    public function __construct(Slugger $slug, SecurityContext $security)
    {
        $this->slug     = $slug;
        $this->security = $security;
    }

    /**
     * @param \AppBundle\Event\ConfigureMenuEvent $event
     */
    public function onCoursePreCreate(CoursesEvent $event)
    {
        $course = $event->getCourse();
        $user = $this->security->getToken()->getUser();

        $course->setSlug($this->slug->slugify($course->getCourse()));
        $course->setCreator($user);
    }

    public static function getSubscribedEvents()
    {
        return array(
            MoocsyEvents::MOOCSY_COURSES_PRE_CREATE => 'onCoursePreCreate',
        );
    }
}

?>
