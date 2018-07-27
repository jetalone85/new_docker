<?php

namespace App\Entity\RV;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * DrillingEvent class.
 *
 * @ORM\Entity(repositoryClass="App\Repository\RV\DrillingEventRepository")
 * @ORM\Table(name="rv_drilling_events")
 *
 * @package App\Entity\RV
 */
class DrillingEvent
{

    /**
     * @var integer
     */
    const FORMAT_MANUAL_ENTRY = 0;

    /**
     * @var integer
     */
    const FORMAT_DLS = 1;

    /**
     * @var integer
     */
    const FORMAT_NTS = 2;


    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    public $id;

    /**
     * @ORM\OneToMany(targetEntity="Project", mappedBy="drillingEvent")
     *
     * @var Collection|Project[]
     */
    protected $projects;

    /**
     * @var Licence
     * @ORM\ManyToOne(targetEntity="Licence", inversedBy="drillingEvents")
     * @ORM\JoinColumn(name="licence_id", referencedColumnName="id")
     *
     * @var Licence
     */
    public $licence;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    public $uwi;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    public $landSystem;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotEqualTo(value=1)
     * @Assert\Range(min=0, max=9)
     *
     * @var integer
     */
    public $wellsDrilled;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotEqualTo(value=1)
     * @Assert\Range(min=0, max=9)
     *
     * @var integer
     */
    public $eventNo;

    /* DLS SPECIFIC */

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotNull(message="Please choose an LSD", groups={"DLS"})
     * @Assert\Range(min=1, max=16)
     *
     * @var integer
     */
    public $dlsLsd;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotNull(message="Please choose a section", groups={"DLS"})
     * @Assert\Range(min=1, max=36)
     *
     * @var integer
     */
    public $dlsSection;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotNull(message="Please choose a township", groups={"DLS"})
     * @Assert\Range(min=1, max=128)
     *
     * @var integer
     */
    public $dlsTownship;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotNull(message="Please choose a range", groups={"DLS"})
     * @Assert\Range(min=1, max=35)
     *
     * @var integer
     */
    public $dlsRange;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     * @Assert\NotNull(message="Please choose a meridian", groups={"DLS"})
     * @Assert\Regex("/^W[1-7]|E1|Coast$/")
     *
     * @var string
     */
    public $dlsMeridian;

    /* NTS SPECIFIC */

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     * @Assert\NotNull(message="Please choose a Quarter Unit", groups={"NTS"})
     * @Assert\Regex("/^[A-D]$/")
     *
     * @var string
     */
    public $ntsQuarterUnit;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotNull(message="Please choose a unit", groups={"NTS"})
     * @Assert\Range(min=1, max=100)
     *
     * @var integer
     */
    public $ntsUnit;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     * @Assert\NotNull(message="Please choose a block", groups={"NTS"})
     * @Assert\Regex("/^[A-L]$/")
     *
     * @var string
     */
    public $ntsBlock;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotNull(message="Please choose a series", groups={"NTS"})
     * @Assert\Range(min=0, max=110)
     *
     * @var integer
     */
    public $ntsSeries;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     * @Assert\NotNull(message="Please choose an area", groups={"NTS"})
     * @Assert\Regex("/^[A-P]$/")
     *
     * @var string
     */
    public $ntsArea;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotNull(message="Please choose a sheet", groups={"NTS"})
     * @Assert\Range(min=1, max=16)
     *
     * @var integer
     */
    public $ntsSheet;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string
     */
    public $daysDrilled;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     *
     * @var float
     */
    public $depthStart;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     *
     * @var float
     */
    public $depthEnd;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string
     */
    public $endFormation;

    /**
     * @ORM\Column(type="date", nullable=true)
     *
     * @var \DateTime
     */
    public $spudDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     *
     * @var \DateTime
     */
    public $rigReleaseDate;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     *
     * @var float
     */
    public $startLat;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     *
     * @var float
     */
    public $startLng;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     *
     * @var float
     */
    public $endLat;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     *
     * @var float
     */
    public $endLng;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\RV\Prognosis", mappedBy="event")
     */
    private $prognosis;

