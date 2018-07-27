<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Table(name="rv_mud_usage")
 * @ORM\Entity(repositoryClass="App\Repository\RV\MudUsageRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class MudUsage
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose()
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(name="received", type="integer", nullable=true)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    protected $received;

    /**
     * @var int
     *
     * @ORM\Column(name="used", type="integer", nullable=true)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    protected $used;

    /**
     * @var int
     *
     * @ORM\Column(name="total_received_to_date", type="integer", nullable=true)
     * @Serializer\Expose()
     */
    protected $totalReceivedToDate;

    /**
     * @var int
     *
     * @ORM\Column(name="total_used_to_date", type="integer", nullable=true)
     * @Serializer\Expose()
     */
    protected $totalUsedToDate;

    /**
     * @var int
     *
     * @ORM\Column(name="balance", type="integer", nullable=true)
     * @Serializer\Expose()
     */
    protected $balance;

    // RELATIONS

    /**
     * @ORM\ManyToOne(targetEntity="MudProduct", inversedBy="mudUsages")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     *
     * @var MudProduct
     */
    protected $product;

    /**
     * @ORM\ManyToOne(targetEntity="DailyDrillingReport", inversedBy="mudUsages")
     *
     * @var DailyDrillingReport
     */
    protected $report;

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
     * Set received
     *
     * @param integer $received
     *
     * @return MudUsage
     */
    public function setReceived($received)
    {
        $this->received = $received;

        return $this;
    }

    /**
     * Get received
     *
     * @return integer
     */
    public function getReceived()
    {
        return $this->received;
    }

    /**
     * Set used
     *
     * @param integer $used
     *
     * @return MudUsage
     */
    public function setUsed($used)
    {
        $this->used = $used;

        return $this;
    }

    /**
     * Get used
     *
     * @return integer
     */
    public function getUsed()
    {
        return $this->used;
    }

    /**
     * Set totalReceivedToDate
     *
     * @param integer $totalReceivedToDate
     *
     * @return MudUsage
     */
    public function setTotalReceivedToDate($totalReceivedToDate)
    {
        $this->totalReceivedToDate = $totalReceivedToDate;

        return $this;
    }

    /**
     * Get totalReceivedToDate
     *
     * @return integer
     */
    public function getTotalReceivedToDate()
    {
        return $this->totalReceivedToDate;
    }

    /**
     * Set totalUsedToDate
     *
     * @param integer $totalUsedToDate
     *
     * @return MudUsage
     */
    public function setTotalUsedToDate($totalUsedToDate)
    {
        $this->totalUsedToDate = $totalUsedToDate;

        return $this;
    }

    /**
     * Get totalUsedToDate
     *
     * @return integer
     */
    public function getTotalUsedToDate()
    {
        return $this->totalUsedToDate;
    }

    /**
     * Set balance
     *
     * @param integer $balance
     *
     * @return MudUsage
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return integer
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set product
     *
     * @param \App\Entity\RV\MudProduct $product
     *
     * @return MudUsage
     */
    public function setProduct(\App\Entity\RV\MudProduct $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \App\Entity\RV\MudProduct
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set report
     *
     * @param \App\Entity\RV\DailyDrillingReport $report
     *
     * @return MudUsage
     */
    public function setReport(\App\Entity\RV\DailyDrillingReport $report = null)
    {
        $this->report = $report;

        return $this;
    }

    /**
     * Get report
     *
     * @return \App\Entity\RV\DailyDrillingReport
     */
    public function getReport()
    {
        return $this->report;
    }
}
