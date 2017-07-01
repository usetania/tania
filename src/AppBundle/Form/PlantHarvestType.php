<?php
namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PlantHarvestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('area', EntityType::class, array(
                'class' => 'AppBundle:Area',
                'choice_label' => function($area) {
                    // measurement unit for area capacity
                    if($area->getMeasurementUnit() == 1) {
                        $unit = "pots/points";
                    } else if($area->getMeasurementUnit() == 2) {
                        $unit = "trays";
                    }
                    return $area->getName() . " (Capacities: ". $area->getCapacity() . " ". $unit . ")";
                }
            ))
            ->add('seed', EntityType::class, array(
                'class' => 'AppBundle:Seed',
                'choice_label' => function($seed) {
                    // measurement unit for seed amount
                    if($seed->getMeasurementUnit() == 1) {
                        $unit = 'seeds';
                    } else if($seed->getMeasurementUnit() == 2) {
                        $unit = 'gr';
                    } else if($seed->getMeasurementUnit() == 3) {
                        $unit = 'kg';
                    } else if($seed->getMeasurementUnit() == 4) {
                        $unit = 'lbs';
                    } else if($seed->getMeasurementUnit() == 5) {
                        $unit = 'oz';
                    }

                    return $seed->getName() . " (Quantities: ". $seed->getQuantity() . " " . $unit .")";
                }
            ))
            ->add('seedlingDate', DateType::class)
            ->add('seedlingAmount', IntegerType::class)
            ->add('areaCapacity', IntegerType::class)
            ->add('save', SubmitType::class, array('label' => 'Update'));
    }
}
