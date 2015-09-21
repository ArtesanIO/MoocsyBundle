<?php

namespace ArtesanIO\MoocsyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionsOptionsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('options','collection', array(
                'type' => new OptionsType(),
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArtesanIO\MoocsyBundle\Entity\Questions'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'moocsy_questions_options_type';
    }
}
