<?php

namespace App\Repository\RV;

use Doctrine\ORM\EntityRepository;

class TypeListRepository extends EntityRepository
{
    public function getNotDeletedQueryBuilder()
    {
        return $this->createQueryBuilder($this->getAlias())
            ->andWhere(sprintf('%s.deleted = :deleted', $this->getAlias()))
            ->setParameter('deleted', false);
    }

    public function getAlias()
    {
        if (!defined('static::ALIAS')) {
            return 'tp';
        }

        return static::ALIAS;
    }
}
