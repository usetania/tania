<?php
namespace AppBundle\Form;

use AppBundle\Data\CountryList;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class SeedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Reformat the array of country. The format is ["Indonesia"] => "Indonesia".
        // We don't need the country code.
        $countryArray = array_reduce(CountryList::name(), function($result, $item) {
            $result[$item] = $item;
            return $result;
        }, array());

        // Generate 5 years from the current year
        $years = range(date('Y'), date('Y') + 5);
        $yearChoice = array_reduce($years, function($result, $item) {
            $result[$item] = $item;
            return $result;
        }, array());

        $builder
            ->add('name', TextType::class)
            ->add('seedCategory', EntityType::class, array(
                'class' => 'AppBundle:SeedCategory',
                'choice_label' => 'name'
            ))
            ->add('quantity', IntegerType::class)
            ->add('measurementUnit', ChoiceType::class, array(
                'choices' => array(
                    'Seeds' => 1,
                    'Gramme' => 2,
                    'Kilogramme' => 3,
                    'Lbs' => 4,
                    'Oz' => 5
                )
            ))
            ->add('producerName', TextType::class)
            ->add('originCountry', ChoiceType::class, array(
                'choices' => $countryArray
            ))
            ->add('note', TextareaType::class, array('required' => FALSE))
            ->add('expirationMonth', ChoiceType::class, array(
                'choices' => array(
                    'January' => 'January',
                    'February' => 'February',
                    'March' => 'March',
                    'April' => 'April',
                    'May' => 'May',
                    'June' => 'June',
                    'July' => 'July',
                    'August' => 'August',
                    'September' => 'September',
                    'October' => 'October',
                    'November' => 'November',
                    'December' => 'December'
                )
            ))
            ->add('expirationYear', ChoiceType::class, array(
                'choices' => $yearChoice
            ))
            ->add('germinationRate', NumberType::class, array('scale' => 2))
            ->add('imageFile', VichImageType::class, array(
                'required' => FALSE,
                'allow_delete' => TRUE,
                'image_uri' => TRUE,
                'download_uri' => TRUE
            ))
            ->add('save', SubmitType::class, array('label' => 'Save'));
    }
}