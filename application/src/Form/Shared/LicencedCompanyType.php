<?php

namespace App\Form\Shared;

use App\Entity\Shared\LicencedCompany;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LicencedCompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('baCode')
            ->add('licence')
            ->add('abbreviation')
            ->add('address')
            ->add('phone')
            ->add('agentName')
            ->add('code')
            ->add('company')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LicencedCompany::class,
        ]);
    }
}
