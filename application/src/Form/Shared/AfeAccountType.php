<?php

namespace App\Form\Shared;

use App\Entity\Shared\AfeAccount;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AfeAccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('number')
            ->add('description')
            ->add('projectType')
            ->add('company')
            ->add('createdBy')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AfeAccount::class,
        ]);
    }
}
