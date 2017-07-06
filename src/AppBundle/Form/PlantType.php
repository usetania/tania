<?php
namespace AppBundle\Form;

use AppBundle\Data\CategoryMaster;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlantType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'entityManager' => null
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('area', EntityType::class, array(
                'class' => 'AppBundle:Area',
                'choice_label' => function($area) use($options) {
                    // measurement unit for area capacity
                    $unit = CategoryMaster::areaUnits()[$area->getMeasurementUnit()];

                    // capacity left
                    $areasInfo = $options['entityManager']->getRepository('AppBundle:Plant')->findBy(array('area' => $area->getId()));
                    $usedArea = array_reduce($areasInfo, function($carry, $item) {
                        return $carry += $item->getAreaCapacity();
                    });
                    $areaLeft = $area->getCapacity() - $usedArea;

                    return $area->getName() . " (Capacities: ". $areaLeft . " ". $unit . " remaining)";
                }
            ))
            ->add('seed', EntityType::class, array(
                'class' => 'AppBundle:Seed',
                'choice_label' => function($seed) use($options) {
                    // measurement unit for seed amount
                    $unit = CategoryMaster::seedUnits()[$seed->getMeasurementUnit()];

                    // seeds left
                    $seedsInfo = $options['entityManager']->getRepository('AppBundle:Plant')->findBy(array('seed' => $seed->getId()));
                    $usedSeed = array_reduce($seedsInfo, function($carry, $item) {
                        return $carry += $item->getSeedlingAmount();
                    });
                    $seedLeft = $seed->getQuantity() - $usedSeed;

                    return $seed->getName() . " (Quantities: ". $seedLeft . " " . $unit ." remaining)";
                }
            ))
            ->add('seedlingDate', DateType::class, array(
                'years' => range(date('Y'), date('Y') - 1)
            ))
            ->add('seedlingAmount', IntegerType::class)
            ->add('areaCapacity', IntegerType::class)
            ->add('save', SubmitType::class, array('label' => 'Add plant'));
    }
}
