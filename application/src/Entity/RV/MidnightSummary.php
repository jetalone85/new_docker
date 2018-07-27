<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Table(name="rv_midnight_summary")
 * @ORM\Entity(repositoryClass="App\Repository\RV\MidnightSummaryRepository")
 */
class MidnightSummary
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="depth", type="decimal", precision=10, scale=0)
     * @Assert\NotBlank()
     */
    private $depth;

    /**
     * @var string
     *
     * @ORM\Column(name="progress", type="decimal", precision=10, scale=0)
     */
    private $progress;

    /**
     * @var string
     *
     * @ORM\Column(name="remarks", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $remarks;

    /**
     * @var string
     *
     * @ORM\Column(name="weather", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $weather;

    /**
     * @var string
     *
     * @ORM\Column(name="temperature", type="decimal", precision=10, scale=0)
     * @Assert\NotBlank()
     */
    private $temperature;

    /**
     * @var string
     *
     * @ORM\Column(name="rotated", type="decimal", precision=10, scale=0)
     * @Assert\NotBlank()
     */
    private $rotated;

    /**
     * @var string
     *
     * @ORM\Column(name="slid", type="decimal", precision=10, scale=0)
     * @Assert\NotBlank()
     */
    private $slid;

    /**
     * @var string
     *
     * @ORM\Column(name="holeDragUp", type="decimal", precision=10, scale=0)
     * @Assert\NotBlank()
     */
    private $holeDragUp;

    /**
     * @var string
     *
     * @ORM\Column(name="holeDragDown", type="decimal", precision=10, scale=0)
     * @Assert\NotBlank()
     */
    private $holeDragDown;

    /**
     * @var string
     *
     * @ORM\Column(name="actualHookload", type="decimal", precision=10, scale=0)
     * @Assert\NotBlank()
     */
    private $actualHookload;

    /**
     * @var string
     *
     * @ORM\Column(name="allowableHookload", type="decimal", precision=10, scale=0)
     * @Assert\NotBlank()
     */
    private $allowableHookload;

    /**
     * @var string
     *
     * @ORM\Column(name="torque", type="decimal", precision=10, scale=0)
     * @Assert\NotBlank()
     */
    private $torque;

    /**
     * @var string
     *
     * @ORM\Column(name="weakLink", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $weakLink;

    /**
     * @var string
     *
     * @ORM\Column(name="mudType", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $mudType;

    /**
     * @var string
     *
     * @ORM\Column(name="forwardPlan", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $forwardPlan;

    // RELATIONS

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\RV\DailyDrillingReport", mappedBy="midnightSummary")
     */
    private $dailyDrillingReport;

    // METHODS

    /**
     * @return float
     */
    public function getRotatedPercent()
    {
        return (float)$this->getProgress() ? round(($this->getRotated() / $this->getProgress()) * 100) : 0;
    }

    /**
     * @return float
     */
    public function getSlidPercent()
    {
        return (float)$this->getProgress() ? round(($this->getSlid() / $this->getProgress()) * 100) : 0;
    }

    /**
     * Set dailyDrillingReport
     *
     * @param \App\Entity\RV\DailyDrillingReport $dailyDrillingReport
     *
     * @return MidnightSummary
     */
    public function setDailyDrillingReport(\App\Entity\RV\DailyDrillingReport $dailyDrillingReport = null)
    {
        $this->dailyDrillingReport = $dailyDrillingReport;
        $dailyDrillingReport->setMidnightSummary($this);

        return $this;
    }

    /**
     * Get dailyDrillingReport
     *
     * @return \App\Entity\RV\DailyDrillingReport
     */
    public function getDailyDrillingReport()
    {
        return $this->dailyDrillingReport;
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
     * Set depth
     *
     * @param string $depth
     *
     * @return MidnightSummary
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;

        return $this;
    }

    /**
     * Get depth
     *
     * @return string
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * Set progress
     *
     * @param string $progress
     *
     * @return MidnightSummary
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;

        return $this;
    }

    /**
     * Get progress
     *
     * @return string
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * Set weather
     *
     * @param string $weather
     *
     * @return MidnightSummary
     */
    public function setWeather($weather)
    {
        $this->weather = $weather;

        return $this;
    }

    /**
     * Get weather
     *
     * @return string
     */
    public function getWeather()
    {
        return $this->weather;
    }

    /**
     * Set temperature
     *
     * @param string $temperature
     *
     * @return MidnightSummary
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;

        return $this;
    }

    /**
     * Get temperature
     *
     * @return string
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * Set rotated
     *
     * @param string $rotated
     *
     * @return MidnightSummary
     */
    public function setRotated($rotated)
    {
        $this->rotated = $rotated;

        return $this;
    }

    /**
     * Get rotated
     *
     * @return string
     */
    public function getRotated()
    {
        return $this->rotated;
    }

    /**
     * Set slid
     *
     * @param string $slid
     *
     * @return MidnightSummary
     */
    public function setSlid($slid)
    {
        $this->slid = $slid;

        return $this;
    }

    /**
     * Get slid
     *
     * @return string
     */
    public function getSlid()
    {
        return $this->slid;
    }

    /**
     * Set holeDragUp
     *
     * @param string $holeDragUp
     *
     * @return MidnightSummary
     */
    public function setHoleDragUp($holeDragUp)
    {
        $this->holeDragUp = $holeDragUp;

        return $this;
    }

    /**
     * Get holeDragUp
     *
     * @return string
     */
    public function getHoleDragUp()
    {
        return $this->holeDragUp;
    }

    /**
     * Set holeDragDown
     *
     * @param string $holeDragDown
     *
     * @return MidnightSummary
     */
    public function setHoleDragDown($holeDragDown)
    {
        $this->holeDragDown = $holeDragDown;

        return $this;
    }

    /**
     * Get holeDragDown
     *
     * @return string
     */
    public function getHoleDragDown()
    {
        return $this->holeDragDown;
    }

    /**
     * Set actualHookload
     *
     * @param string $actualHookload
     *
     * @return MidnightSummary
     */
    public function setActualHookload($actualHookload)
    {
        $this->actualHookload = $actualHookload;

        return $this;
    }

    /**
     * Get actualHookload
     *
     * @return string
     */
    public function getActualHookload()
    {
        return $this->actualHookload;
    }

    /**
     * Set allowableHookload
     *
     * @param string $allowableHookload
     *
     * @return MidnightSummary
     */
    public function setAllowableHookload($allowableHookload)
    {
        $this->allowableHookload = $allowableHookload;

        return $this;
    }

    /**
     * Get allowableHookload
     *
     * @return string
     */
    public function getAllowableHookload()
    {
        return $this->allowableHookload;
    }

    /**
     * Set torque
     *
     * @param string $torque
     *
     * @return MidnightSummary
     */
    public function setTorque($torque)
    {
        $this->torque = $torque;

        return $this;
    }

    /**
     * Get torque
     *
     * @return string
     */
    public function getTorque()
    {
        return $this->torque;
    }

    /**
     * Set weakLink
     *
     * @param string $weakLink
     *
     * @return MidnightSummary
     */
    public function setWeakLink($weakLink)
    {
        $this->weakLink = $weakLink;

        return $this;
    }

    /**
     * Get weakLink
     *
     * @return string
     */
    public function getWeakLink()
    {
        return $this->weakLink;
    }

    /**
     * Set mudType
     *
     * @param string $mudType
     *
     * @return MidnightSummary
     */
    public function setMudType($mudType)
    {
        $this->mudType = $mudType;

        return $this;
    }

    /**
     * Get mudType
     *
     * @return string
     */
    public function getMudType()
    {
        return $this->mudType;
    }

    /**
     * Set forwardPlan
     *
     * @param string $forwardPlan
     *
     * @return MidnightSummary
     */
    public function setForwardPlan($forwardPlan)
    {
        $this->forwardPlan = $forwardPlan;

        return $this;
    }

    /**
     * Get forwardPlan
     *
     * @return string
     */
    public function getForwardPlan()
    {
        return $this->forwardPlan;
    }

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return MidnightSummary
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;

        return $this;
    }

    /**
     * Get remarks
     *
     * @return string
     */
    public function getRemarks()
    {
        return $this->remarks;
    }
}
