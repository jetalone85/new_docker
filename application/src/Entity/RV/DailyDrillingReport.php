<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Table("rv_daily_drilling_report")
 * @ORM\Entity(repositoryClass="App\Repository\RV\DailyDrillingReportRepository")
 * @Serializer\ExclusionPolicy("all")
 *
 * @package App\Entity\RV
 */
class DailyDrillingReport
{
    use TimelogBreakdownTrait;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose()
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     * @Serializer\Expose()
     * @Serializer\Type("Date")
     *
     * @var \DateTime
     */
    protected $date;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string
     */
    protected $rigCompany;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var string
     */
    protected $rigNumber;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     *
     * @var float
     */
    protected $macpMudWeight;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     *
     * @var float
     */
    protected $pbtd;

    /**
     * SUM of $bhaComponents.length.
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     *
     * @var float
     */
    protected $bhaTotalLength = 0;

    /**
     * SUM of $bhaComponents.weight.
     *
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    protected $bhaTotalWeight = 0;

    /**
     * SUM of MudSample.fluidLoss for this day.
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     *
     * @var float
     */
    protected $mudFluidLoses = 0;

    /**
     * SUM of MudSample.fluidLoss for this and all previous days.
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     *
     * @var float
     */
    protected $mudFluidLosesCumulative = 0;

    /**
     * Avarage ROP.
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     *
     * @var float
     */
    protected $averageRop = 0;

    /**
     * Costs SUM.
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     *
     * @var float
     */
    protected $costsSum = 0;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime|null
     */
    protected $importDatetime = null;

