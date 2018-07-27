<?php

namespace App\Repository\RV;

use App\Entity\RV\Licence;

class DrillingEventRepository extends \Doctrine\ORM\EntityRepository
{
    public function getFirstDrillingEventWithLicence(Licence $licence)
    {
        $records = $this->createQueryBuilder('d')
            ->andWhere('d.licence = :licence')
            ->orderBy('d.id')
            ->setParameter('licence', $licence)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;

        return ($records) ? $records[0] : false;
    }
}
