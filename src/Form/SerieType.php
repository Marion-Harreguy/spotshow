<?php

namespace App\Form;

use App\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'constraints' => [new NotBlank(), new NotNull()]
            ])
            ->add('type', ChoiceType::class, [
                'placeholder' => 'sélectionnez',
                'choices' => [
                    'série' => 'serie',
                    'film' => 'film'
                ],
                'required' => true,
            ])
            ->add('genre', ChoiceType::class, [
                'placeholder' => 'sélectionnez',
                'choices'  => [
                    'action' => 'action',
                    'aventure' => 'aventure',
                    'comédie' => 'comédie',
                    'documentaire' => 'documentaire',
                    'drame' => 'drame',
                    'espionnage'=> 'espionnage',
                    'fantastique' => 'fantastique',
                    'guerre' => 'guerre',
                    'horreur' => 'horreur',
                    'musical' => 'musical',
                    'policier' => 'policier',
                    'science-fiction' => 'science-fiction',
                    'sketch' => 'sketch',
                    'thriller' => 'thriller',
                    'western' => 'western',
                ],
                'required' => true,
            ])
            ->add('rate')
            // ->add('createdAt')
            // ->add('updatedAt')
            // ->add('platform')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
