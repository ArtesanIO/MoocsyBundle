<?php

namespace ArtesanIO\MoocsyBundle\Form\EventListener;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ItemsSubscriber implements EventSubscriberInterface
{

    protected $itemsTypes;

    public function __construct($itemsTypes)
    {
        $this->itemsTypes = $itemsTypes;
    }

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

        if($data->getId() != null){
            $form->add('itemsType', 'choice', array(
                'choices' => $this->getItemsTypes(),
                'empty_value' => '--Seleccione--',
                // 'attr' => array(
                //     'disabled' => 'disabled'
                // )
            ));
        }else{
            $form->add('itemsType', 'choice', array(
                'choices' => $this->getItemsTypes(),
                'empty_value' => '--Seleccione--',
            ));
        }

    }

    function getItemsTypes()
    {
        $itemsTypes = array();

        foreach($this->itemsTypes->getItemsTypes() as $itemType){
            $itemsTypes[$itemType['key']] = $itemType["itemType"];
        }

        return $itemsTypes;
    }
}

?>
