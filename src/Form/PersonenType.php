<?php

namespace App\Form;

use App\Entity\Personen;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class PersonenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $imageConstrains = [
            new Image([
                'maxSize' => '12M',
            ]),
        ];

        $builder
            ->add('name')
            ->add('vorname')
            ->add('adresse')
            ->add('kontakt')
            ->add('beschreibung')
            ->add('foto', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => $imageConstrains,
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personen::class,
        ]);
    }
}
