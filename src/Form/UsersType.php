<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('userFirstname')
            ->add('userLastname')
            ->add('userMail')
            ->add('userPhone')
            ->add('username')
            ->add('password')
            ->add('role')
            ->add('lang1')
            ->add('lang2')
            ->add('lang3')
            ->add('cityname')
            ->add('nationality')
            ->add('langue')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
