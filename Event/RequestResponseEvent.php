<?php

namespace ArtesanIO\MoocsyBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class RequestResponseEvent extends Event
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @return Course
     */

    public function getRequestResponse()
    {
        return $this->request;
    }
}

?>
