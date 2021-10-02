<?php

namespace App\Form;

use App\Entity\Articel;
use App\Entity\Themen;
use App\Entity\User;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\UX\Dropzone\Form\DropzoneType;

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
            ->add('haupttext', CKEditorType::class)
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
            ->add('author', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username'
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
