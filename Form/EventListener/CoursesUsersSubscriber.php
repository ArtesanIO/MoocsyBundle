<?php

namespace ArtesanIO\MoocsyBundle\Form\EventListener;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CoursesUsersSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return array(
          FormEvents::PRE_SET_DATA => 'preSetData',

        );
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        if($data->getId()){

            $form
                ->add('users','entity', array(
                    'class' => 'ArtesanusBundle:User',
                    'property' => 'name',
                    'expanded' => false,
                    'empty_value' => '--Seleccione--',
                ))
            ;
        }

    }
}

?>
