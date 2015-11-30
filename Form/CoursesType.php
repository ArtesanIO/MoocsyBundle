<?php

namespace ArtesanIO\MoocsyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ArtesanIO\MoocsyBundle\Model\TemporalityManager as Temporality;

use ArtesanIO\ArtesanusBundle\Entity\Files;

class CoursesType extends AbstractType
{
    protected $temporality;

    public function __construct(Temporality $temporality)
    {
        $this->temporality = $temporality;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('course')
            ->add('cover','entity', array(
                'class' => 'ArtesanusBundle:Files',
                'property' => 'name',
                'empty_value' => '--Seleccione--'
            ))
            ->add('certificate','entity', array(
                'class' => 'ArtesanusBundle:Files',
                'property' => 'name',
                'empty_value' => '--Seleccione--'
            ))
            ->add('sku')
            ->add('enabled')
            ->add('published','date', array(
                'placeholder' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
            ))
            ->add('temporality','choice', array(
                'choices' => $this->temporality->getTemporality(),
                'empty_value' => '--Seleccione--',
            ))
            ->add('header','text', array(
                'required' => false
            ))
            ->add('title','text', array(
                'required' => false
            ))
            ->add('description')

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArtesanIO\MoocsyBundle\Entity\Courses'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'moocsy_courses_type';
    }
}
