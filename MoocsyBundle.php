<?php

namespace ArtesanIO\MoocsyBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MoocsyBundle extends Bundle
{
    public function getParent()
    {
        return "ArtesanusBundle";
    }
}
