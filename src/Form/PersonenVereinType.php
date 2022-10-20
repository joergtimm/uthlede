<?php

namespace App\Form;

use App\Entity\Personen;
use App\Entity\PersVer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonenVereinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Art')
            ->add('rolle', ChoiceType::class, [
                'label' => 'Rolle',
                'choices' => [
                    'Vorstand' => 'Vorstand',
                    'Ansprechpartner' => 'Ansprechpartner',
                ]
            ])
            ->add('person', EntityType::class, [
                'class' => Personen::class,
                'label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersVer::class,
        ]);
    }
}
