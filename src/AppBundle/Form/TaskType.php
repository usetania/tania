<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Name',
                'translation_domain' => 'dashboard'
            ))
            ->add('notes', TextareaType::class, array(
                'required' => false,
                'label' => 'Note',
                'translation_domain' => 'dashboard'
            ))
            ->add('category', ChoiceType::class, array(
                'choices' => array(
                    'Area' => 'area',
                    'Plant' => 'plant',
                    'Seed' => 'seed',
                    'Reservoir' => 'reservoir',
                ),
                'label' => 'Category',
                'translation_domain' => 'dashboard'
            ))
            ->add('dueDate', DateTimeType::class, array(
                'years' => range(date('Y'), date('Y') + 1),
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd hh:mm',
                'label' => 'Due date',
                'translation_domain' => 'dashboard'
            ))
            ->add('urgencyLevel', ChoiceType::class, array(
                'choices' => array(
                    'Low' => 'low',
                    'Medium' => 'medium',
                    'High' => 'high',
                ),
                'label' => 'Level of urgency',
                'translation_domain' => 'dashboard'
            ))
            ->add('isDone', ChoiceType::class, array(
                'choices' => array(
                    'No' => 0,
                    'Yes' => 1,
                ),
                'label' => 'Is it done?',
                'translation_domain' => 'dashboard'
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Save',
                'translation_domain' => 'dashboard'
            ));
    }
}
