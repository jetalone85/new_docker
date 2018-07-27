<?php

namespace App\Repository\RV;

use Doctrine\ORM\EntityRepository;
use App\Entity\RV\ProductivityItem;
use App\Entity\RV\Project;
use App\Entity\RV\ProjectWellTypeInterval;

/**
 * ProductivityItemsRepository class.
 *
 * @package App\Repository\RV
 */
class ProductivityItemsRepository extends EntityRepository
{
    const ALIAS = 'pi';

    public function sumHoursForInterval(ProjectWellTypeInterval $interval)
    {
        return $this->createQueryBuilder('pi')
            ->select('sum(timestampdiff(hour, pi.startTime, pi.endTime))')
            ->where('pi.drillingInterval = :interval')
            ->setParameter('interval', $interval)
            ->getQuery()
            ->getSingleScalarResult();
    }

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
