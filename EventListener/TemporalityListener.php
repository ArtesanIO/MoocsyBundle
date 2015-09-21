<?php

namespace ArtesanIO\MoocsyBundle\EventListener;

use ArtesanIO\MoocsyBundle\Event\TemporalityEvent;
use ArtesanIO\MoocsyBundle\Event\MoocsyEvents;

class TemporalityListener
{
    /**
     * @param \AppBundle\Event\ConfigureMenuEvent $event
     */
    public function onTemporality(TemporalityEvent $event)
    {
        $temporality = $event->getTemporality();
        $temporality->add(array('1', array('temporality' => '1 día', 'description' => 'Cada día')));
        $temporality->add(array('7', array('temporality' => '7 días', 'description' => 'Cada 7 días')));
        $temporality->add(array('14', array('temporality' => '14 días', 'description' => 'Cada 14 días')));

    }

    public static function getSubscribedEvents()
    {
        return array(
            MoocsyEvents::MOOCSY_TEMPORALITY => 'onTemporality',
        );
    }
}

?>
