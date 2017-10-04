<?php
namespace AppBundle\Form;

use AppBundle\Data\CategoryMaster;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class DeviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'attr' => array('maxlength' => 50),
                'label' => 'Name',
                'translation_domain' => 'dashboard'
            ))
            ->add('description', TextareaType::class, array(
                'required' => false,
                'label' => 'Description',
                'translation_domain' => 'dashboard'
            ))
            ->add('deviceType', ChoiceType::class, array(
                'choices' => array(
                    CategoryMaster::deviceType()[1] => 1,
                    CategoryMaster::deviceType()[2] => 2,
                    CategoryMaster::deviceType()[3] => 3,
                    CategoryMaster::deviceType()[4] => 4
                ),
                'label' => 'Device type',
                'required' => true,
                'translation_domain' => 'dashboard'
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Add Device',
                'translation_domain' => 'dashboard'
            ));
    }
}