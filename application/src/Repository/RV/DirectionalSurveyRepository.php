<?php

namespace App\Repository\RV;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use App\Entity\RV\DirectionalSurvey;
use App\Entity\RV\Licence;

/**
 * AfeCostReportRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DirectionalSurveyRepository extends EntityRepository
{
    /**
     * finds all directional surveys which have MD higher then given survey
     * @param Licence $licence
     * @return DirectionalSurvey[]
     */
    public function findByLicence(Licence $licence)
    {
        return $this->createQueryBuilder('s')
            ->innerJoin('s.project', 'p')
            ->innerJoin('p.drillingEvent', 'e')
            ->where('e.licence = :licence')->setParameter('licence', $licence)
            ->orderBy('s.measuredDepth')
            ->getQuery()
            ->getResult();
    }

    /**
     * finds all directional surveys which have MD higher then given survey
     * @param DirectionalSurvey $survey
     * @return DirectionalSurvey[]
     */
    public function findAllNext(DirectionalSurvey $survey)
    {
        return $this->createQueryBuilder('s')
            ->innerJoin('s.project', 'p')
            ->innerJoin('p.drillingEvent', 'e')
            ->where('e.licence = :licence')
            ->setParameter('licence', $survey->getEvent()->getLicence())
            ->andWhere('s.measuredDepth > :measuredDepth')
            ->setParameter('measuredDepth', $survey->getMeasuredDepth())
            ->orderBy('s.measuredDepth')
            ->getQuery()
            ->getResult();
    }

    /**
     * finds previous directional survey basing on MD
     * @param DirectionalSurvey $survey
     * @return DirectionalSurvey
     */
    public function findPrev(DirectionalSurvey $survey)
    {
        try {
            return $this->createQueryBuilder('s')
                ->innerJoin('s.project', 'p')
                ->innerJoin('p.drillingEvent', 'e')
                ->where('e.licence = :report')
                ->setParameter('report', $survey->getEvent()->getLicence())
                ->andWhere('s.measuredDepth < :measuredDepth')
                ->setParameter('measuredDepth', $survey->getMeasuredDepth())
                ->orderBy('s.measuredDepth', 'desc')
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null; // this will never happen
        }
    }
}
