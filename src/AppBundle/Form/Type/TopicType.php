<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

class TopicType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('city', 'entity', array(
                'class'=>'AppBundle:City',
                'choice_label' => 'name',
            ))
            ->add('picture')
            ->add('user', 'integer')
            ->add('createdAt', 'date')
            ->add('statusActive')
            //->add('like', 'integer')
//            ->add('tags', 'collection', array(
//                'type'         => new TagType(),
//                'allow_add'    => true,
//                'allow_delete' => true,
//                'by_reference' => false,
//                'options' => array('data_class' => 'AppBundle\Entity\Tag'),
//            ))
        ;
    }

    public function getName()
    {
        return 'topic';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Topic',
        ));
    }
}