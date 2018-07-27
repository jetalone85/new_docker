<?php

namespace App\Repository\RV;

use Doctrine\ORM\EntityRepository;
use App\Entity\RV\DrillingEvent;

/**
 * ProjectRepository class.
 *
 * @method array findByDrillingEvent(DrillingEvent $event, array $orderBy = null, $limit = null, $offset = null)
 *
 * @package App\Repository\RV
 * @author Michał Haracewiat <michal.haracewiat@polcode.net>
 */
class ProjectRepository extends EntityRepository
{
}
