<?php

namespace App\Repository\RV;

use Doctrine\ORM\EntityRepository;
use App\Entity\RV\DeviationSurvey;
use App\Entity\RV\Licence;
use App\Entity\RV\Project;

/**
 * DeviationSurveyRepository class.
 *
 * @package App\Repository\RV
 * @author Damian Wróblewski
 */
class DeviationSurveyRepository extends EntityRepository
{

    /**
     * @param Licence $licence
     * @return array|DeviationSurvey[]
     */
    public function findByLicence(Licence $licence)
    {
        return $this->createQueryBuilder('dvs')
            ->innerJoin('dvs.dailyReport', 'dr')
            ->innerJoin('dr.event', 'ev')
            ->where('IDENTITY(ev.licence) = :licence')->setParameter('licence', $licence)
            ->orderBy('dvs.depth')
            ->getQuery()->getResult();
    }

    /**
     * @param Project $project
     * @return array|DeviationSurvey[]
     */
    public function findByProject(Project $project)
    {
        return $this->createQueryBuilder('dvs')
            ->innerJoin('dvs.dailyReport', 'dr')
            ->where('IDENTITY(dr.project) = :project')
            ->setParameter('project', $project)
            ->orderBy('dvs.depth')
            ->getQuery()->getResult();
    }
}
