<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Shared\Company;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RV\LicenceRepository")
 * @ORM\Table(name="rv_well_licences")
 *
 * @package App\Entity\RV
 */
class Licence
{
    use TimelogBreakdownTrait;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $licenceNo;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $surfaceLocation;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $wellName;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $laheeClass;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $drillingOperation;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $strike;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $wellPurpose;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $mineralRights;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $wellType;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $groundElevation;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $substance;

    /**
     * Date and time when well is spudded (when the drilling rig breaks ground).
     *
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    protected $spudDate;

    /**
     *  Date and time when the rig has finished.
     *
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    protected $rigRelease;

    /**
     * @ORM\Column(type="date", nullable=true)
     *
     * @var \DateTime
     */
    protected $finishedDrillingDate;

    /**
     * Surface elevation before any landscaping has been done.
     *
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     *
     * @var float
     */
    protected $ground;

    /**
     * can be negative, surface elevation after the landscaping has either raised or lowered the location.
     *
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     *
     * @var float
     */
    protected $cutOrFill;

    /**
     * Distance from the Kelly Bushing, (part of rig floor) to the ground.
     *
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     *
     * @var float
     */
    protected $kbGround;

    /**
     * Id to identify the Authorization For Expenditure document.
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string
     */
    protected $afeId;

    /**
     * ($ Decimal), Estimated cost of the project.
     *
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     *
     * @var float
     */
    protected $afeEstimate;

    /**
     * Total Cost ($ Decimal), Actual to date cost of the well (calculated from the total of each days entered costs).
     *
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Serializer\Exclude()
     *
     * @var float
     */
    protected $totalCost;

    /**
     * Redundant field to store first daily drilling report date.
     *
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    protected $firstDailyReportDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    protected $lastDailyReportDate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     *
     * @var boolean
     */
    protected $deleted;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    protected $deletedAt;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Required()
     *
     * @var string
     */
    protected $jurisdiction;

    /**
     * @ORM\Column(name="terminating_zone", type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $terminatingZone;

    /**
     * @ORM\Column(name="latitude_utm", type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $latitudeUtm;

    /**
     * @ORM\Column(name="longitude_utm", type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $longitudeUtm;

    /**
     * @ORM\OneToOne(targetEntity="CasingBowl", mappedBy="licence")
     *
     * @var CasingBowl
     */
    protected $casingBowl;


    /**
     * @ORM\OneToMany(targetEntity="BopDrill", mappedBy="licence")
     * @ORM\OrderBy({"date" = "DESC"})
     *
     * @var Collection|BopDrill[]
     */
    protected $bopDrills;

    /**
     * @ORM\OneToMany(targetEntity="PressureTest", mappedBy="licence")
     * @ORM\OrderBy({"date" = "DESC"})
     *
     * @var Collection|PressureTest[]
     */
    protected $pressureTests;

    /**
     * @ORM\OneToMany(targetEntity="SafetyMeeting", mappedBy="licence")
     *
     * @var Collection|SafetyMeeting[]
     */
    protected $safetyMeetings;

    /**
     * @ORM\OneToMany(targetEntity="DrillingEvent", mappedBy="licence", cascade={"all"}, fetch="EAGER")
     *
     * @var Collection|DrillingEvent[]
     */
    protected $drillingEvents;

    /**
     * @ORM\OneToMany(targetEntity="MudPump", mappedBy="licence", cascade={"all"}, fetch="EXTRA_LAZY")
     *
     * @var Collection|MudPump[]
     */
    protected $mudPumps;

