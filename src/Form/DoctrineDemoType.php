<?php

namespace App\Form;

use App\Entity\DoctrineDemo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DoctrineDemoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choix = ['Madame'=>'Madame','Monsieur'=>'Monsieur'];
        $builder
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('message',TextareaType::class)
            ->add('civilite',ChoiceType::class,[
                'placeholder' => 'Votre Civilité',
                'choices' => $choix,
            ])
            ->add('date_naissance',BirthdayType ::class,[
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DoctrineDemo::class,
        ]);
    }
}
