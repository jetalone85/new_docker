<?php


namespace App\Repository\RV;

use Doctrine\ORM\EntityRepository;
use App\Entity\RV\Licence;
use App\Entity\User;

/**
 * @author Damian Wróblewski
 */
class LicenceRepository extends EntityRepository
{
    public function findByUserAccess(User $user)
    {
        $company = $user->getCompany();
        $orX = $this->getEntityManager()->getExpressionBuilder()->orX();
        $orX
            ->add('l.operator = :company')
            ->add('IDENTITY(a.company) = :company');

        return $this->createQueryBuilder('l')
            ->leftJoin('l.drillingEvents', 'e')
            ->leftJoin('e.projects', 'p')
            ->leftJoin('p.access', 'a')
            ->where($orX)
            ->andWhere('l.deleted is null')
            ->setParameter('company', $company)
            ->getQuery()
            ->getResult();
    }
}
