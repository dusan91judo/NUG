<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;


class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('region', 'text')
//            ->add('topics', 'collection', array(
//                'type'         => new TopicType(),
//                'allow_add'    => true,
//                'allow_delete' => true,
//                'by_reference' => false,
//                'options' => array('data_class' => 'AppBundle\Entity\Topic'),
//            ))
        ;
    }

    public function getName()
    {
        return 'city';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\City',
        ));
    }
}