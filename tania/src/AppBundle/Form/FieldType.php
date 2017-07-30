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
                'attr' => array('maxlength' => 50), ))
            ->add('lat', NumberType::class, array('required' => false, 'scale' => 8))
            ->add('lng', NumberType::class, array('required' => false, 'scale' => 8))
            ->add('description', TextareaType::class, array('required' => false))
            ->add('imageFile', VichImageType::class, array(
                'required' => false,
                'allow_delete' => true,
                'image_uri' => true,
                'download_uri' => true,
            ))
            ->add('save', SubmitType::class, array('label' => 'Save'));
    }
}
