<?php

namespace App\Form;

use App\Entity\FormulaireDemo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FormulaireDemoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choix = ['Madame'=>'Madame','Monsieur'=>'Monsieur'];
        $builder
            ->add('nom',TextType::class,['required' => false])
            ->add('prenom',TextType::class,['required' => false])
            ->add('message',TextareaType::class,['required' => false])
            ->add('civilite',ChoiceType::class,[
                'placeholder' => 'Votre Civilité',
                'choices' => $choix,
                'required' => false
            ])
            ->add('dateNaissance',BirthdayType ::class,[
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FormulaireDemo::class,
        ]);
    }
}
