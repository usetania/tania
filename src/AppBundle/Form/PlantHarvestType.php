<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class PlantHarvestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('action', ChoiceType::class, array(
                'choices' => array('Harvest' => 'harvest', 'Dispose' => 'dispose'),
                'expanded' => true,
            ))
            ->add('note', TextareaType::class, array('required' => false))
            ->add('save', SubmitType::class, array('label' => 'Update'));
    }
}
