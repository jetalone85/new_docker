<?php

namespace App\Repository\RV;

use Doctrine\ORM\EntityRepository;
use App\Entity\RV\Project;

/**
 * DrillingIntervalRepository class.
 *
 * @package App\Repository\RV
 */
class DrillingIntervalRepository extends EntityRepository
{
    const ALIAS = 'di';

    public function deleteByProject(Project $project)
    {
        return $this->createQueryBuilder(self::ALIAS)
            ->delete()
            ->where(sprintf('%s.project = :project', self::ALIAS))
            ->setParameter('project', $project)
            ->getQuery()
            ->execute();
    }
}
