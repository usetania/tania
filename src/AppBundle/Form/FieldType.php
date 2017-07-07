<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class FieldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'attr' => array('maxlength' => 50)))
            ->add('lat', NumberType::class, array('required' => FALSE, 'scale' => 8))
            ->add('lng', NumberType::class, array('required' => FALSE, 'scale' => 8))
            ->add('description', TextareaType::class, array('required' => FALSE))
            ->add('imageFile', VichImageType::class, array(
                'required' => FALSE,
                'allow_delete' => TRUE,
                'image_uri' => TRUE,
                'download_uri' => TRUE
            ))
            ->add('save', SubmitType::class, array('label' => 'Save'));
    }
}
