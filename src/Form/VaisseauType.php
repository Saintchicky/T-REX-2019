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
        // Après la génération bien définir le type de champ en utilsant les class composant ex:IntegerType
        $builder
            ->add('a', ChoiceType::class,
            ['a'=>['1'=>'1','2'=>'2']])
            ->add('b', ChoiceType::class,
            ['b'=>['1'=>'1','2'=>'2']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vaisseau::class,
        ]);
    }
}
