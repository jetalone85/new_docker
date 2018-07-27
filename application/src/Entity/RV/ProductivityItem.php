<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Table(name="rv_productivity_items")
 * @ORM\Entity(repositoryClass="App\Repository\RV\ProductivityItemsRepository")
 * @Serializer\ExclusionPolicy("all")
 *
 * @package App\Entity\RV
 */
class ProductivityItem
{
    const CBP_WSS = 'wss';
    const CBP_OPERATOR = 'operator';
    const CBP_ENGINEERING = 'engineering';

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
     * @var \DateTime
     *
     * @ORM\Column(name="START_TIME", type="datetime")
     * @Serializer\Expose()
     */
    protected $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="END_TIME", type="datetime")
     *
     * @Assert\Expression("this.getStartTime() < this.getEndTime()", message="End date must be after start date")
     * @Serializer\Expose()
     */
    protected $endTime;

    /**
     * @var string
     *
     * @ORM\Column(name="COST", type="decimal", precision=15, scale=2)
     */
    protected $cost;

    /**
     * @var string
     *
     * @ORM\Column(name="TYPE", type="string", length=255)
     * @Serializer\Expose()
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION", type="string", length=255)
     * @Serializer\Expose()
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\ProjectWellTypeInterval")
     * @ORM\JoinColumn(name="DRILLING_INTERVAL", referencedColumnName="id", nullable=true)
     * @Serializer\Expose()
     *
     * @var ProjectWellTypeInterval
     */
    protected $drillingInterval;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Expose()
     * @Serializer\SerializedName("cbp")
     */
    protected $CBP;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Expose()
     * @Serializer\SerializedName("wssdays")
     */
    protected $WSSDays;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Expose()
     * @Serializer\SerializedName("wssnights")
     */
    protected $WSSNights;

    // RELATIONS

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="productivityItems")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     *
     * @var Project
     */
    protected $project;


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
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return ProductivityItem
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     *
     * @return string
     * @Serializer\VirtualProperty()
     */
    public function getStartTimeFormatted()
    {
        return $this->getStartTime()->format('Y-m-d H:i');
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return ProductivityItem
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * @Serializer\VirtualProperty()
     *
     * @return string
     */
    public function getEndTimeFormatted()
    {
        return $this->getEndTime()->format('Y-m-d H:i');
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }


    /**
     * Get hours
     *
     * @Serializer\VirtualProperty()
     *
     * @return string
     */
    public function getHours()
    {
        $diff = $this->getEndTime()->getTimestamp() - $this->getStartTime()->getTimestamp();

        return round($diff / (60 * 60), 2);
    }

    /**
     * Set cost
     *
     * @param string $cost
     *
     * @return ProductivityItem
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
     * Set type
     *
     * @param string $type
     *
     * @return ProductivityItem
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ProductivityItem
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set drillingInterval
     *
     * @param string $drillingInterval
     *
     * @return ProductivityItem
     */
    public function setDrillingInterval($drillingInterval)
    {
        $this->drillingInterval = $drillingInterval;

        return $this;
    }

    /**
     * Get drillingInterval
     *
     * @return string
     */
    public function getDrillingInterval()
    {
        return $this->drillingInterval;
    }

    /**
     * @deprecated
     *
     * @return DrillingEvent
     */
    public function getEvent()
    {
        return $this->getProject()->getDrillingEvent();
    }

    /**
     * @deprecated
     *
     * @param DrillingEvent $event
     * @return $this
     */
    public function setEvent($event = null)
    {
        $this->getProject()->setDrillingEvent($event);
        return $this;
    }


    /**
     * Set project
     *
     * @param \App\Entity\RV\Project $project
     *
     * @return ProductivityItem
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
     * @return string
     */
    public function getCBP()
    {
        return $this->CBP;
    }

    /**
     * @param string $CBP
     */
    public function setCBP($CBP)
    {
        $this->CBP = $CBP;
    }

    /**
     * @return string
     */
    public function getWSSDays()
    {
        return $this->WSSDays;
    }

    /**
     * @param string $WSSDays
     */
    public function setWSSDays($WSSDays)
    {
        $this->WSSDays = $WSSDays;
    }

    /**
     * @return string
     */
    public function getWSSNights()
    {
        return $this->WSSNights;
    }

    /**
     * @param string $WSSNights
     */
    public function setWSSNights($WSSNights)
    {
        $this->WSSNights = $WSSNights;
    }
}
