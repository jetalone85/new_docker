<?php


namespace App\Repository\RV;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use App\Entity\RV\Licence;

/**
 * @author Damian Wróblewski
 */
class BitRepository extends EntityRepository
{
    public function getNextBitNo(Licence $licence)
    {
        try {
            return $this->createQueryBuilder('b')
                    ->select('MAX(b.bitNo)')
                    ->where('IDENTITY(b.licence) = :licence')
                    ->setParameter('licence', $licence)
                    ->getQuery()
                    ->getSingleScalarResult() + 1;
        } catch (NoResultException $e) {
            return 1;
        }
    }
}
