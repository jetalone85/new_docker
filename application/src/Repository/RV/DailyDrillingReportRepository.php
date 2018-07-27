<?php

namespace App\Repository\RV;

use App\Entity\RV\DailyDrillingReport;
use App\Entity\RV\DrillingEvent;
use App\Entity\RV\Licence;
use Doctrine\ORM\EntityRepository;

/**
 * DailyDrillingReportRepository class.
 *
 * @package App\Repository\RV
 */
class DailyDrillingReportRepository extends EntityRepository
{

    /**
     * @param DrillingEvent $event
     * @return array|DailyDrillingReport[]
     */
    public function getReportsDates(DrillingEvent $event)
    {
        return $this
            ->createQueryBuilder('r')
            ->join('r.project', 'p')
            ->select('DATE_FORMAT(r.date, \'"%Y-%m-%d"\') as date')
            ->where('p.drillingEvent = :event')
            ->setParameter('event', $event->getId())
            ->getQuery()
            ->getScalarResult();
    }

    /**
     * @param Licence $licence
     * @return array|DailyDrillingReport[]
     */
    public function findByLicence(Licence $licence)
    {
        return $this->createQueryBuilder('r')
            ->innerJoin('r.project', 'p')
            ->innerJoin('p.drillingEvent', 'e')
            ->where('e.licence = :licence')
            ->setParameter('licence', $licence)
            ->orderBy('r.date', 'asc')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $report
     * @return DailyDrillingReport|null
     */
    public function getPrevious($report)
    {
        return $this
            ->createQueryBuilder('r')
            ->where('r.date < :date')
            ->andWhere('r.project = :project')
            ->setParameters(array('date' => $report->getDate(), 'project'=> $report->getProject())) 
            ->orderBy('r.date', 'desc')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param $report
     * @return DailyDrillingReport|null
     */
    public function getNext($report)
    {
        return $this
            ->createQueryBuilder('r')
            ->where('r.date > :date')
            ->andWhere('r.project = :project')
            ->setParameters(array('date' => $report->getDate(), 'project'=> $report->getProject()))
            ->orderBy('r.date', 'asc')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param $product
     * @return Collection|DailyDrillingReport[]
     */
    public function getProductSummary($project, $product)
    {
        return $this
            ->createQueryBuilder('r')
            ->select('r.id, DATE_FORMAT(r.date, \'%Y-%m-%d\') as date, COALESCE(SUM(mudUsages.received), 0) as received, COALESCE(SUM(mudUsages.used), 0) as used, COALESCE(SUM(mudUsages.balance), 0) as balance')
            ->leftJoin('r.mudUsages', 'mudUsages', 'WITH', 'mudUsages.product = :product')
            ->where('r.project = :project')
            ->setParameters([
                'project'   => $project->getId(),
                'product'   => $product->getId()
            ])
            ->groupBy('r.date')
            ->orderBy('r.date', 'desc')
            ->getQuery()
            ->getArrayResult()
        ;
    }
}
