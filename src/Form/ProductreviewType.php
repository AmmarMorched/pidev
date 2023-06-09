<?php

namespace App\Form;

use App\Entity\Productreview;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductreviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reviewId')
            ->add('productName')
            ->add('rating')
            ->add('reviewTxt')
            ->add('idProduct')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Productreview::class,
        ]);
    }
}
