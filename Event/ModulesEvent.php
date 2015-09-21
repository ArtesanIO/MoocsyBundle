<?php

namespace ArtesanIO\MoocsyBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class ModulesEvent extends Event
{
    private $module;

    public function __construct($module)
    {
        $this->module = $module;
    }

    /**
     * @return Module
     */

    public function getModule()
    {
        return $this->module;
    }
}

?>
