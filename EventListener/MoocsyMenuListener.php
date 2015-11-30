<?php

namespace ArtesanIO\MoocsyBundle\EventListener;

use ArtesanIO\ArtesanusBundle\Event\ArtesanusMenuEvent;
use ArtesanIO\MoocsyBundle\Model\NotificationsManager;

class MoocsyMenuListener
{
    private $notifications;

    public function __construct(NotificationsManager $notifications)
    {
        $this->notifications = $notifications;
    }
    /**
     * @param \AppBundle\Event\ConfigureMenuEvent $event
     */
    public function onArtesanusNavBar(ArtesanusMenuEvent $event)
    {
        $menu = $event->getMenu();

        $notifications = count($this->notifications->findNotificationsUnanswered());

        $menu->addChild('Moocsy', array('route' => 'moocsy_admin_courses'));
        $menu->addChild('Notifications | '.$notifications.'', array('route' => 'moocsy_admin_notifications'));
    }
}

?>
