<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('roles', ChoiceType::class, array(
                    'label'    => 'User Roles',
                    'attr'  =>  array('class' => 'form-switch'),
                    'choices' => [
                        'Super Admin' => 'ROLE_SUPER_ADMIN',
                        'Admin' => 'ROLE_ADMIN',
                        'Moderator' => 'ROLE_MODERATOR',
                        'Author' => 'ROLE_AUTHOR',
                        'Fotograf' => 'ROLE_FOTOGRAF',
                        'User' => 'ROLE_USER',
                    ],
                    'expanded' => true,
                    'multiple' => true,
                )
            )
            ->add('plainPassword', null, [
                'mapped' => false,
            ])
            ->add('email')
            ->add('isVerified')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
