<?php

namespace ArtesanIO\MoocsyBundle\Model;


class ItemsTypes
{
    protected $type;

    public function __construct()
    {
        $this->type = [];
    }

    public function createType(array $array = array())
    {
        $array[1]["key"] = $array[0];

        if(!isset($array[1]["description"])){
            $array[1]["description"] = '--';
        }

        return $this->type[$array[0]] = $array[1];
    }

    public function getItemsTypes()
    {
        return $this->type;
    }
}

?>
