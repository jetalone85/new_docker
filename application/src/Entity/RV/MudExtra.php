<?php

namespace App\Entity\RV;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * MudExtra
 *
 * @ORM\Table(name="rv_mud_extra")
 * @ORM\Entity(repositoryClass="App\Repository\RV\MudExtraRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class MudExtra
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="cost", type="decimal", precision=15, scale=2)
     * @Assert\NotBlank()
     */
    protected $cost;

    /**
     * @var string
     *
     * @ORM\Column(name="vendor", type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    protected $vendor;

    /**
     * @var string
     *
     * @ORM\Column(name="ticket", type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    protected $ticket;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     * @Serializer\Expose()
     */
    protected $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="carryForward", type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    protected $carryForward;

    // RELATIONS

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\AfeCostReport")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     *
     * @var AfeCostReport
     */
    protected $afeCostReport;

    /**
     * @ORM\ManyToOne(targetEntity="DailyDrillingReport", inversedBy="mudExtras")
     * @Serializer\Expose()
     *
     * @var DailyDrillingReport
     */
    protected $report;

    // METHODS

    /**
     * @return $this
     */
    public function clearId()
    {
        $this->id = null;
        
        return $this;
    }

    ###

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
     * Set name
     *
     * @param string $name
     *
     * @return MudExtra
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set cost
     *
     * @param string $cost
     *
     * @return MudExtra
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set vendor
     *
     * @param string $vendor
     *
     * @return MudExtra
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
     * Set ticket
     *
     * @param string $ticket
     *
     * @return MudExtra
     */
    public function setTicket($ticket)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     * @return string
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return MudExtra
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set carryForward
     *
     * @param string $carryForward
     *
     * @return MudExtra
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
     * Set afeCostReport
     *
     * @param \App\Entity\RV\AfeCostReport $afeCostReport
     *
     * @return MudExtra
     */
    public function setAfeCostReport(\App\Entity\RV\AfeCostReport $afeCostReport = null)
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

    /**
     * Set report
     *
     * @param \App\Entity\RV\DailyDrillingReport $report
     *
     * @return MudExtra
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
