<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class AreaDeviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('area', EntityType::class, array(
                'class' => 'AppBundle:Area',
                'choice_label' => 'name',
                'required' => true,
                'label' => 'Area Name',
                'translation_domain' => 'dashboard'
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Add Area',
                'translation_domain' => 'dashboard'
            ));
    }
}