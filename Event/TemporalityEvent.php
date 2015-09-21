<?php

namespace ArtesanIO\MoocsyBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class TemporalityEvent extends Event
{
    private $tempo;

    public function __construct($tempo)
    {
        $this->tempo = $tempo;
    }

    /**
     * @return ItemType
     */

    public function getTemporality()
    {
        return $this->tempo;
    }
}

?>
