<?php

namespace ArtesanIO\MoocsyBundle\EventListener;

use ArtesanIO\ArtesanusBundle\Utils\Slugger;
use ArtesanIO\MoocsyBundle\Event\ItemsEvent;
use ArtesanIO\MoocsyBundle\Event\MoocsyEvents;
use Symfony\Component\Security\Core\SecurityContext;

class ItemsPreCreateListener
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
    public function onItemPreCreate(ItemsEvent $event)
    {
        $item = $event->getItem();
        $user = $this->security->getToken()->getUser();

        $item->setSlug($this->slug->slugify($item->getItem()));
        $item->setCreator($user);
    }

    public static function getSubscribedEvents()
    {
        return array(
            MoocsyEvents::MOOCSY_ITEMS_PRE_CREATE => 'onItemPreCreate',
        );
    }
}

?>
