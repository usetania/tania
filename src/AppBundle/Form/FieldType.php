<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

class FieldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'attr' => array('maxlength' => 50),
                'label' => 'Name',
                'translation_domain' => 'dashboard'))
            ->add('lat', NumberType::class, array(
                'required' => false,
                'scale' => 8,
                'label' => 'Latitude',
                'translation_domain' => 'dashboard'))
            ->add('lng', NumberType::class, array(
                'required' => false, 
                'scale' => 8,
                'label' => 'Longitude',
                'translation_domain' => 'dashboard'))
            ->add('description', TextareaType::class, array(
                'required' => false,
                'label' => 'Description',
                'translation_domain' => 'dashboard'))
            ->add('imageFile', VichImageType::class, array(
                'required' => false,
                'allow_delete' => true,
                'image_uri' => true,
                'download_uri' => true,
                'label' => 'Image file',
                'translation_domain' => 'dashboard'
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Save',
                'translation_domain' => 'dashboard'));
    }
}
