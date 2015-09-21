<?php

namespace ArtesanIO\MoocsyBundle\Form;

use ArtesanIO\MoocsyBundle\Form\EventListener\ItemsSubscriber;
use ArtesanIO\MoocsyBundle\Model\ItemsTypesManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ItemsType extends AbstractType
{
    protected $itemsTypes;

    public function __construct(ItemsTypesManager $itemsTypes)
    {
        $this->itemsTypes = $itemsTypes;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('itemsType')
            ->add('item')
            ->add('description')
            ->addEventSubscriber(new ItemsSubscriber($this->itemsTypes));
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArtesanIO\MoocsyBundle\Entity\Items'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'moocsy_items_type';
    }
}
