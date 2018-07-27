<?php

namespace App\Repository\RV;

use Doctrine\ORM\EntityRepository;
use App\Entity\RV\Grade;
use App\Entity\RV\Thread;

class ManufacturedCasingRepository extends EntityRepository
{
    const ALIAS = 'mc';

    public function getOuterDiameterChoicesByCriteria(array $criteria = [])
    {
        $criteria = array_merge($criteria, ['deleted' => false]);

        $choices = [];

        $outerDiameters = $this->getCriteriaAwareQueryBuilder($criteria)
            ->select(sprintf('%s.outerDiameter', self::ALIAS))
            ->distinct()
            ->getQuery()
            ->getArrayResult();

        foreach ($outerDiameters as $outerDiameter) {
            $choices[$outerDiameter['outerDiameter']] = $outerDiameter['outerDiameter'];
        }

        return $choices;
    }

    public function getWeightByCriteria(array $criteria = [])
    {
        $criteria = array_merge($criteria, ['deleted' => false]);

        $choices = [];

        $weights = $this->getCriteriaAwareQueryBuilder($criteria)
            ->select(sprintf('%s.weight', self::ALIAS))
            ->distinct()
            ->getQuery()
            ->getArrayResult();

        foreach ($weights as $weight) {
            $choices[$weight['weight']] = $weight['weight'];
        }

        return $choices;
    }

    public function getGradeByCriteria(array $criteria = [])
    {
        $ids = [];

        $grades = $this->getCriteriaAwareQueryBuilder($criteria)
            ->select(sprintf('IDENTITY(%s.grade) as gradeId', self::ALIAS))
            ->distinct()
            ->getQuery()
            ->getArrayResult();

        foreach ($grades as $grade) {
            $ids[] = $grade['gradeId'];
        }

        return $this->getEntityManager()->createQueryBuilder()
            ->select('g')
            ->from(Grade::class, 'g')
            ->where('g.deleted = :deleted')
            ->andWhere('g.id IN (:ids)')
            ->setParameters([
                'deleted' => false,
                'ids' => $ids
            ])
            ->getQuery()
            ->getResult();
    }

    public function getThreadByCriteria(array $criteria = [])
    {
        $ids = [];

        $threads = $this->getCriteriaAwareQueryBuilder($criteria)
            ->select(sprintf('IDENTITY(%s.thread) as threadId', self::ALIAS))
            ->distinct()
            ->getQuery()
            ->getArrayResult();

        foreach ($threads as $thread) {
            $ids[] = $thread['threadId'];
        }

        return $this->getEntityManager()->createQueryBuilder()
            ->select('t')
            ->from(Thread::class, 't')
            ->where('t.deleted = :deleted')
            ->andWhere('t.id IN (:ids)')
            ->setParameters([
                'deleted' => false,
                'ids' => $ids
            ])
            ->getQuery()
            ->getResult();
    }

    public function getByCriteria(array $criteria = [])
    {
        return $this->getCriteriaAwareQueryBuilder($criteria)
            ->getQuery()
            ->getResult();
    }

    private function getCriteriaAwareQueryBuilder(array $criteria = [])
    {
        $queryBuilder = $this->createQueryBuilder(self::ALIAS);

        foreach ($criteria as $key => $value) {
            $queryBuilder
                ->andWhere(sprintf('%s.%s = :%s', self::ALIAS, $key, $key))
                ->setParameter($key, $value)
            ;
        }

        return $queryBuilder;
    }
}
