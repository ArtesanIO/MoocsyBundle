<?php

namespace ArtesanIO\MoocsyBundle\Form;

use ArtesanIO\MoocsyBundle\Form\EventListener\CoursesUsersSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CoursesUsersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('users','entity', array(
                'class' => 'ArtesanusBundle:User',
                'property' => 'name',
                'expanded' => false,
                'empty_value' => '--Seleccione--'
            ))
            ->addEventSubscriber(new CoursesUsersSubscriber());
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArtesanIO\MoocsyBundle\Entity\CoursesUsers'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'moocsy_courses_users_type';
    }
}
