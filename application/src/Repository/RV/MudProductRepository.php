<?php

namespace App\Repository\RV;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityRepository;
use App\Entity\RV\AfeCostReport;
use App\Entity\RV\MudProduct;
use App\Entity\RV\MudUsage;

/**
 * Class MudProductRepository
 * @package App\Repository\RV
 */
class MudProductRepository extends EntityRepository
{
    /**
     * @param $project
     * @return Collection|MudProduct[]
     */
    public function getSummary($project)
    {
        return $this
            ->createQueryBuilder('mp')
            ->select('mp.id, mp.name, mp.cost, COALESCE(SUM(mudUsages.used), 0) as used, (mp.cost * COALESCE(SUM(mudUsages.used), 0)) as costs')
            ->leftJoin('mp.mudUsages', 'mudUsages')
            ->where('mp.project = :project')
            ->setParameter('project', $project->getId())
            ->groupBy('mp.name')
            ->getQuery()
            ->getArrayResult()
        ;
    }

    /**
     * @param AfeCostReport $afeCostReport
     * @return Collection|MudProduct[]
     */
    public function getTotalCostByAfeCostReport(AfeCostReport $afeCostReport)
    {
        $costs = $this->createQueryBuilder('mp')
            ->select('(mp.cost * COALESCE(SUM(mudUsages.used), 0)) as costs')
            ->leftJoin('mp.mudUsages', 'mudUsages')
            ->where('mp.afeCostReport = :afeCostReport')
            ->setParameter('afeCostReport', $afeCostReport)
            ->groupBy('mp.afeCostReport')
            ->getQuery()
            ->getOneOrNullResult();

        return isset($costs[0]['costs']) ? $costs[0]['costs'] : 0;
    }

    /**
     * @param $report
     * @return Collection|MudProduct[]
     */
    public function getProductsByReport($report)
    {
        $qb = $this->createQueryBuilder('mp')
            ->select()
            ->setParameter('report', $report->getId())
        ;

        $subQb = $this->createQueryBuilder('pr')
            ->select('pr.id')
            ->join(MudUsage::class, 'mu')
            ->where('mu.product = pr.id')
            ->andWhere('mu.report = :report')
        ;

        $qb->andWhere($qb->expr()->notIn('mp.id', $subQb->getDQL()));

        return $qb;
    }
}