    // RELATIONS

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="dailyDrillingReports")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     *
     * @var Project
     */
    protected $project;

    /**
     * @ORM\OneToMany(
     *     targetEntity="BhaComponent",
     *     mappedBy="dailyReport",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EXTRA_LAZY"
     * )
     *
     * @var Collection|BhaComponent[]
     */
    protected $bhaComponents;

    /**
     * @ORM\OneToMany(
     *     targetEntity="DeviationSurvey",
     *     mappedBy="dailyReport",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EXTRA_LAZY"
     * )
     * @ORM\OrderBy({"depth": "asc"})
     *
     * @var Collection|DeviationSurvey[]
     */
    protected $deviationSurveys;

    /**
     * @ORM\OneToMany(
     *     targetEntity="MudMaterial",
     *     mappedBy="dailyReport",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EXTRA_LAZY"
     * )
     *
     * @var Collection|MudMaterial[]
     */
    protected $mudMaterials;

    /**
     * @ORM\OneToMany(
     *     targetEntity="MudSample",
     *     mappedBy="dailyReport",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EXTRA_LAZY"
     * )
     *
     * @var Collection|MudSample[]
     */
    protected $mudSamples;

    /**
     * @ORM\OneToMany(
     *     targetEntity="ShaleShakerScreen",
     *     mappedBy="dailyReport",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EXTRA_LAZY"
     * )
     *
     * @var Collection|ShaleShakerScreen[]
     */
    protected $shaleShakerScreens;

    /**
     * @ORM\OneToMany(
     *     targetEntity="SolidControl",
     *     mappedBy="dailyReport",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EXTRA_LAZY"
     * )
     *
     * @var Collection|SolidControl[]
     */
    protected $solidControls;

    /**
     * @ORM\OneToMany(
     *     targetEntity="Timelog",
     *     mappedBy="dailyReport",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EXTRA_LAZY"
     * )
     * @ORM\OrderBy({"fromTime": "asc"})
     *
     * @var Collection|Timelog[]
     */
    protected $timelogs;

    /**
     * @ORM\OneToMany(
     *     targetEntity="DailyDrillingCostDetails",
     *     mappedBy="dailyReport",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EXTRA_LAZY"
     * )
     *
     *
     * @var Collection|DailyDrillingCostDetails[]
     */
    protected $dailyDrillingCostDetails;

    /**
     * @ORM\OneToMany(
     *     targetEntity="MaterialTransfer",
     *     mappedBy="dailyReport",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EXTRA_LAZY"
     * )
     *
     * @var Collection|MaterialTransfer[]
     */
    protected $MaterialTransfers;

    /**
     * @ORM\OneToMany(
     *     targetEntity="ManPowerReport",
     *     mappedBy="dailyReport",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EXTRA_LAZY"
     * )
     *
     * @var Collection|ManPowerReport[]
     */
    protected $manPowerReports;

    /**
     * @ORM\OneToMany(
     *     targetEntity="MudPumpUsage",
     *     mappedBy="dailyReport",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EXTRA_LAZY"
     * )
     *
     * @var Collection|MudPumpUsage[]
     */
    protected $mudPumpUsages;

    /**
     * @ORM\OneToMany(
     *     targetEntity="BitUsage",
     *     mappedBy="dailyDrillingReport",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EXTRA_LAZY"
     * )
     *
     * @var Collection|BitUsage[]
     */
    protected $bitRecords;

    /**
     * (string) User of the person overseeing the well offsite.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     *
     * @var User
     */
    protected $reportingTo;

    /**
     * (Can have more then one, should link to a user), Name (first/last).
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\User")
     *
     * @var Collection|User[]
     */
    protected $consultants;

    /**
     * @ORM\OneToMany(targetEntity="Update", mappedBy="dailyDrillingReport")
     * @ORM\OrderBy({"time" = "ASC"})
     *
     * @var Collection|Update[]
     */
    protected $updates;

    /**
     * @ORM\OneToOne(targetEntity="MidnightSummary", inversedBy="dailyDrillingReport")
     *
     * @var MidnightSummary
     */
    protected $midnightSummary;

    /**
     * Stores redundant timelog totals for this day as array, format:
     *  {1: {daily: 5, toDate: 10}, 2: {daily: 3, toDate: 12}}
     *  where 1,2 is time code; 5,3 is total for this day; 10,12 is total sum of this and all previous days
     *
     * @ORM\Column(type="json_array")
     *
     * @var array
     */
    protected $timelogBaseCodeTotals = array();

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\RV\RentalUsage",
     *     mappedBy="dailyDrillingReport",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EXTRA_LAZY"
     * )
     *
     * @var Collection|RentalUsage[]
     */
    protected $rentalUsages;

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\RV\RentalExtraItem",
     *     mappedBy="dailyDrillingReport",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EXTRA_LAZY"
     * )
     *
     * @var Collection|RentalUsage[]
     */
    protected $rentalExtraItemsUsage;

    /**
     * @ORM\OneToMany(targetEntity="MudUsage", mappedBy="report", cascade={"all"}, fetch="EXTRA_LAZY")
     *
     * @var Collection|MudUsage[]
     */
    protected $mudUsages;

    /**
     * @ORM\OneToMany(targetEntity="MudExtra", mappedBy="report", cascade={"all"}, fetch="EXTRA_LAZY")
     *
     * @var Collection|MudExtra[]
     */
    protected $mudExtras;

    /**
     * DailyDrillingReport constructor.
     */
    public function __construct()
    {
        $this->date = new \DateTime();
        $this->bhaComponents = new ArrayCollection();
        $this->deviationSurveys = new ArrayCollection();
        $this->mudMaterials = new ArrayCollection();
        $this->mudSamples = new ArrayCollection();
        $this->shaleShakerScreens = new ArrayCollection();
        $this->solidControls = new ArrayCollection();
        $this->timelogs = new ArrayCollection();
        $this->dailyDrillingCostDetails = new ArrayCollection();
        $this->MaterialTransfers = new ArrayCollection();
        $this->manPowerReports = new ArrayCollection();
        $this->mudPumpUsages = new ArrayCollection();
        $this->bitRecords = new ArrayCollection();
        $this->consultants = new ArrayCollection();
        $this->updates = new ArrayCollection();
        $this->rentalUsages = new ArrayCollection();
        $this->rentalExtraItemsUsage = new ArrayCollection();
    }


    /**
     * @param AfeCostReport|null $afeCostReport
     * @return float
     */
    public function calculateFieldEstimate(AfeCostReport $afeCostReport = null): float
    {
        $fieldEstimate = .0;

        foreach ($this->getDailyDrillingCostDetails() as $cost) {
            if (
                (false == is_null($afeCostReport)) &&
                (false == $this->matchCodes($cost, $afeCostReport))
            ) {
                continue;
            }

            $fieldEstimate += $cost->getAmountExcludedTax();
        }

        return $fieldEstimate;
    }

    /**
     * @param DailyDrillingCostDetails $cost
     * @param AfeCostReport $afeCostReport
     * @return bool
     */
    protected function matchCodes(DailyDrillingCostDetails $cost, AfeCostReport $afeCostReport): bool
    {
        return (
            ($afeCostReport->getAccountNumber() == $cost->getAccountNumber()) &&
            ($afeCostReport->getAccountName() == $cost->getAccountName())
        );
    }


    /**
     * @return int
     */
    public function getTotalDays()
    {
        if (($firstDailyReportDate = $this->getFirstDailyReportDate()) && ($date = $this->getDate())) {
            return (int)$date->diff($firstDailyReportDate)->format('%a');
        }

        return null;
    }

    /**
     * @return int
     */
    public function getDaysFromSpud()
    {
        if (($spudDate = $this->getSpudDate()) && ($date = $this->getDate())) {
            return (int)$date->diff($spudDate)->format('%a');
        }

        return null;
    }

    /**
     * @return \DateTime
     */
    protected function getFirstDailyReportDate()
    {
        return $this->getEvent()->getLicence()->getFirstDailyReportDate();
    }

    /**
     * @return \DateTime
     */
    protected function getSpudDate()
    {
        return $this->getEvent()->getLicence()->getSpudDate();
    }

    /**
     * @deprecated
     *
     * @return DrillingEvent
     */
    public function getEvent()
    {
        return $this->getProject()->getDrillingEvent();
    }

    /**
     * @deprecated Function moved to MidnightSummary entity.
     *
     * @return float
     */
    public function getRotatedPercent(): float
    {
        return (
        (false == is_null($midnightSummary = $this->getMidnightSummary()))
            ? $midnightSummary->getRotatedPercent()
            : .0
        );
    }

    /**
     * @deprecated Function moved to MidnightSummary entity.
     *
     * @return float
     */
    public function getSlidPercent(): float
    {
        return (
        (false == is_null($midnightSummary = $this->getMidnightSummary()))
            ? $midnightSummary->getSlidPercent()
            : .0
        );
    }

    /**
     * @return bool
     */
    public function isImported(): bool
    {
        return (false == is_null($this->getImportDatetime()));
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return DailyDrillingReport
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set rigCompany
     *
     * @param string $rigCompany
     *
     * @return DailyDrillingReport
     */
    public function setRigCompany($rigCompany)
    {
        $this->rigCompany = $rigCompany;

        return $this;
    }

    /**
     * Get rigCompany
     *
     * @return string
     */
    public function getRigCompany()
    {
        return $this->rigCompany;
    }

    /**
     * Set rigNumber
     *
     * @param integer $rigNumber
     *
     * @return DailyDrillingReport
     */
    public function setRigNumber($rigNumber)
    {
        $this->rigNumber = $rigNumber;

        return $this;
    }

    /**
     * Get rigNumber
     *
     * @return integer
     */
    public function getRigNumber()
    {
        return $this->rigNumber;
    }

    /**
     * Set macpMudWeight
     *
     * @param string $macpMudWeight
     *
     * @return DailyDrillingReport
     */
    public function setMacpMudWeight($macpMudWeight)
    {
        $this->macpMudWeight = $macpMudWeight;

        return $this;
    }

    /**
     * Get macpMudWeight
     *
     * @return string
     */
    public function getMacpMudWeight()
    {
        return $this->macpMudWeight;
    }

    /**
     * Set pbtd
     *
     * @param string $pbtd
     *
     * @return DailyDrillingReport
     */
    public function setPbtd($pbtd)
    {
        $this->pbtd = $pbtd;

        return $this;
    }

    /**
     * Get pbtd
     *
     * @return string
     */
    public function getPbtd()
    {
        return $this->pbtd;
    }

    /**
     * Set bhaTotalLength
     *
     * @param string $bhaTotalLength
     *
     * @return DailyDrillingReport
     */
    public function setBhaTotalLength($bhaTotalLength)
    {
        $this->bhaTotalLength = $bhaTotalLength;

        return $this;
    }

    /**
     * Get bhaTotalLength
     *
     * @return string
     */
    public function getBhaTotalLength()
    {
        return $this->bhaTotalLength;
    }

    /**
     * Set bhaTotalWeight
     *
     * @param integer $bhaTotalWeight
     *
     * @return DailyDrillingReport
     */
    public function setBhaTotalWeight($bhaTotalWeight)
    {
        $this->bhaTotalWeight = $bhaTotalWeight;

        return $this;
    }

    /**
     * Get bhaTotalWeight
     *
     * @return integer
     */
    public function getBhaTotalWeight()
    {
        return $this->bhaTotalWeight;
    }

    /**
     * Set mudFluidLoses
     *
     * @param string $mudFluidLoses
     *
     * @return DailyDrillingReport
     */
    public function setMudFluidLoses($mudFluidLoses)
    {
        $this->mudFluidLoses = $mudFluidLoses;

        return $this;
    }

    /**
     * Get mudFluidLoses
     *
     * @return string
     */
    public function getMudFluidLoses()
    {
        return $this->mudFluidLoses;
    }

    /**
     * Set mudFluidLosesCumulative
     *
     * @param string $mudFluidLosesCumulative
     *
     * @return DailyDrillingReport
     */
    public function setMudFluidLosesCumulative($mudFluidLosesCumulative)
    {
        $this->mudFluidLosesCumulative = $mudFluidLosesCumulative;

        return $this;
    }

    /**
     * Get mudFluidLosesCumulative
     *
     * @return string
     */
    public function getMudFluidLosesCumulative()
    {
        return $this->mudFluidLosesCumulative;
    }

    /**
     * Set averageRop
     *
     * @param string $averageRop
     *
     * @return DailyDrillingReport
     */
    public function setAverageRop($averageRop)
    {
        $this->averageRop = $averageRop;

        return $this;
    }

    /**
     * Get averageRop
     *
     * @return string
     */
    public function getAverageRop()
    {
        return $this->averageRop;
    }

    /**
     * Set costsSum
     *
     * @param string $costsSum
     *
     * @return DailyDrillingReport
     */
    public function setCostsSum($costsSum)
    {
        $this->costsSum = $costsSum;

        return $this;
    }

    /**
     * Get costsSum
     *
     * @return string
     */
    public function getCostsSum()
    {
        return $this->costsSum;
    }

    /**
     * Set importDatetime
     *
     * @param \DateTime $importDatetime
     *
     * @return DailyDrillingReport
     */
    public function setImportDatetime($importDatetime)
    {
        $this->importDatetime = $importDatetime;

        return $this;
    }

    /**
     * Get importDatetime
     *
     * @return \DateTime
     */
    public function getImportDatetime()
    {
        return $this->importDatetime;
    }

    /**
     * Set project
     *
     * @param Project $project
     *
     * @return DailyDrillingReport
     */
    public function setProject(Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Add bhaComponent
     *
     * @param BhaComponent $bhaComponent
     *
     * @return DailyDrillingReport
     */
    public function addBhaComponent(BhaComponent $bhaComponent)
    {
        $this->bhaComponents[] = $bhaComponent;

        return $this;
    }

    /**
     * Remove bhaComponent
     *
     * @param BhaComponent $bhaComponent
     */
    public function removeBhaComponent(BhaComponent $bhaComponent)
    {
        $this->bhaComponents->removeElement($bhaComponent);
    }

    /**
     * Get bhaComponents
     *
     * @return Collection
     */
    public function getBhaComponents()
    {
        return $this->bhaComponents;
    }

    /**
     * Add deviationSurvey
     *
     * @param DeviationSurvey $deviationSurvey
     *
     * @return DailyDrillingReport
     */
    public function addDeviationSurvey(DeviationSurvey $deviationSurvey)
    {
        $this->deviationSurveys[] = $deviationSurvey;

        return $this;
    }

    /**
     * Remove deviationSurvey
     *
     * @param DeviationSurvey $deviationSurvey
     */
    public function removeDeviationSurvey(DeviationSurvey $deviationSurvey)
    {
        $this->deviationSurveys->removeElement($deviationSurvey);
    }

    /**
     * Get deviationSurveys
     *
     * @return Collection
     */
    public function getDeviationSurveys()
    {
        return $this->deviationSurveys;
    }

    /**
     * Add mudMaterial
     *
     * @param MudMaterial $mudMaterial
     *
     * @return DailyDrillingReport
     */
    public function addMudMaterial(MudMaterial $mudMaterial)
    {
        $this->mudMaterials[] = $mudMaterial;

        return $this;
    }

    /**
     * Remove mudMaterial
     *
     * @param MudMaterial $mudMaterial
     */
    public function removeMudMaterial(MudMaterial $mudMaterial)
    {
        $this->mudMaterials->removeElement($mudMaterial);
    }

    /**
     * Get mudMaterials
     *
     * @return Collection
     */
    public function getMudMaterials()
    {
        return $this->mudMaterials;
    }

    /**
     * Add mudSample
     *
     * @param MudSample $mudSample
     *
     * @return DailyDrillingReport
     */
    public function addMudSample(MudSample $mudSample)
    {
        $this->mudSamples[] = $mudSample;

        return $this;
    }

    /**
     * Remove mudSample
     *
     * @param MudSample $mudSample
     */
    public function removeMudSample(MudSample $mudSample)
    {
        $this->mudSamples->removeElement($mudSample);
    }

    /**
     * Get mudSamples
     *
     * @return Collection
     */
    public function getMudSamples()
    {
        return $this->mudSamples;
    }

    /**
     * Add shaleShakerScreen
     *
     * @param ShaleShakerScreen $shaleShakerScreen
     *
     * @return DailyDrillingReport
     */
    public function addShaleShakerScreen(ShaleShakerScreen $shaleShakerScreen)
    {
        $this->shaleShakerScreens[] = $shaleShakerScreen;

        return $this;
    }

    /**
     * Remove shaleShakerScreen
     *
     * @param ShaleShakerScreen $shaleShakerScreen
     */
    public function removeShaleShakerScreen(ShaleShakerScreen $shaleShakerScreen)
    {
        $this->shaleShakerScreens->removeElement($shaleShakerScreen);
    }

    /**
     * Get shaleShakerScreens
     *
     * @return Collection
     */
    public function getShaleShakerScreens()
    {
        return $this->shaleShakerScreens;
    }

    /**
     * Add solidControl
     *
     * @param SolidControl $solidControl
     *
     * @return DailyDrillingReport
     */
    public function addSolidControl(SolidControl $solidControl)
    {
        $this->solidControls[] = $solidControl;

        return $this;
    }

    /**
     * Remove solidControl
     *
     * @param SolidControl $solidControl
     */
    public function removeSolidControl(SolidControl $solidControl)
    {
        $this->solidControls->removeElement($solidControl);
    }

    /**
     * Get solidControls
     *
     * @return Collection
     */
    public function getSolidControls()
    {
        return $this->solidControls;
    }

    /**
     * Add timelog
     *
     * @param Timelog $timelog
     *
     * @return DailyDrillingReport
     */
    public function addTimelog(Timelog $timelog)
    {
        $this->timelogs[] = $timelog;

        return $this;
    }

    /**
     * Remove timelog
     *
     * @param Timelog $timelog
     */
    public function removeTimelog(Timelog $timelog)
    {
        $this->timelogs->removeElement($timelog);
    }

    /**
     * Get timelogs
     *
     * @return Collection
     */
    public function getTimelogs()
    {
        return $this->timelogs;
    }

    /**
     * Add dailyDrillingCostDetail
     *
     * @param DailyDrillingCostDetails $dailyDrillingCostDetail
     *
     * @return DailyDrillingReport
     */
    public function addDailyDrillingCostDetail(DailyDrillingCostDetails $dailyDrillingCostDetail)
    {
        $this->dailyDrillingCostDetails[] = $dailyDrillingCostDetail;

        return $this;
    }

    /**
     * Remove dailyDrillingCostDetail
     *
     * @param DailyDrillingCostDetails $dailyDrillingCostDetail
     */
    public function removeDailyDrillingCostDetail(DailyDrillingCostDetails $dailyDrillingCostDetail)
    {
        $this->dailyDrillingCostDetails->removeElement($dailyDrillingCostDetail);
    }

    /**
     * Get dailyDrillingCostDetails
     *
     * @return Collection|DailyDrillingCostDetails[]
     */
    public function getDailyDrillingCostDetails()
    {
        return $this->dailyDrillingCostDetails;
    }

    /**
     * @param MaterialTransfer $transfer
     * @return DailyDrillingReport
     */
    public function addMaterialTransfer(MaterialTransfer $transfer)
    {
        $this->MaterialTransfers[] = $transfer;

        return $this;
    }

    /**
     * @param MaterialTransfer $transfer
     */
    public function removeMaterialTransfer(MaterialTransfer $transfer)
    {
        $this->MaterialTransfers->removeElement($transfer);
    }

    /**
     * @return Collection|MaterialTransfer[]
     */
    public function getMaterialTransfers()
    {
        return $this->MaterialTransfers;
    }


    /**
     * Add manPowerReport
     *
     * @param ManPowerReport $manPowerReport
     *
     * @return DailyDrillingReport
     */
    public function addManPowerReport(ManPowerReport $manPowerReport)
    {
        $this->manPowerReports[] = $manPowerReport;

        return $this;
    }

    /**
     * Remove manPowerReport
     *
     * @param ManPowerReport $manPowerReport
     */
    public function removeManPowerReport(ManPowerReport $manPowerReport)
    {
        $this->manPowerReports->removeElement($manPowerReport);
    }

    /**
     * Get manPowerReports
     *
     * @return Collection|ManPowerReport[]
     */
    public function getManPowerReports()
    {
        return $this->manPowerReports;
    }

    /**
     * Add mudPumpUsage
     *
     * @param MudPumpUsage $mudPumpUsage
     *
     * @return DailyDrillingReport
     */
    public function addMudPumpUsage(MudPumpUsage $mudPumpUsage)
    {
        $this->mudPumpUsages[] = $mudPumpUsage;

        return $this;
    }

    /**
     * Remove mudPumpUsage
     *
     * @param MudPumpUsage $mudPumpUsage
     */
    public function removeMudPumpUsage(MudPumpUsage $mudPumpUsage)
    {
        $this->mudPumpUsages->removeElement($mudPumpUsage);
    }

    /**
     * Get mudPumpUsages
     *
     * @return Collection|MudPumpUsage[]
     */
    public function getMudPumpUsages()
    {
        return $this->mudPumpUsages;
    }

    /**
     * Add bitRecord
     *
     * @param BitUsage $bitRecord
     *
     * @return DailyDrillingReport
     */
    public function addBitRecord(BitUsage $bitRecord)
    {
        $this->bitRecords[] = $bitRecord;

        return $this;
    }

    /**
     * Remove bitRecord
     *
     * @param BitUsage $bitRecord
     */
    public function removeBitRecord(BitUsage $bitRecord)
    {
        $this->bitRecords->removeElement($bitRecord);
    }

    /**
     * Get bitRecords
     *
     * @return Collection|BitUsage[]
     */
    public function getBitRecords()
    {
        return $this->bitRecords;
    }

    /**
     * Set reportingTo
     *
     * @param User $reportingTo
     *
     * @return DailyDrillingReport
     */
    public function setReportingTo(User $reportingTo = null)
    {
        $this->reportingTo = $reportingTo;

        return $this;
    }

    /**
     * Get reportingTo
     *
     * @return User
     */
    public function getReportingTo()
    {
        return $this->reportingTo;
    }

    /**
     * Add consultant
     *
     * @param User $consultant
     *
     * @return DailyDrillingReport
     */
    public function addConsultant(User $consultant)
    {
        $this->consultants[] = $consultant;

        return $this;
    }

    /**
     * Remove consultant
     *
     * @param User $consultant
     */
    public function removeConsultant(User $consultant)
    {
        $this->consultants->removeElement($consultant);
    }

    /**
     * Get consultants
     *
     * @return Collection|User[]
     */
    public function getConsultants()
    {
        return $this->consultants;
    }

    /**
     * Add update
     *
     * @param Update $update
     *
     * @return DailyDrillingReport
     */
    public function addUpdate(Update $update)
    {
        $this->updates[] = $update;

        return $this;
    }

    /**
     * Remove update
     *
     * @param Update $update
     */
    public function removeUpdate(Update $update)
    {
        $this->updates->removeElement($update);
    }

    /**
     * Get updates
     *
     * @return Collection|Update[]
     */
    public function getUpdates()
    {
        return $this->updates;
    }

    /**
     * Set midnightSummary
     *
     * @param MidnightSummary $midnightSummary
     *
     * @return DailyDrillingReport
     */
    public function setMidnightSummary(MidnightSummary $midnightSummary = null)
    {
        $this->midnightSummary = $midnightSummary;

        return $this;
    }

    /**
     * Get midnightSummary
     *
     * @return MidnightSummary
     */
    public function getMidnightSummary()
    {
        return $this->midnightSummary;
    }

    /**
     * @return array
     */
    public function getTimelogBaseCodeTotals()//: ?array
    {
        return $this->timelogBaseCodeTotals;
    }

    /**
     * @param array $timelogBaseCodeTotals
     * @return $this
     */
    public function setTimelogBaseCodeTotals(array $timelogBaseCodeTotals = null)
    {
        $this->timelogBaseCodeTotals = $timelogBaseCodeTotals;
        return $this;
    }

    /**
     * Add RentalUsage
     *
     * @param RentalUsage $rentalUsage
     * @return DailyDrillingReport
     */
    public function addRentalUsage(RentalUsage $rentalUsage)
    {
        $this->rentalUsages[] = $rentalUsage;

        return $this;
    }

    /**
     * Remove RentalUsage
     *
     * @param RentalUsage $rentalUsage
     */
    public function removeRentalItem(RentalUsage $rentalUsage)
    {
        $this->rentalUsages->removeElement($rentalUsage);
    }

    /**
     * Get RentalUsage
     *
     * @return Collection
     */
    public function getRentalUsages()
    {
        return $this->rentalUsages;
    }


    /**
     * Add RentalExtraItem
     *
     * @param RentalExtraItem $rentalExtraItem
     * @return DailyDrillingReport
     */
    public function addRentalExtraItemsUsage(RentalExtraItem $rentalExtraItem)
    {
        $this->rentalExtraItemsUsage[] = $rentalExtraItem;

        return $this;
    }

    /**
     * Remove RentalExtraItem
     *
     * @param RentalExtraItem $rentalExtraItem
     */
    public function removeRentalExtraItemsItem(RentalExtraItem $rentalExtraItem)
    {
        $this->rentalExtraItemsUsage->removeElement($rentalExtraItem);
    }

    /**
     * Add mudUsage
     *
     * @param \App\Entity\RV\MudUsage $mudUsage
     *
     * @return DailyDrillingReport
     */
    public function addMudUsage(\App\Entity\RV\MudUsage $mudUsage)
    {
        $this->mudUsages[] = $mudUsage;

        return $this;
    }

    /**
     * Remove mudUsage
     *
     * @param \App\Entity\RV\MudUsage $mudUsage
     */
    public function removeMudUsage(\App\Entity\RV\MudUsage $mudUsage)
    {
        $this->mudUsages->removeElement($mudUsage);
    }

    /**
     * Get mudUsages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMudUsages()
    {
        return $this->mudUsages;
    }

    /**
     * Add mudExtra
     *
     * @param \App\Entity\RV\MudExtra $mudExtra
     *
     * @return DailyDrillingReport
     */
    public function addMudExtra(\App\Entity\RV\MudExtra $mudExtra)
    {
        $this->mudExtras[] = $mudExtra;

        return $this;
    }

    /**
     * Remove mudExtra
     *
     * @param \App\Entity\RV\MudExtra $mudExtra
     */
    public function removeMudExtra(\App\Entity\RV\MudExtra $mudExtra)
    {
        $this->mudExtras->removeElement($mudExtra);
    }

    /**
     * Get mudExtras
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMudExtras()
    {
        return $this->mudExtras;
    }

    /**
     * Get RentalExtraItem
     *
     * @return Collection
     */
    public function getRentalExtraItemsUsages()
    {
        return $this->rentalExtraItemsUsage;
    }
 
    public function __toString()
    {
        return $this->getDate()->format('Y-m-d');
    }
}
