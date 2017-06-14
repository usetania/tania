<?php
namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PlantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('area', EntityType::class, array(
                'class' => 'AppBundle:Area',
                'choice_label' => 'name'
            ))
            ->add('seed', EntityType::class, array(
                'class' => 'AppBundle:Seed',
                'choice_label' => 'name'
            ))
            ->add('seedlingDate', DateTimeType::class)
            ->add('seedlingAmount', IntegerType::class)
            ->add('save', SubmitType::class, array('label' => 'Add plant'));
    }
}
