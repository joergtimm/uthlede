<?php

namespace App\Form;

use App\Entity\Tankstellen;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TankstellenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tid')
            ->add('name')
            ->add('brand')
            ->add('street')
            ->add('place')
            ->add('lat')
            ->add('lng')
            ->add('diesel')
            ->add('e5')
            ->add('e10')
            ->add('isOpen')
            ->add('houseNumber')
            ->add('postCode')
            ->add('updateAt')
            ->add('openingTimes')
            ->add('overrides')
            ->add('wholeDay')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tankstellen::class,
        ]);
    }
}
