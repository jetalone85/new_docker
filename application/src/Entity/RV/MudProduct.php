<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Table(name="rv_mud_product")
 * @ORM\Entity(repositoryClass="App\Repository\RV\MudProductRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class MudProduct
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
     * @var int
     *
     * @ORM\Column(name="starting_balance", type="integer")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    protected $startingBalance;

    /**
     * @var string
     *
     * @ORM\Column(name="track_loses", type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    protected $trackLoses;

    /**
     * @var int
     *
     * @ORM\Column(name="density", type="integer")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    protected $density;

    // RELATIONS

    /**
     * @ORM\ManyToOne(targetEntity="MudUnit")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     *
     * @var MudUnit
     */
    protected $unit;

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="mudProducts")
     *
     * @var Project
     */
    protected $project;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\AfeCostReport")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     *
     * @var AfeCostReport
     */
    protected $afeCostReport;

    /**
     * @ORM\OneToMany(targetEntity="MudUsage", mappedBy="product")
     *
     * @var Collection|MudUsage[]
     */
    protected $mudUsages;

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
     * @return MudProduct
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
     * @return MudProduct
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
     * @return MudProduct
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
     * @return MudProduct
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
     * Set startingBalance
     *
     * @param integer $startingBalance
     *
     * @return MudProduct
     */
    public function setStartingBalance($startingBalance)
    {
        $this->startingBalance = $startingBalance;

        return $this;
    }

    /**
     * Get startingBalance
     *
     * @return integer
     */
    public function getStartingBalance()
    {
        return $this->startingBalance;
    }

    /**
     * Set unit
     *
     * @param \App\Entity\RV\MudUnit $unit
     *
     * @return MudProduct
     */
    public function setUnit(\App\Entity\RV\MudUnit $unit = null)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return \App\Entity\RV\MudUnit
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set project
     *
     * @param \App\Entity\RV\Project $project
     *
     * @return MudProduct
     */
    public function setProject(\App\Entity\RV\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \App\Entity\RV\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set afeCostReport
     *
     * @param \App\Entity\RV\AfeCostReport $afeCostReport
     *
     * @return MudProduct
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
     * Constructor
     */
    public function __construct()
    {
        $this->mudUsages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add mudUsage
     *
     * @param \App\Entity\RV\MudUsage $mudUsage
     *
     * @return MudProduct
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
     * Set trackLoses
     *
     * @param string $trackLoses
     *
     * @return MudProduct
     */
    public function setTrackLoses($trackLoses)
    {
        $this->trackLoses = $trackLoses;

        return $this;
    }

    /**
     * Get trackLoses
     *
     * @return string
     */
    public function getTrackLoses()
    {
        return $this->trackLoses;
    }

    /**
     * Set density
     *
     * @param integer $density
     *
     * @return MudProduct
     */
    public function setDensity($density)
    {
        $this->density = $density;

        return $this;
    }

    /**
     * Get density
     *
     * @return integer
     */
    public function getDensity()
    {
        return $this->density;
    }
}
