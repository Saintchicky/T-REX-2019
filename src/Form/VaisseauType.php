<?php

namespace App\Form;

use App\Entity\Vaisseau;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VaisseauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $choix = [];
        for($i = 1; $i <= 10; $i++){
            $choix[$i] = $i;
        }
        // Après la génération, bien définir le type de champ en utilsant les class composant ex:IntegerType, ChoiceType
        $builder
            ->add('a', ChoiceType::class,
            [
                'placeholder' => 'Chosir un nombre',
                'choices' => $choix,
                'required' => true
            ])
            ->add('b', ChoiceType::class,
            [
                'placeholder' => 'Chosir un nombre',
                'choices' => $choix,
                'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vaisseau::class,
        ]);
    }
}
