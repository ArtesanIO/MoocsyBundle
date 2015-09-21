<?php

namespace ArtesanIO\MoocsyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ArtesanIO\MoocsyBundle\Model\TemporalityManager as Temporality;
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
            ->add('enabled')
            ->add('published','date', array(
                'placeholder' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
            ))
            ->add('temporality','choice', array(
                'choices' => $this->temporality->getTemporality(),
                'empty_value' => '--Seleccione--',
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
