<?php

namespace ArtesanIO\MoocsyBundle\EventListener;

use ArtesanIO\ArtesanusBundle\Utils\Slugger;
use ArtesanIO\MoocsyBundle\Event\ItemsEvent;
use ArtesanIO\MoocsyBundle\Event\MoocsyEvents;
use Symfony\Component\Security\Core\SecurityContext;

class ItemsPreUpdateListener
{
    protected $security;

    public function __construct(SecurityContext $security)
    {
        $this->security = $security;
    }

    /**
     * @param \ArtesanIO\ArtesanusBundle\Event\ItemsEvent $event
     */
    public function onItemPreUpdate(ItemsEvent $event)
    {
        $item = $event->getItem();

        $user = $this->security->getToken()->getUser();

        $item->setUpdater($user);
        $item->setUpdated(new \Datetime('now'));
    }

    public static function getSubscribedEvents()
    {
        return array(
            MoocsyEvents::MOOCSY_ITEMS_PRE_UPDATE => 'onItemPreUpdate',
        );
    }
}

?>