    /**
     * @ORM\OneToMany(targetEntity="Bit", mappedBy="licence")
     *
     * @var Collection|Bit[]
     */
    protected $bits;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Shared\Company", inversedBy="licences")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     *
     * @var Company
     */
    protected $operator;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\RV\Prognosis", mappedBy="licence")
     */
    private $prognosis;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->drillingRigs = new ArrayCollection();
        $this->bopDrills = new ArrayCollection();
        $this->pressureTests = new ArrayCollection();
        $this->safetyMeetings = new ArrayCollection();
        $this->drillingEvents = new ArrayCollection();
        $this->mudPumps = new ArrayCollection();
        $this->bits = new ArrayCollection();
    }


    /**
     * @return array
     */
    public function getDirectionalSurveysByDate()
    {
        $surveysByDate = [];
        foreach ($this->getDrillingEvents() as $event) {
            foreach ($event->getDirectionalSurveys() as $survey) {
                $date = $survey->getDate()->format('Y-m-d H:i:s');
                if (!isset($surveysByDate[$date])) {
                    $surveysByDate[$date] = [
                        'date' => $survey->getDate(),
                        'surveys' => [],
                    ];
                }
                $surveysByDate[$date]['surveys'][$event->getId()] = $survey;
            }
        }
        return $surveysByDate;
    }

    /**
     * Calculated Ground + (Cut or Fill).
     *
     * @return float
     */
    public function getCorrectedGround()//: ?float
    {
        return $this->getGround() + $this->getCutOrFill();
    }

    /**
     * (m, decimal) Calculated Corrected-Grd + KB- Ground. Actual Elevation of the KB
     * @return float
     */
    public function getKB()//: ?float
    {
        return $this->getCorrectedGround() + $this->getKbGround();
    }

    /**
     * @return array
     */
    public function getTimelogs()
    {
        $timelogs = [];
        foreach ($this->getDrillingEvents() as $event) {
            foreach ($event->getDailyDrillingReports() as $report) {
                $timelogs = array_merge($timelogs, $report->getTimelogs()->toArray());
            }
        }
        return $timelogs;
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
     * Set licenceNo
     *
     * @param integer $licenceNo
     *
     * @return Licence
     */
    public function setLicenceNo($licenceNo)
    {
        $this->licenceNo = $licenceNo;

        return $this;
    }

    /**
     * Get licenceNo
     *
     * @return integer
     */
    public function getLicenceNo()
    {
        return $this->licenceNo;
    }

    /**
     * Set surfaceLocation
     *
     * @param string $surfaceLocation
     *
     * @return Licence
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
     * Set wellName
     *
     * @param string $wellName
     *
     * @return Licence
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
     * Set laheeClass
     *
     * @param string $laheeClass
     *
     * @return Licence
     */
    public function setLaheeClass($laheeClass)
    {
        $this->laheeClass = $laheeClass;

        return $this;
    }

    /**
     * Get laheeClass
     *
     * @return string
     */
    public function getLaheeClass()
    {
        return $this->laheeClass;
    }

    /**
     * Set drillingOperation
     *
     * @param string $drillingOperation
     *
     * @return Licence
     */
    public function setDrillingOperation($drillingOperation)
    {
        $this->drillingOperation = $drillingOperation;

        return $this;
    }

    /**
     * Get drillingOperation
     *
     * @return string
     */
    public function getDrillingOperation()
    {
        return $this->drillingOperation;
    }

    /**
     * Set strike
     *
     * @param string $strike
     *
     * @return Licence
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
     * Set wellPurpose
     *
     * @param string $wellPurpose
     *
     * @return Licence
     */
    public function setWellPurpose($wellPurpose)
    {
        $this->wellPurpose = $wellPurpose;

        return $this;
    }

    /**
     * Get wellPurpose
     *
     * @return string
     */
    public function getWellPurpose()
    {
        return $this->wellPurpose;
    }

    /**
     * Set mineralRights
     *
     * @param string $mineralRights
     *
     * @return Licence
     */
    public function setMineralRights($mineralRights)
    {
        $this->mineralRights = $mineralRights;

        return $this;
    }

    /**
     * Get mineralRights
     *
     * @return string
     */
    public function getMineralRights()
    {
        return $this->mineralRights;
    }

    /**
     * Set wellType
     *
     * @param string $wellType
     *
     * @return Licence
     */
    public function setWellType($wellType)
    {
        $this->wellType = $wellType;

        return $this;
    }

    /**
     * Get wellType
     *
     * @return string
     */
    public function getWellType()
    {
        return $this->wellType;
    }

    /**
     * Set groundElevation
     *
     * @param string $groundElevation
     *
     * @return Licence
     */
    public function setGroundElevation($groundElevation)
    {
        $this->groundElevation = $groundElevation;

        return $this;
    }

    /**
     * Get groundElevation
     *
     * @return string
     */
    public function getGroundElevation()
    {
        return $this->groundElevation;
    }

    /**
     * Set substance
     *
     * @param string $substance
     *
     * @return Licence
     */
    public function setSubstance($substance)
    {
        $this->substance = $substance;

        return $this;
    }

    /**
     * Get substance
     *
     * @return string
     */
    public function getSubstance()
    {
        return $this->substance;
    }

    /**
     * Set spudDate
     *
     * @param \DateTime $spudDate
     *
     * @return Licence
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
     * Set rigRelease
     *
     * @param \DateTime $rigRelease
     *
     * @return Licence
     */
    public function setRigRelease($rigRelease)
    {
        $this->rigRelease = $rigRelease;

        return $this;
    }

    /**
     * Get rigRelease
     *
     * @return \DateTime
     */
    public function getRigRelease()
    {
        return $this->rigRelease;
    }

    /**
     * Set finishedDrillingDate
     *
     * @param \DateTime $finishedDrillingDate
     *
     * @return Licence
     */
    public function setFinishedDrillingDate($finishedDrillingDate)
    {
        $this->finishedDrillingDate = $finishedDrillingDate;

        return $this;
    }

    /**
     * Get finishedDrillingDate
     *
     * @return \DateTime
     */
    public function getFinishedDrillingDate()
    {
        return $this->finishedDrillingDate;
    }

    /**
     * Set ground
     *
     * @param float $ground
     *
     * @return Licence
     */
    public function setGround($ground)
    {
        $this->ground = $ground;

        return $this;
    }

    /**
     * Get ground
     *
     * @return float
     */
    public function getGround()
    {
        return $this->ground;
    }

    /**
     * Set cutOrFill
     *
     * @param float $cutOrFill
     *
     * @return Licence
     */
    public function setCutOrFill($cutOrFill)
    {
        $this->cutOrFill = $cutOrFill;

        return $this;
    }

    /**
     * Get cutOrFill
     *
     * @return float
     */
    public function getCutOrFill()
    {
        return $this->cutOrFill;
    }

    /**
     * Set kbGround
     *
     * @param string $kbGround
     *
     * @return Licence
     */
    public function setKbGround($kbGround)
    {
        $this->kbGround = $kbGround;

        return $this;
    }

    /**
     * Get kbGround
     *
     * @return string
     */
    public function getKbGround()
    {
        return $this->kbGround;
    }

    /**
     * Set afeId
     *
     * @param string $afeId
     *
     * @return Licence
     */
    public function setAfeId($afeId)
    {
        $this->afeId = $afeId;

        return $this;
    }

    /**
     * Get afeId
     *
     * @return string
     */
    public function getAfeId()
    {
        return $this->afeId;
    }

    /**
     * Set afeEstimate
     *
     * @param string $afeEstimate
     *
     * @return Licence
     */
    public function setAfeEstimate($afeEstimate)
    {
        $this->afeEstimate = $afeEstimate;

        return $this;
    }

    /**
     * Get afeEstimate
     *
     * @return string
     */
    public function getAfeEstimate()
    {
        return $this->afeEstimate;
    }

    /**
     * Set totalCost
     *
     * @param string $totalCost
     *
     * @return Licence
     */
    public function setTotalCost($totalCost)
    {
        $this->totalCost = $totalCost;

        return $this;
    }

    /**
     * Get totalCost
     *
     * @return string
     */
    public function getTotalCost()
    {
        return $this->totalCost;
    }

    /**
     * Set firstDailyReportDate
     *
     * @param \DateTime $firstDailyReportDate
     *
     * @return Licence
     */
    public function setFirstDailyReportDate($firstDailyReportDate)
    {
        $this->firstDailyReportDate = $firstDailyReportDate;

        return $this;
    }

    /**
     * Get firstDailyReportDate
     *
     * @return \DateTime
     */
    public function getFirstDailyReportDate()
    {
        return $this->firstDailyReportDate;
    }

    /**
     * Set lastDailyReportDate
     *
     * @param \DateTime $lastDailyReportDate
     *
     * @return Licence
     */
    public function setLastDailyReportDate($lastDailyReportDate)
    {
        $this->lastDailyReportDate = $lastDailyReportDate;

        return $this;
    }

    /**
     * Get lastDailyReportDate
     *
     * @return \DateTime
     */
    public function getLastDailyReportDate()
    {
        return $this->lastDailyReportDate;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     *
     * @return Licence
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return Licence
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set casingBowl
     *
     * @param CasingBowl $casingBowl
     *
     * @return Licence
     */
    public function setCasingBowl(CasingBowl $casingBowl = null)
    {
        $this->casingBowl = $casingBowl;

        return $this;
    }

    /**
     * Get casingBowl
     *
     * @return CasingBowl
     */
    public function getCasingBowl()
    {
        return $this->casingBowl;
    }

    /**
     * Add drillingRig
     *
     * @param DrillingRig $drillingRig
     *
     * @return Licence
     */
    public function addDrillingRig(DrillingRig $drillingRig)
    {
        $this->drillingRigs[] = $drillingRig;

        return $this;
    }

    /**
     * Remove drillingRig
     *
     * @param DrillingRig $drillingRig
     */
    public function removeDrillingRig(DrillingRig $drillingRig)
    {
        $this->drillingRigs->removeElement($drillingRig);
    }


    /**
     * Add bopDrill
     *
     * @param BopDrill $bopDrill
     *
     * @return Licence
     */
    public function addBopDrill(BopDrill $bopDrill)
    {
        $this->bopDrills[] = $bopDrill;

        return $this;
    }

    /**
     * Remove bopDrill
     *
     * @param BopDrill $bopDrill
     */
    public function removeBopDrill(BopDrill $bopDrill)
    {
        $this->bopDrills->removeElement($bopDrill);
    }

    /**
     * Get bopDrills
     *
     * @return Collection|BopDrill[]
     */
    public function getBopDrills()
    {
        return $this->bopDrills;
    }

    /**
     * Add pressureTest
     *
     * @param PressureTest $pressureTest
     *
     * @return Licence
     */
    public function addPressureTest(PressureTest $pressureTest)
    {
        $this->pressureTests[] = $pressureTest;

        return $this;
    }

    /**
     * Remove pressureTest
     *
     * @param PressureTest $pressureTest
     */
    public function removePressureTest(PressureTest $pressureTest)
    {
        $this->pressureTests->removeElement($pressureTest);
    }

    /**
     * Get pressureTests
     *
     * @return Collection|PressureTest[]
     */
    public function getPressureTests()
    {
        return $this->pressureTests;
    }

    /**
     * Add safetyMeeting
     *
     * @param SafetyMeeting $safetyMeeting
     *
     * @return Licence
     */
    public function addSafetyMeeting(SafetyMeeting $safetyMeeting)
    {
        $this->safetyMeetings[] = $safetyMeeting;

        return $this;
    }

    /**
     * Remove safetyMeeting
     *
     * @param SafetyMeeting $safetyMeeting
     */
    public function removeSafetyMeeting(SafetyMeeting $safetyMeeting)
    {
        $this->safetyMeetings->removeElement($safetyMeeting);
    }

    /**
     * Get safetyMeetings
     *
     * @return Collection|SafetyMeeting[]
     */
    public function getSafetyMeetings()
    {
        return $this->safetyMeetings;
    }

    /**
     * Add drillingEvent
     *
     * @param DrillingEvent $drillingEvent
     *
     * @return Licence
     */
    public function addDrillingEvent(DrillingEvent $drillingEvent)
    {
        $drillingEvent->setLicence($this);
        $this->drillingEvents->add($drillingEvent);

        return $this;
    }

    /**
     * Remove drillingEvent
     *
     * @param DrillingEvent $drillingEvent
     */
    public function removeDrillingEvent(DrillingEvent $drillingEvent)
    {
        $this->drillingEvents->removeElement($drillingEvent);
    }

    /**
     * Get drillingEvents
     *
     * @return Collection|DrillingRig[]
     */
    public function getDrillingEvents()
    {
        return $this->drillingEvents;
    }

    /**
     * Add mudPump
     *
     * @param MudPump $mudPump
     *
     * @return Licence
     */
    public function addMudPump(MudPump $mudPump)
    {
        $this->mudPumps[] = $mudPump;

        return $this;
    }

    /**
     * Remove mudPump
     *
     * @param MudPump $mudPump
     */
    public function removeMudPump(MudPump $mudPump)
    {
        $this->mudPumps->removeElement($mudPump);
    }

    /**
     * Get mudPumps
     *
     * @return Collection|MudPump[]
     */
    public function getMudPumps()
    {
        return $this->mudPumps;
    }

    /**
     * Add bit
     *
     * @param Bit $bit
     *
     * @return Licence
     */
    public function addBit(Bit $bit)
    {
        $this->bits[] = $bit;

        return $this;
    }

    /**
     * Remove bit
     *
     * @param Bit $bit
     */
    public function removeBit(Bit $bit)
    {
        $this->bits->removeElement($bit);
    }

    /**
     * Get bits
     *
     * @return Collection|Bit[]
     */
    public function getBits()
    {
        return $this->bits;
    }

    /**
     * Set operator
     *
     * @param Company $operator
     *
     * @return Licence
     */
    public function setOperator(Company $operator = null)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get operator
     *
     * @return Company
     */
    public function getOperator()
    {
        return $this->operator;
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

    /**
     * @return string
     */
    public function getJurisdiction()//: string
    {
        return $this->jurisdiction;
    }

    /**
     * @param string $jurisdiction
     */
    public function setJurisdiction(string $jurisdiction)
    {
        $this->jurisdiction = $jurisdiction;
    }

    /**
     * Set terminatingZone
     *
     * @param string $terminatingZone
     *
     * @return Licence
     */
    public function setTerminatingZone($terminatingZone)
    {
        $this->terminatingZone = $terminatingZone;

        return $this;
    }

    /**
     * Get terminatingZone
     *
     * @return string
     */
    public function getTerminatingZone()
    {
        return $this->terminatingZone;
    }

    /**
     * Set latitudeUtm
     *
     * @param string $latitudeUtm
     *
     * @return Licence
     */
    public function setLatitudeUtm($latitudeUtm)
    {
        $this->latitudeUtm = $latitudeUtm;

        return $this;
    }

    /**
     * Get latitudeUtm
     *
     * @return string
     */
    public function getLatitudeUtm()
    {
        return $this->latitudeUtm;
    }

    /**
     * Set longitudeUtm
     *
     * @param string $longitudeUtm
     *
     * @return Licence
     */
    public function setLongitudeUtm($longitudeUtm)
    {
        $this->longitudeUtm = $longitudeUtm;

        return $this;
    }

    /**
     * Get longitudeUtm
     *
     * @return string
     */
    public function getLongitudeUtm()
    {
        return $this->longitudeUtm;
    }
}
