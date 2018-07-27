<?php

namespace App\Form\Shared;

use App\Entity\Shared\CompanyHandshake;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyHandshakeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('accepted')
            ->add('acceptedAt')
            ->add('operatorCompany')
            ->add('consultantCompany')
            ->add('acceptedBy')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CompanyHandshake::class,
        ]);
    }
}
