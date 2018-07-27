<?php

namespace App\Entity\Shared;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass()
 * @ORM\Table(name="accumap_development_common")
 */
class AccumapDevelopmentCommon
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="UWI_DELIMITED", type="string", length=255, nullable=false)
     */
    public $uwiDelimited = '';

    /**
     * @var string
     *
     * @ORM\Column(name="UWI", type="string", length=90, nullable=false)
     */
    public $uwi = '';

    /**
     * @var string
     *
     * @ORM\Column(name="WELL_NAME", type="string", length=255, nullable=true)
     */
    public $wellName;

    /**
     * @var string
     *
     * @ORM\Column(name="LICENCE_NO", type="string", length=255, nullable=true)
     */
    public $licenceNo;

    /**
     * @var string
     *
     * @ORM\Column(name="LAST_FORMATION", type="string", length=255, nullable=true)
     */
    public $lastFormation;

    /**
     * @var string
     *
     * @ORM\Column(name="PROFILE_TYPE", type="string", length=255, nullable=true)
     */
    public $profileType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="SPUD_DATE", type="datetime", nullable=true)
     */
    public $spudDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="RIG_RELEASE_DATE", type="datetime", nullable=true)
     */
    public $rigReleaseDate;

    /**
     * @var float
     *
     * @ORM\Column(name="DAYS_DRILLED", type="float", precision=10, scale=0, nullable=true)
     */
    public $daysDrilled;

    /**
     * @var float
     *
     * @ORM\Column(name="METERS_PER_DAY", type="float", precision=10, scale=0, nullable=true)
     */
    public $metersPerDay;

    /**
     * @var integer
     *
     * @ORM\Column(name="EVENT_NUMBER", type="integer", nullable=true)
     */
    public $eventNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="CASING_COUNT", type="integer", nullable=true)
     */
    public $casingCount;

    /**
     * @var string
     *
     * @ORM\Column(name="CASING_SIZE_1", type="decimal", precision=10, scale=0, nullable=true)
     */
    public $casingSize1;

    /**
     * @var string
     *
     * @ORM\Column(name="CASING_SIZE_2", type="decimal", precision=10, scale=0, nullable=true)
     */
    public $casingSize2;

    /**
     * @var string
     *
     * @ORM\Column(name="CASING_SIZE_3", type="decimal", precision=10, scale=0, nullable=true)
     */
    public $casingSize3;

    /**
     * @var string
     *
     * @ORM\Column(name="CASING_SIZE_4", type="decimal", precision=10, scale=0, nullable=true)
     */
    public $casingSize4;

    /**
     * @var string
     *
     * @ORM\Column(name="CASING_SIZE_5", type="decimal", precision=10, scale=0, nullable=true)
     */
    public $casingSize5;

    /**
     * @var string
     *
     * @ORM\Column(name="CASING_SIZE_6", type="decimal", precision=10, scale=0, nullable=true)
     */
    public $casingSize6;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ROW_CHANGED_DATE", type="datetime", nullable=true)
     */
    public $rowChangedDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ROW_CREATED_DATE", type="datetime", nullable=true)
     */
    public $rowCreatedDate;

    /**
     * @var string
     *
     * @ORM\Column(name="OPERATOR", type="string", length=255, nullable=true)
     */
    public $operator;

    /**
     * @var string
     *
     * @ORM\Column(name="STRIKE", type="string", length=255, nullable=true)
     */
    public $strike;

    /**
     * @var string
     *
     * @ORM\Column(name="SURFACE_LOCATION", type="string", length=255, nullable=true)
     */
    public $surfaceLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="TVD_DEPTH", type="string", length=255, nullable=true)
     */
    public $tvdDepth;

    /**
     * @var string
     *
     * @ORM\Column(name="TOTAL_DEPTH", type="string", length=255, nullable=true)
     */
    public $totalDepth;

    /**
     * @var string
     *
     * @ORM\Column(name="PROJECTED_FORMATION", type="string", length=255, nullable=true)
     */
    public $projectedFormation;

    /**
     * @var string
     *
     * @ORM\Column(name="DRILL_RIG_NUM", type="string", length=255, nullable=true)
     */
    public $drillRigNum;

    /**
     * @var string
     *
     * @ORM\Column(name="WELL_STATUS", type="string", length=50, nullable=true)
     */
    public $wellStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="X_ORIGINAL_LICENSEE", type="string", length=255, nullable=true)
     */
    public $xOriginalLicensee;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTRACTOR", type="string", length=255, nullable=true)
     */
    public $contractor;

    /**
     * @var string
     *
     * @ORM\Column(name="LEGAL_SURVEY_TYPE", type="string", length=255, nullable=true)
     */
    public $legalSurveyType;

    /**
     * @var float
     *
     * @ORM\Column(name="SURFACE_LATITUDE", type="float", precision=10, scale=0, nullable=true)
     */
    public $surfaceLatitude;

    /**
     * @var float
     *
     * @ORM\Column(name="SURFACE_LONGITUDE", type="float", precision=10, scale=0, nullable=true)
     */
    public $surfaceLongitude;

    /**
     * @var float
     *
     * @ORM\Column(name="BOTTOM_HOLE_LONGITUDE", type="float", precision=10, scale=0, nullable=true)
     */
    public $bottomHoleLongitude;

    /**
     * @var float
     *
     * @ORM\Column(name="BOTTOM_HOLE_LATITUDE", type="float", precision=10, scale=0, nullable=true)
     */
    public $bottomHoleLatitude;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Shared\Company", inversedBy="accumapDevelopments")
     * @ORM\JoinColumn(name="CONSULTANT_ID", referencedColumnName="id")
     */
    private $consultant;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set uwiDelimited
     *
     * @param string $uwiDelimited
     *
     * @return AccumapDevelopmentCommon
     */
    public function setUwiDelimited($uwiDelimited)
    {
        $this->uwiDelimited = $uwiDelimited;

        return $this;
    }

    /**
     * Get uwiDelimited
     *
     * @return string
     */
    public function getUwiDelimited()
    {
        return $this->uwiDelimited;
    }

    /**
     * Set uwi
     *
     * @param string $uwi
     *
     * @return AccumapDevelopmentCommon
     */
    public function setUwi($uwi)
    {
        $this->uwi = $uwi;

        return $this;
    }

    /**
     * Get uwi
     *
     * @return string
     */
    public function getUwi()
    {
        return $this->uwi;
    }

    /**
     * Set wellName
     *
     * @param string $wellName
     *
     * @return AccumapDevelopmentCommon
     */
    public function setWellName($wellName)
    {
        $this->wellName = $wellName;

        return $this;
    }

    /**
     * Get wellName
     *
     * @return string
     */
    public function getWellName()
    {
        return $this->wellName;
    }

    /**
     * Set licenceNo
     *
     * @param string $licenceNo
     *
     * @return AccumapDevelopmentCommon
     */
    public function setLicenceNo($licenceNo)
    {
        $this->licenceNo = $licenceNo;

        return $this;
    }

    /**
     * Get licenceNo
     *
     * @return string
     */
    public function getLicenceNo()
    {
        return $this->licenceNo;
    }

    /**
     * Set lastFormation
     *
     * @param string $lastFormation
     *
     * @return AccumapDevelopmentCommon
     */
    public function setLastFormation($lastFormation)
    {
        $this->lastFormation = $lastFormation;

        return $this;
    }

    /**
     * Get lastFormation
     *
     * @return string
     */
    public function getLastFormation()
    {
        return $this->lastFormation;
    }

    /**
     * Set profileType
     *
     * @param string $profileType
     *
     * @return AccumapDevelopmentCommon
     */
    public function setProfileType($profileType)
    {
        $this->profileType = $profileType;

        return $this;
    }

    /**
     * Get profileType
     *
     * @return string
     */
    public function getProfileType()
    {
        return $this->profileType;
    }

    /**
     * Set spudDate
     *
     * @param \DateTime $spudDate
     *
     * @return AccumapDevelopmentCommon
     */
    public function setSpudDate($spudDate)
    {
        $this->spudDate = $spudDate;

        return $this;
    }

    /**
     * Get spudDate
     *
     * @return \DateTime
     */
    public function getSpudDate()
    {
        return $this->spudDate;
    }

    /**
     * Set rigReleaseDate
     *
     * @param \DateTime $rigReleaseDate
     *
     * @return AccumapDevelopmentCommon
     */
    public function setRigReleaseDate($rigReleaseDate)
    {
        $this->rigReleaseDate = $rigReleaseDate;

        return $this;
    }

    /**
     * Get rigReleaseDate
     *
     * @return \DateTime
     */
    public function getRigReleaseDate()
    {
        return $this->rigReleaseDate;
    }

    /**
     * Set daysDrilled
     *
     * @param float $daysDrilled
     *
     * @return AccumapDevelopmentCommon
     */
    public function setDaysDrilled($daysDrilled)
    {
        $this->daysDrilled = $daysDrilled;

        return $this;
    }

    /**
     * Get daysDrilled
     *
     * @return float
     */
    public function getDaysDrilled()
    {
        return $this->daysDrilled;
    }

    /**
     * Set metersPerDay
     *
     * @param float $metersPerDay
     *
     * @return AccumapDevelopmentCommon
     */
    public function setMetersPerDay($metersPerDay)
    {
        $this->metersPerDay = $metersPerDay;

        return $this;
    }

    /**
     * Get metersPerDay
     *
     * @return float
     */
    public function getMetersPerDay()
    {
        return $this->metersPerDay;
    }

    /**
     * Set eventNumber
     *
     * @param integer $eventNumber
     *
     * @return AccumapDevelopmentCommon
     */
    public function setEventNumber($eventNumber)
    {
        $this->eventNumber = $eventNumber;

        return $this;
    }

    /**
     * Get eventNumber
     *
     * @return integer
     */
    public function getEventNumber()
    {
        return $this->eventNumber;
    }

    /**
     * Set casingCount
     *
     * @param integer $casingCount
     *
     * @return AccumapDevelopmentCommon
     */
    public function setCasingCount($casingCount)
    {
        $this->casingCount = $casingCount;

        return $this;
    }

    /**
     * Get casingCount
     *
     * @return integer
     */
    public function getCasingCount()
    {
        return $this->casingCount;
    }

    /**
     * Set casingSize1
     *
     * @param string $casingSize1
     *
     * @return AccumapDevelopmentCommon
     */
    public function setCasingSize1($casingSize1)
    {
        $this->casingSize1 = $casingSize1;

        return $this;
    }

    /**
     * Get casingSize1
     *
     * @return string
     */
    public function getCasingSize1()
    {
        return $this->casingSize1;
    }

    /**
     * Set casingSize2
     *
     * @param string $casingSize2
     *
     * @return AccumapDevelopmentCommon
     */
    public function setCasingSize2($casingSize2)
    {
        $this->casingSize2 = $casingSize2;

        return $this;
    }

    /**
     * Get casingSize2
     *
     * @return string
     */
    public function getCasingSize2()
    {
        return $this->casingSize2;
    }

    /**
     * Set casingSize3
     *
     * @param string $casingSize3
     *
     * @return AccumapDevelopmentCommon
     */
    public function setCasingSize3($casingSize3)
    {
        $this->casingSize3 = $casingSize3;

        return $this;
    }

    /**
     * Get casingSize3
     *
     * @return string
     */
    public function getCasingSize3()
    {
        return $this->casingSize3;
    }

    /**
     * Set casingSize4
     *
     * @param string $casingSize4
     *
     * @return AccumapDevelopmentCommon
     */
    public function setCasingSize4($casingSize4)
    {
        $this->casingSize4 = $casingSize4;

        return $this;
    }

    /**
     * Get casingSize4
     *
     * @return string
     */
    public function getCasingSize4()
    {
        return $this->casingSize4;
    }

    /**
     * Set casingSize5
     *
     * @param string $casingSize5
     *
     * @return AccumapDevelopmentCommon
     */
    public function setCasingSize5($casingSize5)
    {
        $this->casingSize5 = $casingSize5;

        return $this;
    }

    /**
     * Get casingSize5
     *
     * @return string
     */
    public function getCasingSize5()
    {
        return $this->casingSize5;
    }

    /**
     * Set casingSize6
     *
     * @param string $casingSize6
     *
     * @return AccumapDevelopmentCommon
     */
    public function setCasingSize6($casingSize6)
    {
        $this->casingSize6 = $casingSize6;

        return $this;
    }

    /**
     * Get casingSize6
     *
     * @return string
     */
    public function getCasingSize6()
    {
        return $this->casingSize6;
    }

    /**
     * Set rowChangedDate
     *
     * @param \DateTime $rowChangedDate
     *
     * @return AccumapDevelopmentCommon
     */
    public function setRowChangedDate($rowChangedDate)
    {
        $this->rowChangedDate = $rowChangedDate;

        return $this;
    }

    /**
     * Get rowChangedDate
     *
     * @return \DateTime
     */
    public function getRowChangedDate()
    {
        return $this->rowChangedDate;
    }

    /**
     * Set rowCreatedDate
     *
     * @param \DateTime $rowCreatedDate
     *
     * @return AccumapDevelopmentCommon
     */
    public function setRowCreatedDate($rowCreatedDate)
    {
        $this->rowCreatedDate = $rowCreatedDate;

        return $this;
    }

    /**
     * Get rowCreatedDate
     *
     * @return \DateTime
     */
    public function getRowCreatedDate()
    {
        return $this->rowCreatedDate;
    }

    /**
     * Set operator
     *
     * @param string $operator
     *
     * @return AccumapDevelopmentCommon
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get operator
     *
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Set strike
     *
     * @param string $strike
     *
     * @return AccumapDevelopmentCommon
     */
    public function setStrike($strike)
    {
        $this->strike = $strike;

        return $this;
    }

    /**
     * Get strike
     *
     * @return string
     */
    public function getStrike()
    {
        return $this->strike;
    }

    /**
     * Set surfaceLocation
     *
     * @param string $surfaceLocation
     *
     * @return AccumapDevelopmentCommon
     */
    public function setSurfaceLocation($surfaceLocation)
    {
        $this->surfaceLocation = $surfaceLocation;

        return $this;
    }

    /**
     * Get surfaceLocation
     *
     * @return string
     */
    public function getSurfaceLocation()
    {
        return $this->surfaceLocation;
    }

    /**
     * Set tvdDepth
     *
     * @param string $tvdDepth
     *
     * @return AccumapDevelopmentCommon
     */
    public function setTvdDepth($tvdDepth)
    {
        $this->tvdDepth = $tvdDepth;

        return $this;
    }

    /**
     * Get tvdDepth
     *
     * @return string
     */
    public function getTvdDepth()
    {
        return $this->tvdDepth;
    }

    /**
     * Set totalDepth
     *
     * @param string $totalDepth
     *
     * @return AccumapDevelopmentCommon
     */
    public function setTotalDepth($totalDepth)
    {
        $this->totalDepth = $totalDepth;

        return $this;
    }

    /**
     * Get totalDepth
     *
     * @return string
     */
    public function getTotalDepth()
    {
        return $this->totalDepth;
    }

    /**
     * Set projectedFormation
     *
     * @param string $projectedFormation
     *
     * @return AccumapDevelopmentCommon
     */
    public function setProjectedFormation($projectedFormation)
    {
        $this->projectedFormation = $projectedFormation;

        return $this;
    }

    /**
     * Get projectedFormation
     *
     * @return string
     */
    public function getProjectedFormation()
    {
        return $this->projectedFormation;
    }

    /**
     * Set drillRigNum
     *
     * @param string $drillRigNum
     *
     * @return AccumapDevelopmentCommon
     */
    public function setDrillRigNum($drillRigNum)
    {
        $this->drillRigNum = $drillRigNum;

        return $this;
    }

    /**
     * Get drillRigNum
     *
     * @return string
     */
    public function getDrillRigNum()
    {
        return $this->drillRigNum;
    }

    /**
     * Set wellStatus
     *
     * @param string $wellStatus
     *
     * @return AccumapDevelopmentCommon
     */
    public function setWellStatus($wellStatus)
    {
        $this->wellStatus = $wellStatus;

        return $this;
    }

    /**
     * Get wellStatus
     *
     * @return string
     */
    public function getWellStatus()
    {
        return $this->wellStatus;
    }

    /**
     * Set xOriginalLicensee
     *
     * @param string $xOriginalLicensee
     *
     * @return AccumapDevelopmentCommon
     */
    public function setXOriginalLicensee($xOriginalLicensee)
    {
        $this->xOriginalLicensee = $xOriginalLicensee;

        return $this;
    }

    /**
     * Get xOriginalLicensee
     *
     * @return string
     */
    public function getXOriginalLicensee()
    {
        return $this->xOriginalLicensee;
    }

    /**
     * Set contractor
     *
     * @param string $contractor
     *
     * @return AccumapDevelopmentCommon
     */
    public function setContractor($contractor)
    {
        $this->contractor = $contractor;

        return $this;
    }

    /**
     * Get contractor
     *
     * @return string
     */
    public function getContractor()
    {
        return $this->contractor;
    }

    /**
     * Set legalSurveyType
     *
     * @param string $legalSurveyType
     *
     * @return AccumapDevelopmentCommon
     */
    public function setLegalSurveyType($legalSurveyType)
    {
        $this->legalSurveyType = $legalSurveyType;

        return $this;
    }

    /**
     * Get legalSurveyType
     *
     * @return string
     */
    public function getLegalSurveyType()
    {
        return $this->legalSurveyType;
    }

    /**
     * Set surfaceLatitude
     *
     * @param float $surfaceLatitude
     *
     * @return AccumapDevelopmentCommon
     */
    public function setSurfaceLatitude($surfaceLatitude)
    {
        $this->surfaceLatitude = $surfaceLatitude;

        return $this;
    }

    /**
     * Get surfaceLatitude
     *
     * @return float
     */
    public function getSurfaceLatitude()
    {
        return $this->surfaceLatitude;
    }

    /**
     * Set surfaceLongitude
     *
     * @param float $surfaceLongitude
     *
     * @return AccumapDevelopmentCommon
     */
    public function setSurfaceLongitude($surfaceLongitude)
    {
        $this->surfaceLongitude = $surfaceLongitude;

        return $this;
    }

    /**
     * Get surfaceLongitude
     *
     * @return float
     */
    public function getSurfaceLongitude()
    {
        return $this->surfaceLongitude;
    }

    /**
     * Set bottomHoleLongitude
     *
     * @param float $bottomHoleLongitude
     *
     * @return AccumapDevelopmentCommon
     */
    public function setBottomHoleLongitude($bottomHoleLongitude)
    {
        $this->bottomHoleLongitude = $bottomHoleLongitude;

        return $this;
    }

    /**
     * Get bottomHoleLongitude
     *
     * @return float
     */
    public function getBottomHoleLongitude()
    {
        return $this->bottomHoleLongitude;
    }

    /**
     * Set bottomHoleLatitude
     *
     * @param float $bottomHoleLatitude
     *
     * @return AccumapDevelopmentCommon
     */
    public function setBottomHoleLatitude($bottomHoleLatitude)
    {
        $this->bottomHoleLatitude = $bottomHoleLatitude;

        return $this;
    }

    /**
     * Get bottomHoleLatitude
     *
     * @return float
     */
    public function getBottomHoleLatitude()
    {
        return $this->bottomHoleLatitude;
    }

    /**
     * @return Company
     */
    public function getConsultant()
    {
        return $this->consultant;
    }
    
    /**
     * @param Company $consultant
     * @return AccumapDevelopmentCommon
     */
    public function setConsultant(Company $consultant = null)
    {
        $this->consultant = $consultant;

        return $this;
    }

    public static function createCopy(AccumapDevelopmentCommon $source, AccumapDevelopmentCommon $target = null)
    {
        if (is_null($target)) {
            $target = new static();
        }
        $target->setUwiDelimited($source->getUwiDelimited());
        $target->setUwi($source->getUwi());
        $target->setWellName($source->getWellName());
        $target->setLicenceNo($source->getLicenceNo());
        $target->setLastFormation($source->getLastFormation());
        $target->setProfileType($source->getProfileType());
        $target->setSpudDate($source->getSpudDate());
        $target->setRigReleaseDate($source->getRigReleaseDate());
        $target->setDaysDrilled($source->getDaysDrilled());
        $target->setMetersPerDay($source->getMetersPerDay());
        $target->setEventNumber($source->getEventNumber());
        $target->setCasingCount($source->getCasingCount());
        $target->setCasingSize1($source->getCasingSize1());
        $target->setCasingSize2($source->getCasingSize2());
        $target->setCasingSize3($source->getCasingSize3());
        $target->setCasingSize4($source->getCasingSize4());
        $target->setCasingSize5($source->getCasingSize5());
        $target->setCasingSize6($source->getCasingSize6());
        $target->setRowChangedDate($source->getRowChangedDate());
        $target->setRowCreatedDate($source->getRowCreatedDate());
        $target->setOperator($source->getOperator());
        $target->setStrike($source->getStrike());
        $target->setSurfaceLocation($source->getSurfaceLocation());
        $target->setTvdDepth($source->getTvdDepth());
        $target->setTotalDepth($source->getTotalDepth());
        $target->setProjectedFormation($source->getProjectedFormation());
        $target->setDrillRigNum($source->getDrillRigNum());
        $target->setWellStatus($source->getWellStatus());
        $target->setXOriginalLicensee($source->getXOriginalLicensee());
        $target->setContractor($source->getContractor());
        $target->setLegalSurveyType($source->getLegalSurveyType());
        $target->setSurfaceLatitude($source->getSurfaceLatitude());
        $target->setSurfaceLongitude($source->getSurfaceLongitude());
        $target->setBottomHoleLongitude($source->getBottomHoleLongitude());
        $target->setBottomHoleLatitude($source->getBottomHoleLatitude());
        $target->setConsultant($source->getConsultant());
        return $target;
    }
}
