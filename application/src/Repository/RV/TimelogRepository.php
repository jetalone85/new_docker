<?php


namespace App\Repository\RV;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use App\Entity\RV\DailyDrillingReport;
use App\Entity\RV\Licence;
use App\Entity\RV\Project;
use App\Entity\RV\Timelog;

/**
 * @author Damian Wróblewski
 */
class TimelogRepository extends EntityRepository
{
    /**
     * @param Licence $licence
     * @return QueryBuilder
     */
    public function findByLicenceQueryBuilder(Licence $licence)
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.dailyReport', 'dr')
            ->innerJoin('dr.project', 'p')
            ->innerJoin('p.drillingEvent', 'ev')
            ->where('IDENTITY(ev.licence) = :licence')
            ->setParameter('licence', $licence);
    }

    /**
     * @param Licence $licence
     * @return array|Timelog[]
     */
    public function findByLicence(Licence $licence)
    {
        return $this->findByLicenceQueryBuilder($licence)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param Licence $licence
     * @return array|Timelog[]
     */
    public function findByLicenceOrdered(Licence $licence)
    {
        return $this->findByLicenceQueryBuilder($licence)
            ->addOrderBy('t.fromTime', 'asc')
            ->getQuery()
            ->getResult();
    }


    /**
     * @param Project $project
     * @return array|Timelog[]
     */
    public function findByProject(Project $project)
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.dailyReport', 'dr')
            ->where('IDENTITY(dr.project) = :project')
            ->setParameter('project', $project)
            ->addOrderBy('t.fromTime', 'asc')
            ->getQuery()
            ->getResult();
    }

    /**
     * find timelog which occurs as first before $report day
     * @param DailyDrillingReport $report
     * @param string $type FT|PT
     * @return  Timelog
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findPreviousTimelog(DailyDrillingReport $report, string $type)
    {
        $like = $type . '%';

        return $this->createQueryBuilder('t')
            ->innerJoin('t.dailyReport', 'dr')
            ->innerJoin('dr.project', 'p')
            ->innerJoin('p.drillingEvent', 'e')
            ->where('dr.date < :date')->setParameter('date', $report->getDate())
            ->andWhere('IDENTITY(e.licence) = :licence')->setParameter('licence', $report->getEvent()->getLicence())
            ->andWhere('t.binTime like :binLike')->setParameter('binLike', $like)
            ->orderBy('dr.date', 'desc')
            ->addOrderBy('t.toTime', 'desc')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