    /**
     * DrillingEvent constructor.
     */
    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->directionalSurveys = new ArrayCollection();
        $this->afeCostReports = new ArrayCollection();
        $this->productivityItems = new ArrayCollection();
    }

    public function setAfeCostReports($AFE)
    {
        $this->afeCostReports = $AFE;
    }


    public function getAfeCostReportsTotals()
    {
        $totals = [
            'afeEstimate' => 0,
            'fieldEstimate' => 0,
            'dollarDifference' => 0,
            'percentOfAfe' => 0,
            'projectedDifference' => 0,
        ];

        foreach ($this->getAfeCostReports() as $report) {
            $totals['afeEstimate'] += $report->getAfeEstimate();
            $totals['fieldEstimate'] += $report->getFieldEstimate();
        }

        $totals['dollarDifference'] = $totals['afeEstimate'] - $totals['fieldEstimate'];

        if (0 == $totals['afeEstimate']) {
            $totals['percentOfAfe'] = 0;
        } else {
            $totals['percentOfAfe'] = round(($totals['fieldEstimate'] / $totals['afeEstimate']) * 100);
        }

        return $totals;
    }

    public function addAfeCostReports(AfeCostReport $AFE)
    {
        $AFE->setEvent($this);
        $this->afeCostReports->add($AFE);
    }


    public function addProductivityItems(ProductivityItem $Costs)
    {
        $Costs->setEvent($this);
        $this->productivityItems->add($Costs);
    }

    public static function getFormatSelection()
    {
        return array(
            'DLS' => static::FORMAT_DLS,
            'NTS' => static::FORMAT_NTS,
            'Manual Entry' => static::FORMAT_MANUAL_ENTRY,
        );
    }

    public static function getNumEventsSelection()
    {
        return array(
            '1st' => 0,
            '2nd' => 2,
            '3rd' => 3,
            '4th' => 4,
            '5th' => 5,
            '6th' => 6,
            '7th' => 7,
            '8th' => 8,
            '9th' => 9,
        );
    }

    public static function getDlsLsdValues()
    {
        return range(1, 16);
    }

    public static function getDlsLsdSelection()
    {
        return array_combine(self::getDlsLsdValues(), self::getDlsLsdValues());
    }

    public static function getDlsSectionValues()
    {
        return range(1, 36);
    }

    public static function getDlsSectionSelection()
    {
        return array_combine(self::getDlsSectionValues(), self::getDlsSectionValues());
    }

    public static function getDlsTownshipValues()
    {
        return range(1, 128);
    }

    public static function getDlsTownshipSelection()
    {
        return array_combine(self::getDlsTownshipValues(), self::getDlsTownshipValues());
    }

    public static function getDlsRangeValues()
    {
        return range(1, 35);
    }

    public static function getDlsRangeSelection()
    {
        return array_combine(self::getDlsRangeValues(), self::getDlsRangeValues());
    }

    public static function getDlsMeridianValues()
    {
        return array('W7', 'W6', 'W5', 'W4', 'W3', 'W2', 'W1', 'E1', 'Coast');
    }

    public static function getDlsMeridianSelection()
    {
        return array_combine(self::getDlsMeridianValues(), self::getDlsMeridianValues());
    }

    public static function getNtsQuarterUnitValues()
    {
        return range('A', 'D');
    }

    public static function getNtsQuarterUnitSelection()
    {
        return array_combine(self::getNtsQuarterUnitValues(), self::getNtsQuarterUnitValues());
    }

    public static function getNtsUnitValues()
    {
        return range(1, 100);
    }

    public static function getNtsUnitSelection()
    {
        return array_combine(self::getNtsUnitValues(), self::getNtsUnitValues());
    }

    public static function getNtsBlockValues()
    {
        return range('A', 'L');
    }

    public static function getNtsBlockSelection()
    {
        return array_combine(self::getNtsBlockValues(), self::getNtsBlockValues());
    }

    public static function getNtsSeriesValues()
    {
        return range(0, 110);
    }

    public static function getNtsSeriesSelection()
    {
        return array_combine(self::getNtsSeriesValues(), self::getNtsSeriesValues());
    }

    public static function getNtsAreaValues()
    {
        return range('A', 'P');
    }

    public static function getNtsAreaSelection()
    {
        return array_combine(self::getNtsAreaValues(), self::getNtsAreaValues());
    }

    public static function getNtsSheetValues()
    {
        return range(1, 16);
    }

    public static function getNtsSheetSelection()
    {
        return array_combine(self::getNtsSheetValues(), self::getNtsSheetValues());
    }

    public function getManPowerReportsTotals()
    {
        $totals = [
            'personnel' => 0,
            'dailyHours' => 0,
        ];

        foreach ($this->getDailyDrillingReports() as $drillingReport) {
            foreach ($drillingReport->getManPowerReports() as $report) {
                $totals['personnel'] += $report->getNumberOfPersons();
                $totals['dailyHours'] += $report->getTotalHours();
            }
        }

        return $totals;
    }

    ///**
    // * @param ArrayCollection|DailyDrillingReport[] $dailyDrillingReports
    // * @return $this
    // */
    //public function setDailyDrillingReports($dailyDrillingReports = null)
    //{
    //    $this->dailyDrillingReports = $dailyDrillingReports;
    //    return $this;
    //}

    /**
     * @return Collection|AfeCostReport[]
     */
    public function getAfeCostReports()
    {
        $afeCostReports = new ArrayCollection();

        /** @var Project $project */
        foreach ($this->getProjects() as $project) {
            foreach ($project->getAfeCostReports() as $afeCostReport) {
                $afeCostReports->add($afeCostReport);
            }
        }

        return $afeCostReports;
    }

    /**
     * @return Collection|DailyDrillingReport[]
     */
    public function getDailyDrillingReports()
    {
        $dailyDrillingReports = new ArrayCollection();

        /** @var Project $project */
        foreach ($this->getProjects() as $project) {
            foreach ($project->getDailyDrillingReports() as $dailyDrillingReport) {
                $dailyDrillingReports->add($dailyDrillingReport);
            }
        }

        return $dailyDrillingReports;
    }

    /**
     * @param null $orderBy
     * @return array|Collection[]
     */
    public function getDirectionalSurveys($orderBy = null)
    {
        $directionalSurveys = new ArrayCollection();

        /** @var Project $project */
        foreach ($this->getProjects() as $project) {
            foreach ($project->getDirectionalSurveys() as $directionalSurvey) {
                $directionalSurveys->add($directionalSurvey);
            }
        }

        if (false == is_null($orderBy)) {
            $directionalSurveys = $directionalSurveys->toArray();
            usort($directionalSurveys, $this->getDirectionalSurveysSortCallback($orderBy));
        }

        return $directionalSurveys;
    }

    /**
     * @param null $orderBy
     * @return \Closure
     */
    protected function getDirectionalSurveysSortCallback($orderBy = null)
    {
        $propertyAccessor = new PropertyAccessor();

        return function ($left, $right) use ($orderBy, $propertyAccessor) {
            if (
                ($leftValue = $propertyAccessor->getValue($left, $orderBy)) ==
                ($rightValue = $propertyAccessor->getValue($right, $orderBy))
            ) {
                return 0;
            }

            return $leftValue > $rightValue;
        };
    }

    /**
     * @return Collection|ProductivityItem[]
     */
    public function getProductivityItems()
    {
        $productivityItems = new ArrayCollection();

        /** @var Project $project */
        foreach ($this->getProjects() as $project) {
            foreach ($project->getProductivityItems() as $productivityItem) {
                $productivityItems->add($productivityItem);
            }
        }

        return $productivityItems;
    }

    /**
     * @return Collection|CasingSegment[]
     */
    public function getCasingSegments()
    {
        $casingSegments = new ArrayCollection();

        /** @var Project $project */
        foreach ($this->getProjects() as $project) {
            foreach ($project->getCasingSegments() as $casingSegment) {
                $casingSegments->add($casingSegment);
            }
        }

        return $casingSegments;
    }


    /**
     * @param ArrayCollection|DirectionalSurvey[] $directionalSurveys
     * @return $this
     */
    public function setDirectionalSurveys($directionalSurveys = null)
    {
        $this->directionalSurveys = $directionalSurveys;
        return $this;
    }

    public function setProductivityItems($Costs)
    {
        $this->productivityItems = $Costs;
    }

    public function getProductivityItemsTotals()
    {
        $totals = [
            'hours' => 0,
            'cost' => 0,
        ];

        foreach ($this->getProductivityItems() as $report) {
            $totals['hours'] += $report->getHours();
            $totals['cost'] += $report->getCost();
        }

        return $totals;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set uwi
     *
     * @param string $uwi
     *
     * @return DrillingEvent
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
     * Set landSystem
     *
     * @param string $landSystem
     *
     * @return DrillingEvent
     */
    public function setLandSystem($landSystem)
    {
        $this->landSystem = $landSystem;

        return $this;
    }

    /**
     * Get landSystem
     *
     * @return string
     */
    public function getLandSystem()
    {
        return $this->landSystem;
    }

    /**
     * Set wellsDrilled
     *
     * @param integer $wellsDrilled
     *
     * @return DrillingEvent
     */
    public function setWellsDrilled($wellsDrilled)
    {
        $this->wellsDrilled = $wellsDrilled;

        return $this;
    }

    /**
     * Get wellsDrilled
     *
     * @return integer
     */
    public function getWellsDrilled()
    {
        return $this->wellsDrilled;
    }

    /**
     * Set eventNo
     *
     * @param integer $eventNo
     *
     * @return DrillingEvent
     */
    public function setEventNo($eventNo)
    {
        $this->eventNo = $eventNo;

        return $this;
    }

    /**
     * Get eventNo
     *
     * @return integer
     */
    public function getEventNo()
    {
        return $this->eventNo;
    }

    /**
     * Set dlsLsd
     *
     * @param integer $dlsLsd
     *
     * @return DrillingEvent
     */
    public function setDlsLsd($dlsLsd)
    {
        $this->dlsLsd = $dlsLsd;

        return $this;
    }

    /**
     * Get dlsLsd
     *
     * @return integer
     */
    public function getDlsLsd()
    {
        return $this->dlsLsd;
    }

    /**
     * Set dlsSection
     *
     * @param integer $dlsSection
     *
     * @return DrillingEvent
     */
    public function setDlsSection($dlsSection)
    {
        $this->dlsSection = $dlsSection;

        return $this;
    }

    /**
     * Get dlsSection
     *
     * @return integer
     */
    public function getDlsSection()
    {
        return $this->dlsSection;
    }

    /**
     * Set dlsTownship
     *
     * @param integer $dlsTownship
     *
     * @return DrillingEvent
     */
    public function setDlsTownship($dlsTownship)
    {
        $this->dlsTownship = $dlsTownship;

        return $this;
    }

    /**
     * Get dlsTownship
     *
     * @return integer
     */
    public function getDlsTownship()
    {
        return $this->dlsTownship;
    }

    /**
     * Set dlsRange
     *
     * @param integer $dlsRange
     *
     * @return DrillingEvent
     */
    public function setDlsRange($dlsRange)
    {
        $this->dlsRange = $dlsRange;

        return $this;
    }

    /**
     * Get dlsRange
     *
     * @return integer
     */
    public function getDlsRange()
    {
        return $this->dlsRange;
    }

    /**
     * Set dlsMeridian
     *
     * @param string $dlsMeridian
     *
     * @return DrillingEvent
     */
    public function setDlsMeridian($dlsMeridian)
    {
        $this->dlsMeridian = $dlsMeridian;

        return $this;
    }

    /**
     * Get dlsMeridian
     *
     * @return string
     */
    public function getDlsMeridian()
    {
        return $this->dlsMeridian;
    }

    /**
     * Set ntsQuarterUnit
     *
     * @param string $ntsQuarterUnit
     *
     * @return DrillingEvent
     */
    public function setNtsQuarterUnit($ntsQuarterUnit)
    {
        $this->ntsQuarterUnit = $ntsQuarterUnit;

        return $this;
    }

    /**
     * Get ntsQuarterUnit
     *
     * @return string
     */
    public function getNtsQuarterUnit()
    {
        return $this->ntsQuarterUnit;
    }

    /**
     * Set ntsUnit
     *
     * @param integer $ntsUnit
     *
     * @return DrillingEvent
     */
    public function setNtsUnit($ntsUnit)
    {
        $this->ntsUnit = $ntsUnit;

        return $this;
    }

    /**
     * Get ntsUnit
     *
     * @return integer
     */
    public function getNtsUnit()
    {
        return $this->ntsUnit;
    }

    /**
     * Set ntsBlock
     *
     * @param integer $ntsBlock
     *
     * @return DrillingEvent
     */
    public function setNtsBlock($ntsBlock)
    {
        $this->ntsBlock = $ntsBlock;

        return $this;
    }

    /**
     * Get ntsBlock
     *
     * @return integer
     */
    public function getNtsBlock()
    {
        return $this->ntsBlock;
    }

    /**
     * Set ntsSeries
     *
     * @param integer $ntsSeries
     *
     * @return DrillingEvent
     */
    public function setNtsSeries($ntsSeries)
    {
        $this->ntsSeries = $ntsSeries;

        return $this;
    }

    /**
     * Get ntsSeries
     *
     * @return integer
     */
    public function getNtsSeries()
    {
        return $this->ntsSeries;
    }

    /**
     * Set ntsArea
     *
     * @param string $ntsArea
     *
     * @return DrillingEvent
     */
    public function setNtsArea($ntsArea)
    {
        $this->ntsArea = $ntsArea;

        return $this;
    }

    /**
     * Get ntsArea
     *
     * @return string
     */
    public function getNtsArea()
    {
        return $this->ntsArea;
    }

    /**
     * Set ntsSheet
     *
     * @param integer $ntsSheet
     *
     * @return DrillingEvent
     */
    public function setNtsSheet($ntsSheet)
    {
        $this->ntsSheet = $ntsSheet;

        return $this;
    }

    /**
     * Get ntsSheet
     *
     * @return integer
     */
    public function getNtsSheet()
    {
        return $this->ntsSheet;
    }

    /**
     * Set daysDrilled
     *
     * @param string $daysDrilled
     *
     * @return DrillingEvent
     */
    public function setDaysDrilled($daysDrilled)
    {
        $this->daysDrilled = $daysDrilled;

        return $this;
    }

    /**
     * Get daysDrilled
     *
     * @return string
     */
    public function getDaysDrilled()
    {
        return $this->daysDrilled;
    }

    /**
     * Set depthStart
     *
     * @param string $depthStart
     *
     * @return DrillingEvent
     */
    public function setDepthStart($depthStart)
    {
        $this->depthStart = $depthStart;

        return $this;
    }

    /**
     * Get depthStart
     *
     * @return string
     */
    public function getDepthStart()
    {
        return $this->depthStart;
    }

    /**
     * Set depthEnd
     *
     * @param string $depthEnd
     *
     * @return DrillingEvent
     */
    public function setDepthEnd($depthEnd)
    {
        $this->depthEnd = $depthEnd;

        return $this;
    }

    /**
     * Get depthEnd
     *
     * @return string
     */
    public function getDepthEnd()
    {
        return $this->depthEnd;
    }

    /**
     * Set endFormation
     *
     * @param string $endFormation
     *
     * @return DrillingEvent
     */
    public function setEndFormation($endFormation)
    {
        $this->endFormation = $endFormation;

        return $this;
    }

    /**
     * Get endFormation
     *
     * @return string
     */
    public function getEndFormation()
    {
        return $this->endFormation;
    }

    /**
     * Set spudDate
     *
     * @param \DateTime $spudDate
     *
     * @return DrillingEvent
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
     * @return DrillingEvent
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
     * Set startLat
     *
     * @param string $startLat
     *
     * @return DrillingEvent
     */
    public function setStartLat($startLat)
    {
        $this->startLat = $startLat;

        return $this;
    }

    /**
     * Get startLat
     *
     * @return string
     */
    public function getStartLat()
    {
        return $this->startLat;
    }

    /**
     * Set startLng
     *
     * @param string $startLng
     *
     * @return DrillingEvent
     */
    public function setStartLng($startLng)
    {
        $this->startLng = $startLng;

        return $this;
    }

    /**
     * Get startLng
     *
     * @return string
     */
    public function getStartLng()
    {
        return $this->startLng;
    }

    /**
     * Set endLat
     *
     * @param string $endLat
     *
     * @return DrillingEvent
     */
    public function setEndLat($endLat)
    {
        $this->endLat = $endLat;

        return $this;
    }

    /**
     * Get endLat
     *
     * @return string
     */
    public function getEndLat()
    {
        return $this->endLat;
    }

    /**
     * Set endLng
     *
     * @param string $endLng
     *
     * @return DrillingEvent
     */
    public function setEndLng($endLng)
    {
        $this->endLng = $endLng;

        return $this;
    }

    /**
     * Get endLng
     *
     * @return string
     */
    public function getEndLng()
    {
        return $this->endLng;
    }

    /**
     * Add project
     *
     * @param Project $project
     *
     * @return DrillingEvent
     */
    public function addProject(Project $project)
    {
        $this->projects[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param Project $project
     */
    public function removeProject(Project $project)
    {
        $this->projects->removeElement($project);
    }

    /**
     * Get projects
     *
     * @return Collection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * Set licence
     *
     * @param Licence $licence
     *
     * @return DrillingEvent
     */
    public function setLicence(Licence $licence = null)
    {
        $this->licence = $licence;

        return $this;
    }

    /**
     * Get licence
     *
     * @return Licence
     */
    public function getLicence()
    {
        return $this->licence;
    }

    /**
     * @return mixed
     */
    public function getPrognosis()
    {
        return $this->prognosis;
    }

    /**
     * @param mixed $prognosis
     */
    public function setPrognosis($prognosis)
    {
        $this->prognosis = $prognosis;
    }
}
