<?php

namespace Mmm\FrontendBundle\Form;

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
            ->add('done', 'checkbox')
            ->add('priority', 'checkbox')
            ->add('createdAt', 'date')
            ->add('createdBy', 'entity', array(
                'class' => 'Mmm\FrontendBundle\Entity\User',
                'property' => 'name'
            ))
            ->add('assignee', 'entity', array(
                'class' => 'Mmm\FrontendBundle\Entity\User',
                'property' => 'name'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mmm\FrontendBundle\Entity\Task'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mmm_frontendbundle_task';
    }
}
