<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ResourceDeviceType extends AbstractType
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
            ->add('rid', TextType::class, array(
                'attr' => array('maxlength' => 50),
                'label' => 'Resource ID',
                'translation_domain' => 'dashboard'
            ))
            ->add('resource', EntityType::class, array(
                'class' => 'AppBundle:Resource',
                'choice_label' => 'type',
                'required' => true,
                'label' => 'Resource Type',
                'translation_domain' => 'dashboard'
            ))
            ->add('dataType', ChoiceType::class, array(
                'choices' => array(
                    'Float' => 'Float',
                    'Integer' => 'Integer',
                    'Boolean' => 'Boolean',
                    'String' => 'String'
                ),
                'label' => 'Data Type',
                'translation_domain' => 'dashboard'
            ))
            ->add('unit', ChoiceType::class, array(
                'choices' => array(
                    'Celcius' => 'Celcius',
                    'Fahrenheit' => 'Fahrenheit',
                    'uS/cm' => 'uS/cm',
                    'Lux' => 'Lux',
                    '%' => '%',
                    'None' => 'None'
                ),
                'label' => 'Unit',
                'translation_domain' => 'dashboard'
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Add Resource',
                'translation_domain' => 'dashboard'
            ));
    }
}