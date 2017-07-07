<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReservoirType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('field', EntityType::class, array(
                'class' => 'AppBundle:Field',
                'choice_label' => 'name'
            ))
            ->add('capacity', NumberType::class, array('scale' => 2))
            ->add('measurementUnit', ChoiceType::class, array(
                'choices' => array(
                    'Litre' => 1,
                    'Gallon' => 2
                )
            ))
            ->add('save', SubmitType::class, array('label' => 'Save'));
    }
}
