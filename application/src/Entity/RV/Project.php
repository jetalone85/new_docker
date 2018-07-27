<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Project class.
 *
 * @ApiResource()
 * @ORM\Table(
 *     name="rv_project",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(
 *             name="unique_project_idx",
 *             columns={
 *                 "project_type_id",
 *                 "drilling_event_id"
 *             }
 *         )
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\RV\ProjectRepository")
 *
 * @package App\Entity\RV
 */
class Project
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    protected $id;


    // RELATIONS

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RV\ProjectAccess", mappedBy="project", cascade={"all"}, fetch="EXTRA_LAZY", orphanRemoval=true)
     *
     * @var Collection|ProjectAccess[]
     */
    protected $access;

    /**
     * @ORM\OneToMany(targetEntity="AfeCostReport", mappedBy="project", cascade={"all"}, fetch="EXTRA_LAZY")
     *
     * @var Collection|AfeCostReport[]
     */
    protected $afeCostReports;

    /**
     * @ORM\OneToMany(targetEntity="DailyDrillingReport", mappedBy="project")
     *
     * @var Collection|DailyDrillingReport[]
     */
    protected $dailyDrillingReports;

    /**
     * @ORM\OneToMany(targetEntity="DirectionalSurvey", mappedBy="project", fetch="EXTRA_LAZY")
     *
     * @var Collection|DirectionalSurvey[]
     */
    protected $directionalSurveys;

    /**
     * @ORM\OneToMany(targetEntity="ProductivityItem", mappedBy="project", cascade={"all"}, fetch="EXTRA_LAZY")
     *
     * @var Collection|ProductivityItem[]
     */
    protected $productivityItems;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RV\DrillingInterval", mappedBy="project", cascade={"all"}, fetch="EXTRA_LAZY")
     *
     * @var Collection|DrillingInterval[]
     */
    protected $drillingIntervals;

    /**
     * @ORM\OneToMany(targetEntity="CasingSegment", mappedBy="project", cascade={"all"}, fetch="EXTRA_LAZY")
     *
     * @var Collection|CasingSegment[]
     */
    protected $casingSegments;

    /**
     * @ORM\ManyToOne(targetEntity="DrillingEvent", inversedBy="projects")
     * @ORM\JoinColumn(name="drilling_event_id", referencedColumnName="id")
     *
     * @var DrillingEvent
     */
    protected $drillingEvent;

    /**
     * @var DrillingRig
     *
     * @ORM\OneToOne(targetEntity="DrillingRig", mappedBy="project")
     */
    protected $drillingRig;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\RV\Prognosis", mappedBy="project")
     */
    private $prognosis;

    /**
     * @ORM\OneToMany(targetEntity="MudProduct", mappedBy="project", cascade={"all"}, fetch="EXTRA_LAZY")
     *
     * @var Collection|MudProduct[]
     */
    protected $mudProducts;

    /**
     * @ORM\ManyToOne(targetEntity="ProjectType", inversedBy="projects")
     * @ORM\JoinColumn(name="project_type_id", referencedColumnName="id")
     *
     * @var ProjectType
     */
    protected $projectType;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\RV\ProjectWellType", mappedBy="project")
     */
    private $projectWellType;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\RV\ProductivityReportDates", mappedBy="project")
     */
    private $productivityReportDates;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RV\RentalItem", mappedBy="project")
     *
     * @var Collection|RentalItem[]
     */
    protected $rentalItems;


    /**
     * @var MaterialTransfer[]
     * @ORM\OneTOMany(targetEntity="App\Entity\RV\MaterialTransfer", mappedBy="project", fetch="EXTRA_LAZY")
     */
    private $materialTransfers;

    /**
     * Project constructor.
     *
     * @param DrillingEvent $drillingEvent
     */
    public function __construct(DrillingEvent $drillingEvent)
    {
        $this->afeCostReports = new ArrayCollection();
        $this->dailyDrillingReports = new ArrayCollection();
        $this->directionalSurveys = new ArrayCollection();
        $this->productivityItems = new ArrayCollection();
        $this->drillingEvent = $drillingEvent;
        $this->casingSegments = new ArrayCollection();
        $this->drillingIntervals = new ArrayCollection();
        $this->rentalItems = new ArrayCollection();
        $this->materialTransfers = new ArrayCollection();
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->projectType->getName();
    }

    /**
     * Add afeCostReport.
     *
     * @param AfeCostReport $afeCostReport
     *
     * @return Project
     */
    public function addAfeCostReport(AfeCostReport $afeCostReport)
    {
        $this->afeCostReports[] = $afeCostReport;

        return $this;
    }

    /**
     * Remove afeCostReport.
     *
     * @param AfeCostReport $afeCostReport
     */
    public function removeAfeCostReport(AfeCostReport $afeCostReport)
    {
        $this->afeCostReports->removeElement($afeCostReport);
    }

    /**
     * Get afeCostReports.
     *
     * @return Collection
     */
    public function getAfeCostReports()
    {
        return $this->afeCostReports;
    }

    /**
     * Add dailyDrillingReport.
     *
     * @param DailyDrillingReport $dailyDrillingReport
     *
     * @return Project
     */
    public function addDailyDrillingReport(DailyDrillingReport $dailyDrillingReport)
    {
        $this->dailyDrillingReports[] = $dailyDrillingReport;

        return $this;
    }

    /**
     * Remove dailyDrillingReport.
     *
     * @param DailyDrillingReport $dailyDrillingReport
     */
    public function removeDailyDrillingReport(DailyDrillingReport $dailyDrillingReport)
    {
        $this->dailyDrillingReports->removeElement($dailyDrillingReport);
    }

    /**
     * Get dailyDrillingReports.
     *
     * @return Collection|DailyDrillingReport[]
     */
    public function getDailyDrillingReports()
    {
        return $this->dailyDrillingReports;
    }

    /**
     * Add directionalSurvey.
     *
     * @param DirectionalSurvey $directionalSurvey
     *
     * @return Project
     */
    public function addDirectionalSurvey(DirectionalSurvey $directionalSurvey)
    {
        $this->directionalSurveys[] = $directionalSurvey;

        return $this;
    }

    /**
     * Remove directionalSurvey.
     *
     * @param DirectionalSurvey $directionalSurvey
     */
    public function removeDirectionalSurvey(DirectionalSurvey $directionalSurvey)
    {
        $this->directionalSurveys->removeElement($directionalSurvey);
    }

    /**
     * Get directionalSurveys.
     *
     * @return Collection
     */
    public function getDirectionalSurveys()
    {
        return $this->directionalSurveys;
    }

    /**
     * Add productivityItem.
     *
     * @param ProductivityItem $productivityItem
     *
     * @return Project
     */
    public function addProductivityItem(ProductivityItem $productivityItem)
    {
        $this->productivityItems[] = $productivityItem;

        return $this;
    }

    /**
     * Remove productivityItem.
     *
     * @param ProductivityItem $productivityItem
     */
    public function removeProductivityItem(ProductivityItem $productivityItem)
    {
        $this->productivityItems->removeElement($productivityItem);
    }

    /**
     * Get productivityItems.
     *
     * @return Collection
     */
    public function getProductivityItems()
    {
        return $this->productivityItems;
    }

    /**
     * Add casingSegment.
     *
     * @param casingSegment $casingSegment
     *
     * @return Project
     */
    public function addCasingSegment(CasingSegment $casingSegment)
    {
        $this->casingSegments[] = $casingSegment;

        return $this;
    }

    /**
     * Remove casingSegment.
     *
     * @param CasingSegment $casingSegment
     */
    public function removeCasingSegment(CasingSegment $casingSegment)
    {
        $this->casingSegemnts->removeElement($casingSegment);
    }

    /**
     * Get casingSegment.
     *
     * @return Collection
     */
    public function getCasingSegments()
    {
        return $this->casingSegments;
    }

    /**
     * Set drillingEvent.
     *
     * @param DrillingEvent $drillingEvent
     *
     * @return Project
     */
    public function setDrillingEvent(DrillingEvent $drillingEvent = null)
    {
        $this->drillingEvent = $drillingEvent;

        return $this;
    }

    /**
     * Get drillingEvent.
     *
     * @return DrillingEvent
     */
    public function getDrillingEvent()
    {
        return $this->drillingEvent;
    }

    /**
     * @return Collection|ProjectAccess[]
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @param Collection|ProjectAccess[] $access
     *
     * @return $this
     */
    public function setAccess($access = null)
    {
        $this->access = $access;

        return $this;
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
     * Set projectType
     *
     * @param ProjectType $projectType
     *
     * @return Project
     */
    public function setProjectType(ProjectType $projectType = null)
    {
        $this->projectType = $projectType;

        return $this;
    }

    /**
     * Add mudProduct
     *
     * @param \App\Entity\RV\MudProduct $mudProduct
     *
     * @return Project
     */
    public function addMudProduct(\App\Entity\RV\MudProduct $mudProduct)
    {
        $this->mudProducts[] = $mudProduct;

        return $this;
    }

    /**
     * Remove mudProduct
     *
     * @param \App\Entity\RV\MudProduct $mudProduct
     */
    public function removeMudProduct(\App\Entity\RV\MudProduct $mudProduct)
    {
        $this->mudProducts->removeElement($mudProduct);
    }

    /**
     * Get mudProducts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMudProducts()
    {
        return $this->mudProducts;
    }

    /**
     * Get projectType
     *
     * @return ProjectType
     */
    public function getProjectType()
    {
        return $this->projectType;
    }

    /**
     * Get ProjectWellType
     *
     * @return ProjectWellType
     */
    public function getProjectWellType()
    {
        return $this->projectWellType;
    }

    /**
     * @param ProjectWellType $projectWellType
     *
     * @return ProjectWellType
     */
    public function setProjectWellType($projectWellType)
    {
        $this->projectWellType = $projectWellType;
    }

    /**
     * @return Collection|DrillingInterval[]
     */
    public function getDrillingIntervals()
    {
        return $this->drillingIntervals;
    }

    /**
     * @param Collection|DrillingInterval[] $drillingIntervals
     */
    public function setDrillingIntervals($drillingIntervals)
    {
        $this->drillingIntervals = $drillingIntervals;
    }

    /**
     * @return ProductivityReportDates
     */
    public function getProductivityReportDates()
    {
        return $this->productivityReportDates;
    }

    /**
     * @param mixed $productivityReportDates
     */
    public function setProductivityReportDates($productivityReportDates)
    {
        $this->productivityReportDates = $productivityReportDates;
    }

    /**
     * Add access
     *
     * @param \App\Entity\RV\ProjectAccess $access
     *
     * @return Project
     */
    public function addAccess(\App\Entity\RV\ProjectAccess $access)
    {
        $this->access[] = $access;

        return $this;
    }

    /**
     * Remove access
     *
     * @param \App\Entity\RV\ProjectAccess $access
     */
    public function removeAccess(\App\Entity\RV\ProjectAccess $access)
    {
        $this->access->removeElement($access);
    }

    /**
     * Add drillingInterval
     *
     * @param \App\Entity\RV\DrillingInterval $drillingInterval
     *
     * @return Project
     */
    public function addDrillingInterval(\App\Entity\RV\DrillingInterval $drillingInterval)
    {
        $this->drillingIntervals[] = $drillingInterval;

        return $this;
    }

    /**
     * Remove drillingInterval
     *
     * @param \App\Entity\RV\DrillingInterval $drillingInterval
     */
    public function removeDrillingInterval(\App\Entity\RV\DrillingInterval $drillingInterval)
    {
        $this->drillingIntervals->removeElement($drillingInterval);
    }

    /**
     * Add RentalItem
     *
     * @param RentalItem $rentalItem
     * @return Project
     */
    public function addRentalItem(RentalItem $rentalItem)
    {
        $this->rentalItems[] = $rentalItem;

        return $this;
    }

    /**
     * Remove RentalItem
     *
     * @param RentalItem $rentalItem
     */
    public function removeRentalItem(RentalItem $rentalItem)
    {
        $this->rentalItems->removeElement($rentalItem);
    }

    /**
     * Get RentalItem
     *
     * @return Collection
     */
    public function getRentalItems()
    {
        return $this->rentalItems;
    }

    /**
     * @return MaterialTransfer[]|ArrayCollection
     */
    public function getMaterialTransfers()
    {
        return $this->materialTransfers;
    }

    /**
     * @param MaterialTransfer[]|ArrayCollection $materialTransfers
     * @return $this
     */
    public function setMaterialTransfers(array $materialTransfers = null)
    {
        $this->materialTransfers = $materialTransfers;
        return $this;
    }

    /**
     * @return DrillingRig
     */
    public function getDrillingRig()
    {
        return $this->drillingRig;
    }

    /**
     * @param DrillingRig $drillingRig
     * @return $this
     */
    public function setDrillingRig(DrillingRig $drillingRig = null)
    {
        $this->drillingRig = $drillingRig;
        return $this;
    }
}
