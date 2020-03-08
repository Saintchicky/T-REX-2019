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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class FormulaireDemoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choix = ['Madame'=>'Madame','Monsieur'=>'Monsieur'];
        $builder
        // on met required à false pour pouvoir personnaliser le message du validator
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
                'format' => 'dd/MM/yyyy',
                'required' => false,
                // deuxième contrainte si la date n'est pas valide
                'invalid_message' => 'Date Invalide'
            ])
            ->add('couple', CheckboxType::class,
            ['mapped' => false,'required' => false]) // le camp n'existe pas ds la table
            // ->add('save', SubmitType::class, [
            //     'attr' => ['class' => 'ui button primary'],
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FormulaireDemo::class,
        ]);
    }
}
