<?php

namespace ArtesanIO\MoocsyBundle\DataFixtures\ORM\Dev;

use Hautelook\AliceBundle\Doctrine\DataFixtures\AbstractLoader;

class MoocsyLoader extends AbstractLoader
{

    protected $modules;
    protected $items;

    public function __construct()
    {
        $this->modules = 21;
        $this->items   = 105;
    }

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

    public function module()
    {
        $modules = [];
        $module = 'module';

        for ($i=0; $i < $this->modules; $i++) {
            $modules[$i] = $module.$i;
        }

        return $modules[array_rand($modules)];
    }

    public function items()
    {
        $items = [];
        $item = 'item';

        for ($i=0; $i < $this->items; $i++) {
            $items[$i] = $item.$i;
        }

        return $items[array_rand($items)];
    }

    public function modules()
    {

        return rand(0, $this->modules);
    }

    public function itemsType()
    {
        $itemValue = rand(0, 5);

        $itemsType = array(
            'items_audio',
            'items_audio_down',
            'items_file',
            'items_forum',
            'items_video',
            'items_quiz'
        );

        return $itemsType[$itemValue];
    }
}
