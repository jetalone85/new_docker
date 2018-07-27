<?php

namespace App\Repository\Shared;

use Doctrine\ORM\QueryBuilder;
use App\Request\DrillingParameters;

class AccumapDevelopmentImportRepository extends \Doctrine\ORM\EntityRepository
{
    public function deleteAll()
    {
        $this->getEntityManager()->createQuery('DELETE App:Shared\AccumapDevelopmentImport a')->execute();
    }
}
