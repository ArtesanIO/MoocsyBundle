<?php

namespace ArtesanIO\MoocsyBundle\Model;


class Temporality
{
    protected $tempo;

    public function __construct()
    {
        $this->tempo = [];
    }

    public function add(array $array = array())
    {
        $array[1]["key"] = $array[0];

        if(!isset($array[1]["description"])){
            $array[1]["description"] = '--';
        }

        return $this->tempo[$array[0]] = $array[1];
    }

    public function getTemporality()
    {
        return $this->tempo;
    }
}

?>
