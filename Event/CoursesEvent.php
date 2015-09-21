<?php

namespace ArtesanIO\MoocsyBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class CoursesEvent extends Event
{
    private $course;

    public function __construct($course)
    {
        $this->course = $course;
    }

    /**
     * @return Course
     */

    public function getCourse()
    {
        return $this->course;
    }
}

?>
