<?php

namespace App\Form\Shared;

use App\Entity\Shared\GlobalWellAccessTable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GlobalWellAccessTableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('wellLicenceId')
            ->add('companyId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GlobalWellAccessTable::class,
        ]);
    }
}
