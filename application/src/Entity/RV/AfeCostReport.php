<?php

namespace App\Entity\RV;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Shared\AfeAccount;
use JMS\Serializer\Annotation as Serializer;

/**
 * AfeCostReport
 *
 * @ORM\Table(name="rv_afe_cost_report")
 * @ORM\Entity(repositoryClass="App\Repository\RV\AfeCostReportRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class AfeCostReport
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @ORM\Column(name="AFE_ESTIMATE", type="decimal", precision=15, scale=2)
     *
     * @var float
     */
    private $afeEstimate;

    /**
     * @ORM\Column(name="FIELD_ESTIMATE", type="decimal", precision=15, scale=2)
     *
     * @var float
     */
    private $fieldEstimate = .0;

    /**
     * @var float
     *
     * @ORM\Column(name="COMMENTS", type="string", length=255)
     * @Serializer\Expose()
     */
    private $comments;

    // RELATIONS

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="afeCostReports")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     *
     * @var Project
     */
    protected $project;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Shared\AfeAccount", inversedBy="afeCostReports")
     * @ORM\JoinColumn(name="afe_account_id", referencedColumnName="id")
     *
     * @Serializer\Expose()
     *
     * @var AfeAccount
     */
    protected $afeAccount;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RV\RentalItem", mappedBy="afeAccount")
     *
     * @var Collection|RentalItem[]
     */
    protected $rentalItems;

    /**
    * @ORM\OneToMany(
    *     targetEntity="DailyDrillingCostDetails",
    *     mappedBy="afeCostReport",
    *     cascade={"all"},
    *     orphanRemoval=true,
    *     fetch="EXTRA_LAZY"
    * )
    *
    * @var Collection|DailyDrillingCostDetails[]
    */
    protected $dailyDrillingCostDetails;

    /**
     * AfeCostReport constructor.
     */
    public function __construct()
    {
        $this->rentalItems = new ArrayCollection();
    }

    /**
     * @return float
     * @deprecated See Calculator/AfeCostReport
     */
    public function calculateFieldEstimate()
    {
        $fieldEstimate = .0;

        foreach ($this->getProject()->getDailyDrillingReports() as $ddr) {
            $fieldEstimate += $ddr->calculateFieldEstimate($this);
        }

        return $fieldEstimate;
    }

    /**
     * @deprecated
     *
     * @param string $accountName
     * @return AfeCostReport
     */
    public function setAccountName(string $accountName)
    {
        $this->getAfeAccount()->setName($accountName);
        return $this;
    }

    /**
     * @deprecated
     * @Serializer\VirtualProperty("accountName")
     *
     * @return string
     */
    public function getAccountName()
    {
        return (($afeAccount = $this->getAfeAccount()) ? $afeAccount->getName() : null);
    }

    /**
     * @deprecated
     *
     * @param string $accountNumber
     * @return AfeCostReport
     */
    public function setAccountNumber(string $accountNumber): AfeCostReport
    {
        $this->getAfeAccount()->setNumber($accountNumber);
        return $this;
    }

    /**
     * @deprecated
     * @Serializer\VirtualProperty("accountNumber")
     *
     * @return string
     */
    public function getAccountNumber()//: string
    {
        return (($afeAccount = $this->getAfeAccount()) ? $afeAccount->getNumber() : null);
    }

    /**
     * @return float
     */
    public function getDollarDifference()//: float
    {
        return $this->getAfeEstimate() - $this->getFieldEstimate();
    }

    /**
     * @return float
     * @Serializer\VirtualProperty()
     */
    public function getPercentOfAfe()//: float
    {
        return ($this->getAfeEstimate() > 0) ? round(($this->getFieldEstimate() * 100) / $this->getAfeEstimate()) : 0;
    }

    /**
     * @return float
     */
    public function getProjectedDifference()//: float
    {
        return $this->getAfeEstimate() - $this->getFieldEstimate();
    }

    /**
     * @deprecated
     *
     * @return DrillingEvent
     */
    public function getEvent(): DrillingEvent
    {
        return $this->getProject()->getDrillingEvent();
    }

    /**
     * @deprecated
     *
     * @param DrillingEvent $event
     * @return $this
     */
    public function setEvent(DrillingEvent $event = null)
    {
        $this->getProject()->setDrillingEvent($event);
        return $this;
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
     * Set afeEstimate
     *
     * @param string $afeEstimate
     *
     * @return AfeCostReport
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
     * Set fieldEstimate
     *
     * @param string $fieldEstimate
     *
     * @return AfeCostReport
     */
    public function setFieldEstimate($fieldEstimate)
    {
        $this->fieldEstimate = $fieldEstimate;

        return $this;
    }

    /**
     * Get fieldEstimate
     *
     * @return string
     */
    public function getFieldEstimate()
    {
        return $this->fieldEstimate;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return AfeCostReport
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set project
     *
     * @param Project $project
     *
     * @return AfeCostReport
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
     * Add RentalItem
     *
     * @param RentalItem $rentalItem
     * @return AfeCostReport
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
     * Set afeAccount
     *
     * @param AfeAccount $afeAccount
     *
     * @return AfeCostReport
     */
    public function setAfeAccount(AfeAccount $afeAccount = null)
    {
        $this->afeAccount = $afeAccount;

        return $this;
    }

    /**
     * Get afeAccount
     *
     * @return AfeAccount
     */
    public function getAfeAccount()
    {
        return $this->afeAccount;
    }
}
