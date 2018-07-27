<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Shared\AfeAccount;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RV\RentalExtraItemRepository")
 * @ORM\Table("rv_rental_extra_item")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class RentalExtraItem
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\SerializedName("id")
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
     * @var string
     *
     * @ORM\Column(name="`usage`", type="string", nullable=true)
     * @Serializer\Expose()
     */
    private $usage;

    /**
     * @var string
     *
     * @ORM\Column(name="carry_forward", type="boolean", nullable=true)
     * @Serializer\Expose()
     */
    private $carryForward;

    /**
     * @var DailyDrillingReport
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\DailyDrillingReport", inversedBy="rentalUsages")
     * @ORM\JoinColumn(name="dailyDrillingReport_id", referencedColumnName="id")
     * @Serializer\Expose()
     */
    private $dailyDrillingReport;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * @return Licence
     */
    public function getLicence()
    {
        return $this->licence;
    }

    /**
     * @param Licence $licence
     */
    public function setLicence(Licence $licence)
    {
        $this->licence = $licence;
    }

    /**
     * @return string
     */
    public function getUsage()
    {
        return $this->usage;
    }

    /**
     * @param string $usage
     */
    public function setUsage(string $usage)
    {
        $this->usage = $usage;
    }

    /**
     * @return string
     */
    public function getCarryForward()
    {
        return $this->carryForward;
    }

    /**
     * @param string $carryForward
     */
    public function setCarryForward(string $carryForward)
    {
        $this->carryForward = $carryForward;
    }

    /**
     * @return DailyDrillingReport
     */
    public function getDailyDrillingReport(): DailyDrillingReport
    {
        return $this->dailyDrillingReport;
    }

    /**
     * @param DailyDrillingReport $drillingReport
     */
    public function setDailyDrillingReport(DailyDrillingReport $drillingReport)
    {
        $this->dailyDrillingReport = $drillingReport;
    }
}
