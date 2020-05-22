<?php

namespace App\Form;

use App\Entity\Serie;
use App\Repository\PlatformRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class SerieType extends AbstractType
{
    private $platformRepository;

    public function __construct(platformRepository $platformRepository)
    {
        $platformRepository = $this->platformRepository;
    }

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
            ->add('platform', ChoiceType::class, [
                'label' => 'Plateforme',
                'placeholder' => 'sélectionnez',
                'choices' => [
                'Amazon Prime' => '1',
                'Canal+' => '2',
                'Netflix' => '3',
                ],
                'required' => true,
                ])
            // ->add('platform', null, [
            //     'expanded' => true,
            //     'multiple' => true,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
