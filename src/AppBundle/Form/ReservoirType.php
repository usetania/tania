<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ReservoirType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Name',
                'translation_domain' => 'dashboard'
            ))
            ->add('field', EntityType::class, array(
                'class' => 'AppBundle:Field',
                'choice_label' => 'name',
                'label' => 'Field',
                'translation_domain' => 'dashboard'
            ))
            ->add('capacity', NumberType::class, array(
                'scale' => 2,
                'label' => 'Capacity',
                'translation_domain' => 'dashboard'
            ))
            ->add('measurementUnit', ChoiceType::class, array(
                'choices' => array(
                    'Litre' => 1,
                    'Gallon' => 2,
                ),
                'label' => 'Measurement unit',
                'translation_domain' => 'dashboard'
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Save',
                'translation_domain' => 'dashboard'
            ));
    }
}
