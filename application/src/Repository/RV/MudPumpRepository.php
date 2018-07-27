<?php


namespace App\Repository\RV;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use App\Entity\RV\Licence;

/**
 * @author Damian Wróblewski
 */
class MudPumpRepository extends EntityRepository
{
    public function getNextPumpNo(Licence $licence)
    {
        try {
            return $this->createQueryBuilder('mp')
                    ->select('MAX(mp.pumpNo)')
                    ->where('IDENTITY(mp.licence) = :licence')
                    ->setParameter('licence', $licence)
                    ->getQuery()
                    ->getSingleScalarResult() + 1;
        } catch (NoResultException $e) {
            return 1;
        }
    }
}
