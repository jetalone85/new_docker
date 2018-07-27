<?php

namespace App\Repository\RV;

use Doctrine\ORM\EntityRepository;
use App\Entity\RV\Licence;

/**
 * SafetyMeetingRepository class.
 *
 * @method array findByLicence(Licence $licence, array $orderBy = null, $limit = null, $offset = null)
 *
 * @package App\Repository\RV
 */
class SafetyMeetingRepository extends EntityRepository
{
}
