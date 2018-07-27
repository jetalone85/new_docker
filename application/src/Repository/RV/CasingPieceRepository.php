<?php

namespace App\Repository\RV;

use Doctrine\ORM\EntityRepository;
use App\Entity\RV\CasingPiece;
use App\Entity\RV\CasingSegment;

/**
 * Class CasingPieceRepository
 * @package App\Repository\RV
 */
class CasingPieceRepository extends EntityRepository
{
    const ALIAS = 'cp';

    public function getCasingSummary($casingSegment)
    {
        return $this
            ->createQueryBuilder(self::ALIAS)
            ->select('cp as casingPiece, SUM(cp.length) as length')
            ->where('cp.casingSegment = :casingSegment')
            ->setParameter('casingSegment', $casingSegment->getId())
            ->groupBy('cp.name, cp.group, cp.size, cp.manufacturedCasing, cp.thread, cp.in')
               ->getQuery()
               ->getResult()
           ;
    }

    public function shiftUpPositionsByNewPiece(CasingPiece $casingPiece)
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->update(CasingPiece::class, self::ALIAS)
            ->set(sprintf('%s.number', self::ALIAS), sprintf('%s.number + 1', self::ALIAS))
            ->where(sprintf('%s.number >= :position', self::ALIAS))
            ->andWhere(sprintf('%s.casingSegment = :casingSegment', self::ALIAS))
            ->andWhere(sprintf('%s.id != :id', self::ALIAS))
            ->setParameters([
                'position' => $casingPiece->getNumber(),
                'casingSegment' => $casingPiece->getCasingSegment(),
                'id' => $casingPiece->getId(),
            ])
            ->getQuery()
            ->execute();
    }
}
