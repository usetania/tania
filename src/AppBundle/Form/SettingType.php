<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SettingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mqttHost', TextType::class, array(
                'attr' => array('maxlength' => 200),
                'label' => 'MQTT Host',
                'translation_domain' => 'dashboard'
            ))
            ->add('mqttPort', TextType::class, array(
                'attr' => array('maxlength' => 200),
                'label' => 'MQTT Port',
                'translation_domain' => 'dashboard'
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Save',
                'translation_domain' => 'dashboard'
            ));
    }
}