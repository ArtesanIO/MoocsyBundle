<?php

namespace ArtesanIO\MoocsyBundle\EventListener;

use ArtesanIO\ArtesanusBundle\Utils\Slugger;
use ArtesanIO\MoocsyBundle\Event\ModulesEvent;
use ArtesanIO\MoocsyBundle\Event\MoocsyEvents;
use Symfony\Component\Security\Core\SecurityContext;

class ModulesPreCreateListener
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
    public function onModulePreCreate(ModulesEvent $event)
    {
        $module = $event->getModule();
        $user = $this->security->getToken()->getUser();

        $sluger = substr(md5(uniqid().$this->slug->slugify($module->getModule())), 0, 8);

        $module->setSlug($sluger);
        $module->setCreator($user);
    }

    public static function getSubscribedEvents()
    {
        return array(
            MoocsyEvents::MOOCSY_MODULES_PRE_CREATE => 'onModulePreCreate',
        );
    }
}

?>
