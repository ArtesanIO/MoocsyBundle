<?php

namespace ArtesanIO\MoocsyBundle\DataFixtures\ORM\Dev;

use Hautelook\AliceBundle\Doctrine\DataFixtures\AbstractLoader;

class MoocsyLoader extends AbstractLoader
{
    /**
     * {@inheritdoc}
     */
    public function getFixtures()
    {
        return [
            __DIR__.'/moocsy.yml'
        ];
    }

    public function published()
    {
        return new \Datetime('now');
    }
}
