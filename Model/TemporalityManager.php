<?php

namespace ArtesanIO\MoocsyBundle\Model;

use ArtesanIO\MoocsyBundle\Event\TemporalityEvent;
use ArtesanIO\MoocsyBundle\Event\MoocsyEvents;
use ArtesanIO\MoocsyBundle\Model\Temporality;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAware;

class TemporalityManager extends ContainerAware
{

    protected $temporality;

    public function __construct(Temporality $temporality)
    {
        $this->temporality = $temporality;
    }

    public function getTemporality()
    {
        $this->container->get('event_dispatcher')->dispatch(
            MoocsyEvents::MOOCSY_TEMPORALITY, new TemporalityEvent($this->temporality)
        );

        $temporality = array();

        foreach($this->temporality->getTemporality() as $tempo){
            $temporality[$tempo['key']] = $tempo["temporality"];
        }

        return $temporality;
    }
}
?>
