<?php

namespace ArtesanIO\MoocsyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OptionsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('options')
            ->add('value', null, array(
                'label' => false,
                'required' => false
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArtesanIO\MoocsyBundle\Entity\Options'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'moocsy_options_type';
    }
}
