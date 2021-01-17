<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prix', CheckboxType::class, [
                'required' => false,
            ])
            ->add('calories', RangeType::class, [
                'attr' => [
                    'min' => 20,
                    'max' => 200
                ]
            ])
            ->add('proteines', RangeType::class, [
                'attr' => [
                    'min' => 20,
                    'max' => 200
                ]
            ])
            ->add('glucides', RangeType::class, [
                'attr' => [
                    'min' => 20,
                    'max' => 200
                ]
            ])
            ->add('lipides', RangeType::class, [
                'attr' => [
                    'min' => 20,
                    'max' => 200
                ]
            ])
            ->add('chercher', SubmitType::class,['label' => 'Chercher']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        
    }
}
