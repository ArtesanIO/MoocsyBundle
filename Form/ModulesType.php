<?php

namespace ArtesanIO\MoocsyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ModulesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('module')
            ->add('description')
            ->add('mail', null, array(
                'attr' => array(
                    'class' => 'ckeditor',
                    'rows' => 10
                )
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArtesanIO\MoocsyBundle\Entity\Modules'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'moocsy_modules_type';
    }
}
