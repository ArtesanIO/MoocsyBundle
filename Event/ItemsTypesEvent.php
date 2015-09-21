<?php

namespace ArtesanIO\MoocsyBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class ItemsTypesEvent extends Event
{
    private $itemType;

    public function __construct($itemType)
    {
        $this->itemType = $itemType;
    }

    /**
     * @return ItemType
     */

    public function getItemType()
    {
        return $this->itemType;
    }
}

?>
