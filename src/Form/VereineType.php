<?php

namespace App\Form;

use App\Entity\Vereine;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class VereineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $imageConstrains = [
            new Image([
                'maxSize' => '12M',
            ]),
        ];

        $builder
            ->add('titel')
            ->add('aktiv')
            ->add('beschreibung', CKEditorType::class)
            ->add('logo', FileType::class, [
                'label' => 'Vereins-Logo',
                'mapped' => false,
                'required' => false,
                'constraints' => $imageConstrains,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vereine::class,
        ]);
    }
}
