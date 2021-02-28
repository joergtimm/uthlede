<?php

namespace App\Form;

use App\Entity\Articel;
use App\Entity\Themen;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class ArtikelFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $imageConstrains = [
            new Image([
                'maxSize' => '12M',
            ]),
        ];
        $builder
            ->add('titel')
            ->add('kurztext', TextareaType::class, [
                'attr' => ['rows' => 6]
            ])
            ->add('haupttext', TextareaType::class, [
                'attr' => ['rows' => 9]
            ])
            ->add('bild', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => $imageConstrains,
            ])
            ->add('thema', EntityType::class, [
                'class' => Themen::class,
                'choice_label' => 'titel',
                'label' => 'Thema',
                'placeholder' => 'Wähen sie ein Thema aus'

            ])
            ->add('datum', DateType::class, [
                'widget' => 'single_text',
                'placeholder' => 'Bitte ein Bild auswählen',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articel::class,
        ]);
    }
}
