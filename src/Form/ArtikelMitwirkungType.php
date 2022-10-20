<?php

namespace App\Form;

use App\Entity\ArtikelMitwirkungen;
use App\Entity\Personen;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtikelMitwirkungType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('art', ChoiceType::class, [
                'label' => 'Art',
                'choices' => [
                    'Author' => 'Author',
                    'Moderator' => 'Moderator',
                    'Fotograf' => 'Fotograf'
                ]
            ])
            ->add('person', EntityType::class, [
                'class' => Personen::class,
                'choice_label' => 'name'
            ])
            ->add('artikel', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ArtikelMitwirkungen::class,
        ]);
    }
}
