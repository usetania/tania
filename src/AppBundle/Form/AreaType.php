<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AreaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('reservoir', EntityType::class, array(
                'class' => 'AppBundle:Reservoir',
                'choice_label' => 'name'
            ))
            ->add('growingMethod', ChoiceType::class, array(
                'choices' => array(
                    'Nutrient Film Technique' => 1,
                    'Drip Irrigation' => 2,
                    'Ebb and Flow' => 3,
                    'Organic (soil based)' => 4
                )
            ))
            ->add('capacity', IntegerType::class)
            ->add('measurementUnit', ChoiceType::class, array(
                'choices' => array(
                    'Pots/Points' => 1,
                    'Trays' => 2
                )
            ))
            ->add('photoUrl', FileType::class, array('required' => FALSE))
            ->add('save', SubmitType::class, array('label' => 'Add'));
    }
}
