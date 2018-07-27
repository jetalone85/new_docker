<?php

namespace App\Repository\RV;

use Doctrine\ORM\EntityRepository;
use App\Entity\RV\AfeCostReport;

/**
 * Class DailyDrillingCostDetailsRepository
 * @package App\Repository\RV
 */
class DailyDrillingCostDetailsRepository extends EntityRepository
{
    const ALIAS = 'ddcd';

    public function getTotalAmountByAfeCostReport(AfeCostReport $afeCostReport)
    {
        return $this->createQueryBuilder(self::ALIAS)
            ->select(sprintf('SUM(%s.amountExcludedTax) as amount', self::ALIAS))
            ->where(sprintf('%s.afeCostReport = :report', self::ALIAS))
            ->setParameter('report', $afeCostReport)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
