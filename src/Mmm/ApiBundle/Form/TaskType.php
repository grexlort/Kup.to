<?php

namespace Mmm\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TaskType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', 'text')
            ->add('dueDate', 'date')
            ->add('done', 'checkbox', array(
                'required' => false,
                'data' => false
            ))
            ->add('priority', 'checkbox', array(
                'required' => false,
                'data' => false
            ))
            ->add('assignee', 'entity', array(
                'class' => 'Mmm\ApiBundle\Entity\User',
                'property' => 'username'
            ))
            ->add('save', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mmm\ApiBundle\Entity\Task'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mmm_apibudle_task';
    }
}
