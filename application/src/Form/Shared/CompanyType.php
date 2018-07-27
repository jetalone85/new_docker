<?php

namespace App\Form\Shared;

use App\Entity\Shared\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('logo')
            ->add('type')
            ->add('name')
            ->add('stripeId')
            ->add('baCode')
            ->add('deleted')
            ->add('licencedCompany')
            ->add('services')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
