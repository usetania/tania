<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('notes', TextareaType::class, array('required' => FALSE))
            ->add('category', ChoiceType::class, array(
                'choices' => array(
                    'Area' => 'area',
                    'Plant' => 'plant',
                    'Seed' => 'seed',
                    'Reservoir' => 'reservoir'
                )
            ))
            ->add('dueDate', DateTimeType::class, array(
                'years' => range(date('Y'), date('Y') + 1)
            ))
            ->add('urgencyLevel', ChoiceType::class, array(
                'choices' => array(
                    'Low' => 'low',
                    'Medium' => 'medium',
                    'High' => 'high'
                )
            ))
            ->add('isDone', ChoiceType::class, array(
                'choices' => array(
                    'No' => 0,
                    'Yes' => 1
                )
            ))
            ->add('save', SubmitType::class, array('label' => 'Save'));
    }
}
