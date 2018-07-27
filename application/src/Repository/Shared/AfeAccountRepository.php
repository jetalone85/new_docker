<?php

namespace App\Repository\Shared;

use Doctrine\ORM\EntityRepository;
use App\Entity\User;

/**
 * AfeAccountRepository class.
 *
 * @method array findByCreatedBy(User $user, array $orderBy = null, $limit = null, $offset = null)
 *
 * @package App\Repository\Shared
 */
class AfeAccountRepository extends EntityRepository
{
}
