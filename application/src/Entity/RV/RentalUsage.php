<?php

namespace App\Entity\RV;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @author Marcin Pyrka <marcin.pyrka@polcode.net>
 *
 * @ORM\Entity(repositoryClass="App\Repository\RV\RentalUsageRepository")
 * @ORM\Table("rv_rental_usage")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class RentalUsage
{

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
     * @var RentalItem
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\RentalItem", inversedBy="rentalUsages")
     * @Serializer\Expose()
     */
    private $rentalItem;

    /**
     * @var DailyDrillingReport
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\DailyDrillingReport", inversedBy="rentalUsages")
     * @Serializer\Expose()
     */
    private $dailyDrillingReport;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @return RentalItem
     */
    public function getRentalItem(): RentalItem
    {
        return $this->rentalItem;
    }

    /**
     * @param RentalItem $rentalItem
     */
    public function setRentalItem(RentalItem $rentalItem)
    {
        $this->rentalItem = $rentalItem;
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
