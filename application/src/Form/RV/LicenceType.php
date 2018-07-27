<?php

namespace App\Form\RV;

use App\Entity\RV\Licence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LicenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('licenceNo')
            ->add('surfaceLocation')
            ->add('wellName')
            ->add('laheeClass')
            ->add('drillingOperation')
            ->add('strike')
            ->add('wellPurpose')
            ->add('mineralRights')
            ->add('wellType')
            ->add('groundElevation')
            ->add('substance')
            ->add('spudDate')
            ->add('rigRelease')
            ->add('finishedDrillingDate')
            ->add('ground')
            ->add('cutOrFill')
            ->add('kbGround')
            ->add('afeId')
            ->add('afeEstimate')
            ->add('totalCost')
            ->add('firstDailyReportDate')
            ->add('lastDailyReportDate')
            ->add('deleted')
            ->add('deletedAt')
            ->add('jurisdiction')
            ->add('terminatingZone')
            ->add('latitudeUtm')
            ->add('longitudeUtm')
            ->add('casingBowl')
            ->add('operator')
            ->add('prognosis')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Licence::class,
        ]);
    }
}
