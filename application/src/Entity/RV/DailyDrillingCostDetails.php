<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Table(name="rv_daily_drilling_cost_details")
 * @ORM\Entity(repositoryClass="App\Repository\RV\DailyDrillingCostDetailsRepository")
 * @Serializer\ExclusionPolicy("all")
 * @UniqueEntity(
 *     groups={"unique_check"},
 *     fields={"vendor", "ticketNumber", "afeCostReport", "amountExcludedTax"},
 *     errorPath="amountExcludedTax",
 *     message="There is already a cost entered with the same Account, Ticket, Vendor, and Cost. Are you sure you want to add it to the day?",
 * )
 */
class DailyDrillingCostDetails
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
     * @var DailyDrillingReport
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\DailyDrillingReport", inversedBy="dailyDrillingCostDetails", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $dailyReport;

    
    /**
     * @var AfeCostReport
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\AfeCostReport", inversedBy="dailyDrillingCostDetails", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Expose()
     */
    private $afeCostReport;

    /**
     * @var string
     *
     * @ORM\Column(name="VENDOR", nullable=true, type="string", length=255)
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $vendor;

    /**
     * @var string
     *
     * @ORM\Column(name="TICKET_NUMBER", nullable=true, type="string", length=255)
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $ticketNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="AMOUNT_EXCLUDED_TAX", type="decimal", precision=15, scale=2)
     *
     * @Serializer\Exclude()
     * @Assert\NotBlank()
     */
    private $amountExcludedTax;

    /**
     * @var string
     *
     * @ORM\Column(name="COMMENTS", nullable=true, type="string", length=255)
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $comments;

    /**
     * @var string
     *
     * @ORM\Column(name="CARRY_FORWARD", type="string", length=255)
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $carryForward;

    /**
     * Constrcutor
     */
    public function __construct()
    {
        $this->carryForward = CarryForwardType::NONE;
    }


    /**
     * @return $this
     */
    public function clearId()
    {
        $this->id = null;
        return $this;
    }

    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("carry_forward_text")
     *
     * @return string
     */
    public function getCarryForwardText()
    {
        $values = array_flip(CarryForwardType::getChoices());

        if (isset($values[$this->carryForward])) {
            return $values[$this->carryForward];
        }

        return '';
    }

    ###

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
     * Get accountName
     *
     * @return string
     */
    public function getAccountName()
    {
        return $this->getAfeCostReport()->getAfeAccount()->getNumber();
    }

    /**
     * Get accountNumber
     *
     * @return string
     */
    public function getAccountNumber()
    {
        /**
         * @todo getAccountNumber
         */
        return $this->getAfeCostReport()->getAfeAccount()->getName();
    }

    /**
     * Set vendor
     *
     * @param string $vendor
     *
     * @return DailyDrillingCostDetails
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * Get vendor
     *
     * @return string
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * Set ticketNumber
     *
     * @param string $ticketNumber
     *
     * @return DailyDrillingCostDetails
     */
    public function setTicketNumber($ticketNumber)
    {
        $this->ticketNumber = $ticketNumber;

        return $this;
    }

    /**
     * Get ticketNumber
     *
     * @return string
     */
    public function getTicketNumber()
    {
        return $this->ticketNumber;
    }

    /**
     * Set amountExcludedTax
     *
     * @param string $amountExcludedTax
     *
     * @return DailyDrillingCostDetails
     */
    public function setAmountExcludedTax($amountExcludedTax)
    {
        $this->amountExcludedTax = $amountExcludedTax;

        return $this;
    }

    /**
     * Get amountExcludedTax
     *
     * @return string
     */
    public function getAmountExcludedTax()
    {
        return $this->amountExcludedTax;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return DailyDrillingCostDetails
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
     * Set carryForward
     *
     * @param string $carryForward
     *
     * @return DailyDrillingCostDetails
     */
    public function setCarryForward($carryForward)
    {
        $this->carryForward = $carryForward;

        return $this;
    }

    /**
     * Get carryForward
     *
     * @return string
     */
    public function getCarryForward()
    {
        return $this->carryForward;
    }

    /**
     * @return DailyDrillingReport
     */
    public function getDailyReport()
    {
        return $this->dailyReport;
    }

    /**
     * @param DailyDrillingReport $dailyReport
     * @return $this
     */
    public function setDailyReport(DailyDrillingReport $dailyReport = null)
    {
        $this->dailyReport = $dailyReport;
        return $this;
    }


    /**
     * Set afeCostReport
     *
     * @param \App\Entity\RV\AfeCostReport $afeCostReport
     *
     * @return DailyDrillingCostDetails
     */
    public function setAfeCostReport(\App\Entity\RV\AfeCostReport $afeCostReport)
    {
        $this->afeCostReport = $afeCostReport;

        return $this;
    }

    /**
     * Get afeCostReport
     *
     * @return \App\Entity\RV\AfeCostReport
     */
    public function getAfeCostReport()
    {
        return $this->afeCostReport;
    }
}
