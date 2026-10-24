<?php

namespace App\Form;

use App\Entity\Localization;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocalizationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'attr' => [
                    'placeholder' => 'Enter city name',
                ],
            ])
            ->add('countryCode', ChoiceType::class, [
                'choices' => [
                    'Poland' => 'PL',
                    'United States' => 'US',
                    'United Kingdom' => 'UK',
                    'France' => 'FR',
                    'Germany' => 'DE',
                    'Spain' => 'ES',
                    'Italy' => 'IT',
                    'Lithuania' => 'LT',
                    'Hungary' => 'HU',
                    'Netherlands' => 'NL',
                ]
            ])
            ->add('latitude')
            ->add('longitude')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Localization::class,
        ]);
    }
}
