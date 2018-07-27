<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RV\RentalItemRepository")
 * @ORM\Table("rv_rental_item")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class RentalItem
{
    /**
     * @var int
     *
     * @Serializer\SerializedName("id")
     * @Serializer\Expose()
     */
    private $hideId;
    
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="vendor", type="string", length=255)
     * @Serializer\Expose()
     */
    private $vendor;

    /**
     * @var string
     *
     * @ORM\Column(name="equipment_name", type="string", length=511)
     * @Serializer\Expose()
     */
    private $equipmentName;

    /**
     * @var string
     *
     * @ORM\Column(name="unit", type="string", length=255)
     * @Serializer\Expose()
     */
    private $unit;

    /**
     * @var float
     *
     * @ORM\Column(name="normal_rate", type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $normalRate = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="reduced_rate", type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $reducedRate = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="ticket", type="string", length=255)
     * @Serializer\Expose()
     * @Assert\NotBlank()
     */
    private $ticket;

    /**
     * @var AfeCostReport
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\AfeCostReport", inversedBy="rentalItems")
     * @Serializer\Expose()
     */
    private $afeCostReport;

    /**
     * @var Project
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\Project", inversedBy="rentalItems"))
     */
    private $project;

    /**
     * @var RentalUsage
     *
     * @Serializer\Expose()
     */
    private $rentalUsage;

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\RV\RentalUsage",
     *     mappedBy="rentalItem",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EXTRA_LAZY"
     * )
     */
    private $rentalUsages;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rentalUsages = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * @param string $vendor
     */
    public function setVendor(string $vendor)
    {
        $this->vendor = $vendor;
    }

    /**
     * @return string
     */
    public function getEquipmentName()
    {
        return $this->equipmentName;
    }

    /**
     * @param string $equipmentName
     */
    public function setEquipmentName(string $equipmentName)
    {
        $this->equipmentName = $equipmentName;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     */
    public function setUnit(string $unit)
    {
        $this->unit = $unit;
    }

    /**
     * @return float
     */
    public function getNormalRate()
    {
        return $this->normalRate;
    }

    /**
     * @param float $normalRate
     */
    public function setNormalRate(float $normalRate)
    {
        $this->normalRate = $normalRate;
    }

    /**
     * @return float
     */
    public function getReducedRate()
    {
        return $this->reducedRate;
    }

    /**
     * @param float $reducedRate
     */
    public function setReducedRate(float $reducedRate)
    {
        $this->reducedRate = $reducedRate;
    }

    /**
     * @return string
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @param string $ticket
     */
    public function setTicket(string $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * @return AfeCostReport
     */
    public function getAfeCostReport()
    {
        return $this->afeCostReport;
    }

    /**
     * @param AfeCostReport $afeCostReport
     */
    public function setAfeCostReport(AfeCostReport $afeCostReport)
    {
        $this->afeCostReport = $afeCostReport;
    }

    /**
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->project;
    }

    /**
     * @param Project $project
     */
    public function setProject(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Add RentalUsage
     *
     * @param RentalUsage $rentalUsage
     * @return RentalItem
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
     * @return RentalUsage
     */
    public function getRentalUsage(): RentalUsage
    {
        return $this->rentalUsage;
    }

    /**
     * @param RentalUsage $rentalUsage
     */
    public function setRentalUsage(RentalUsage $rentalUsage)
    {
        $this->rentalUsage = $rentalUsage;
    }

    /**
     * @return int
     */
    public function getHideId(): int
    {
        return $this->hideId;
    }

    /**
     * @param int $hideId
     */
    public function setHideId(int $hideId)
    {
        $this->hideId = $hideId;
    }
}
