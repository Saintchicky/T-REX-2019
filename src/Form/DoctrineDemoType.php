<?php

namespace App\Form;

use App\Entity\DoctrineDemo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DoctrineDemoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('message',TextareaType::class)
            ->add('civilite',TextareaType::class,[
                'placeholder' => 'Votre civilité',
                'choices' => ['Madame','Monsieur'],
            ])
            ->add('date_naissance',TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DoctrineDemo::class,
        ]);
    }
}
