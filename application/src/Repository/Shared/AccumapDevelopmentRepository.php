<?php

namespace App\Repository\Shared;

use Doctrine\ORM\QueryBuilder;
use App\Entity\EIM\UserFavourites;
use App\Request\DrillingParameters;

class AccumapDevelopmentRepository extends \Doctrine\ORM\EntityRepository
{
    public function findFastestWellForMap(UserFavourites $favMap)
    {
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.metersPerDay', 'DESC')
            ->setMaxResults(1);

        $this->limitCoordinates($qb, [
            'minLatitude' => $favMap->getMapSouthLatitude(),
            'maxLatitude' => $favMap->getMapNorthLatitude(),
            'minLongitude' => $favMap->getMapWestLongitude(),
            'maxLongitude' => $favMap->getMapEastLongitude(),
        ]);

        $wells = $qb->getQuery()->getResult();
        return count($wells) ? $wells[0] : false;
    }

    public function findDrillingData(DrillingParameters $drillingParams)
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a, c.name as consultant')
            ->leftJoin('a.consultant', 'c');

        if ($drillingParams->getIsFiltersAdvancedColumn()) {
            $qb->andWhere($drillingParams->getOrderProperty() . ' != ""');
            $qb->groupBy($drillingParams->getOrderProperty());
        }

        if (!empty($drillingParams->getSearch())) {
            $qb = $this->globalColumnsSearch($qb, $drillingParams->getSearch());
        }

        $this->individualColumnsSearch($qb, $drillingParams->getFiltersColumns(), $drillingParams->getFiltersAdvanced());

        if ($drillingParams->getRadiusSearchValue()) {
            $this->limitRadiusCoordinates($qb, $drillingParams);
        } else {
            $this->limitCoordinates($qb, $drillingParams->getCoordinates());
        }

        $qb->orderBy($drillingParams->getOrderProperty(), $drillingParams->getOrderDir());

        if ($drillingParams->getRowLimit()) {
            $qb->setFirstResult($drillingParams->getRowStart());
            $qb->setMaxResults($drillingParams->getRowLimit());
        }

        $rows = $qb->getQuery()->getArrayResult();

        $result = [];
        foreach ($rows as $row) {
            $result[] = array_merge($row[0], ['consultant' => $row['consultant']]);
        }

        if ($drillingParams->hasKPIFlag()) {
            $result = $this->updateKPIColors($result, $drillingParams);
        }

