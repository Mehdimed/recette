<?php

namespace App\Form;

use App\Entity\Aliment;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlimentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prix', IntegerType::class)
            ->add('calories', IntegerType::class)
            ->add('proteines', IntegerType::class)
            ->add('glucides', IntegerType::class)
            ->add('lipides', IntegerType::class)
            ->add('image', FileType::class)
            ->add('save', SubmitType::class, ['label' => 'Ajouter un Aliment'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Aliment::class,
        ]);
    }
}
