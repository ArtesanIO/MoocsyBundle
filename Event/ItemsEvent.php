<?php

namespace ArtesanIO\MoocsyBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class ItemsEvent extends Event
{
    private $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    /**
     * @return Module
     */

    public function getItem()
    {
        return $this->item;
    }
}

?>