        return $result;
    }

    public function drillingDataCount(DrillingParameters $drillingParams)
    {
        $qb = $this->createQueryBuilder('a')
            ->select("COUNT(a.uwi)")
            ->distinct(true);

        if (!empty($drillingParams->getSearch())) {
            $qb = $this->globalColumnsSearch($qb, $drillingParams->getSearch());
        }

        $this->individualColumnsSearch($qb, $drillingParams->getFiltersColumns(), $drillingParams->getFiltersAdvanced());

        if ($drillingParams->getRadiusSearchValue()) {
            $this->limitRadiusCoordinates($qb, $drillingParams);
        } else {
            $this->limitCoordinates($qb, $drillingParams->getCoordinates());
        }

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function drillingTotalRecords(DrillingParameters $drillingParams)
    {
        $qb = $this->createQueryBuilder('a')
            ->select("COUNT(a.uwi)")
            ->distinct(true);

        $this->limitCoordinates($qb, $drillingParams->getCoordinates());

        return $qb->getQuery()->getSingleScalarResult();
    }

    protected function globalColumnsSearch(QueryBuilder $qb, $search)
    {
        $searchConditions = $qb->expr()->orX();

        foreach (DrillingParameters::COLUMNS_MAP as $column) {
            if ($column['property'] == '') {
                continue;
            }
            $searchConditions->add($column['property'] . ' LIKE :searchKeywords');
        }

        $qb->setParameter('searchKeywords', '%' . $search . '%');
        $qb->andWhere($searchConditions);
    }

    protected function individualColumnsSearch(QueryBuilder $qb, $filtersColumns, $filtersAdvanced)
    {
        $conditions = $qb->expr()->andX();

        foreach ($filtersColumns as $idx => $col) {
            $searchProperty = DrillingParameters::COLUMNS_MAP[$col['name']]['property'];
            $searchValue = array_key_exists('search', $col) ? $col['search']['value'] : '';
            if ($searchValue == '') {
                continue;
            }
            if (strpos($searchValue, ',') !== false) {
                $nestedOrConditions = $qb->expr()->orX();
                $searchArray = explode(',', $searchValue);
                foreach ($searchArray as $searchValue) {
                    $this->addSearchCondition($nestedOrConditions, $qb, 'equals_alpha', $searchProperty, $searchValue);
                }
                $conditions->add($nestedOrConditions);
            } else {
                $this->addSearchCondition($conditions, $qb, $filtersAdvanced[$idx], $searchProperty, $searchValue);
            }
        }

        $qb->andWhere($conditions);
    }

    protected function addSearchCondition($conditions, $qb, $type, $property, $search)
    {
        $searchParam = 'searchval_' . uniqid(); // unique name of the query parameter for later binding

        switch ($type) {
            case 'contains':
                $condition = "$property LIKE :$searchParam";
                $qb->setParameter($searchParam, "%$search%");
                break;
            case 'not_contains':
                $condition = "$property NOT LIKE :$searchParam";
                $qb->setParameter($searchParam, "%$search%");
                break;
            case 'equals_numeric':
            case 'equals_date':
            case 'equals_alpha':
                $condition = "$property = :$searchParam";
                $qb->setParameter($searchParam, $search);
                // no break
            case 'not_equals':
                $condition = "$property != :$searchParam";
                $qb->setParameter($searchParam, $search);
                break;
            case 'starts_with':
                $condition = "$property LIKE :$searchParam";
                $qb->setParameter($searchParam, "$search%");
                break;
            case 'ends_with':
                $condition = "$property LIKE :$searchParam";
                $qb->setParameter($searchParam, "%$search");
                break;
            case 'greater_than':
                $condition = "$property > :$searchParam";
                $qb->setParameter($searchParam, $search);
                break;
            case 'greater_than_equal':
                $condition = "$property >= :$searchParam";
                $qb->setParameter($searchParam, $search);
                break;
            case 'less_than':
                $condition = "$property < :$searchParam";
                $qb->setParameter($searchParam, $search);
                break;
            case 'less_than_equal':
                $condition = "$property <= :$searchParam";
                $qb->setParameter($searchParam, $search);
                break;
            case 'before':
                $condition = "$property < :$searchParam";
                $qb->setParameter($searchParam, $search);
                break;
            case 'after':
                $condition = "$property > :$searchParam";
                $qb->setParameter($searchParam, $search);
                break;
            case 'between':
                $search = explode(':', $search);
                $searchParam = [ $searchParam.'_1', $searchParam.'_2' ];
                $condition = "($property >= :{$searchParam[0]} AND $property <= {$searchParam[1]})";
                $qb->setParameter($searchParam[0], $search[0]);
                $qb->setParameter($searchParam[1], $search[1]);
                break;
            default:
                $condition = "$property LIKE :$searchParam";
                $qb->setParameter($searchParam, "%$search%");
                break;
        }

        $conditions->add($condition);
        return $conditions;
    }

    protected function limitCoordinates(QueryBuilder $qb, $coordinates)
    {
        $surfaceLimits = $qb->expr()->andX()
            ->add('a.surfaceLatitude >= :minLatitude AND a.surfaceLatitude <= :maxLatitude')
            ->add('a.surfaceLongitude >= :minLongitude AND a.surfaceLongitude <= :maxLongitude');

        $holeLimits = $qb->expr()->andX()
            ->add('a.bottomHoleLatitude >= :minLatitude AND a.bottomHoleLatitude <= :maxLatitude')
            ->add('a.bottomHoleLongitude >= :minLongitude AND a.bottomHoleLongitude <= :maxLongitude');

        $coordinatesLimits = $qb->expr()->orX()
            ->add($surfaceLimits)
            ->add($holeLimits);

        $qb->setParameter('minLatitude', $coordinates['minLatitude']);
        $qb->setParameter('maxLatitude', $coordinates['maxLatitude']);
        $qb->setParameter('minLongitude', $coordinates['minLongitude']);
        $qb->setParameter('maxLongitude', $coordinates['maxLongitude']);

        $qb->andWhere($coordinatesLimits);
    }

    protected function limitRadiusCoordinates(QueryBuilder $qb, DrillingParameters $drillingParams)
    {
        $qb->andWhere('
            ( 6371 * ACOS( COS( RADIANS( :radiusLatitude ) ) * COS( RADIANS( a.surfaceLatitude ) ) 
            * COS( RADIANS( a.surfaceLongitude ) - RADIANS( :radiusLongitude ) ) + SIN( RADIANS( :radiusLatitude ) )
            * SIN(RADIANS( a.surfaceLatitude )) ) ) < :radiusValue
        ');

        $qb->setParameter('radiusLatitude', $drillingParams->getRadiusSearchLatitude());
        $qb->setParameter('radiusLongitude', $drillingParams->getRadiusSearchLongitude());
        $qb->setParameter('radiusValue', $drillingParams->getRadiusSearchValue());
    }

    protected function updateKPIColors($records, DrillingParameters $drillingParams)
    {
        $averageKPI = $drillingParams->getAverageKPI();
        $standardDevKPI = $drillingParams->getStandardDevKPI();

        foreach ($records as &$rec) {
            $rec['kpiColor'] = $this->getKPIColor($rec['metersPerDay'], $averageKPI, $standardDevKPI);
        }

        return $records;
    }

    protected function getKPIColor($kpiValue, $averageKPI, $standardDevKPI)
    {
        $color = '';

        if ($kpiValue == 0) {
            $color = 'grey';
        } elseif ($kpiValue > ($averageKPI + $standardDevKPI)) {
            $color = 'green';
        } elseif ($kpiValue <= ($averageKPI + $standardDevKPI) && $kpiValue >= ($averageKPI - $standardDevKPI)) {
            $color = 'yellow';
        } elseif ($kpiValue < ($averageKPI - $standardDevKPI)) {
            $color = 'red';
        }
        
        return $color;
    }

    public function getAvailableFormations()
    {
        $formations = [];

        $records = $this->createQueryBuilder('a')
            ->select('DISTINCT a.lastFormation')
            ->orderBy('a.lastFormation')
            ->getQuery()
            ->getResult()
        ;

        foreach ($records as $rec) {
            $formations[] = $rec['lastFormation'];
        }

        return $formations;
    }
}
