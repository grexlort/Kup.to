<?php

namespace Mmm\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlaceType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name')
            ->add('color', 'choice', array(
                'choices' => array('red' => 'red', 'blue' => 'blue')
            ))
            ->add('save', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Mmm\ApiBundle\Entity\Place'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'mmm_apibundle_place';
    }

}
