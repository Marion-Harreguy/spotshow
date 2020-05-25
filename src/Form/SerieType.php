<?php

namespace App\Form;

use App\Entity\Serie;
use App\Form\PlatformType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'constraints' => [
                    new NotBlank(),
                    new NotNull(),
                ]])
            ->add('type', ChoiceType::class, [
                'label' => 'Type',
                'placeholder' => 'sélectionnez',
                'choices' => [
                    'Série' => 'Serie',
                    'Film' => 'Film'
                ],
                'required' => true,
            ])
            ->add('genre', ChoiceType::class, [
                'label' => 'Genre',
                'placeholder' => 'sélectionnez',
                'choices'  => [
                    'Action' => 'Action',
                    'Aventure' => 'Aventure',
                    'Comédie' => 'Comédie',
                    'Documentaire' => 'Documentaire',
                    'Drame' => 'Drame',
                    'Espionnage'=> 'Espionnage',
                    'Fantastique' => 'Fantastique',
                    'Guerre' => 'Guerre',
                    'Horreur' => 'Horreur',
                    'Musical' => 'Musical',
                    'Policier' => 'Policier',
                    'Science-fiction' => 'Science-fiction',
                    'Sketch' => 'Sketch',
                    'Thriller' => 'Thriller',
                    'Western' => 'Western',
                ],
                'required' => true,
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Synopsis',
                'constraints' =>  [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le synopsis était vraiment aussi flop que ça...?'
                    ])
                ]
            ])
            ->add('rate', ChoiceType::class, [
                'label' => 'Note',
                'placeholder' => 'sélectionnez',
                'choices' => [
                    'Top' => 'Top',
                    'Flop' => 'Flop'
                ],
                'required' => true,
            ])
            // ->add('createdAt')
            // ->add('updatedAt')
            /*->add('platform', ChoiceType::class, [
                'label' => 'Plateforme',
                'placeholder' => 'sélectionnez',
                'choices' => [
                '1' => 'Amazon Prime',
                'Canal+' => '2',
                'Netflix' => '3',
                ],
                'required' => true,
                ])*/
            ->add('platform', PlatformType::class, [
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
