<?php

namespace App\Entity\RV;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Update
 *
 * @ORM\Table(name="rv_update")
 * @ORM\Entity(repositoryClass="App\Repository\RV\UpdateRepository")
 */
class Update
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
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="time")
     * @Assert\NotBlank()
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="activity", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $activity;

    /**
     * @var string
     *
     * @ORM\Column(name="remarks", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $remarks;

    /**
     * @var string
     *
     * @ORM\Column(name="forwardPlan", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $forwardPlan;

    /**
     * @var string
     *
     * @ORM\Column(name="handoverNotes", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $handoverNotes;

    /**
     * @var string
     *
     * @ORM\Column(name="currentInterval", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $currentInterval;

    /**
     * @var string
     *
     * @ORM\Column(name="nextMilestone", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nextMilestone;

    /**
     * @var float
     *
     * @ORM\Column(name="depth", type="float")
     * @Assert\NotBlank()
     */
    private $depth;

    /**
     * @var float
     *
     * @ORM\Column(name="lastSurveyDepth", type="float", nullable=true)
     */
    private $lastSurveyDepth;

    /**
     * @var float
     *
     * @ORM\Column(name="lastSurveyInc", type="float", nullable=true)
     */
    private $lastSurveyInc;

    /**
     * @var float
     *
     * @ORM\Column(name="lastSurveyAzimuth", type="float", nullable=true)
     */
    private $lastSurveyAzimuth;

    /**
     * @var float
     *
     * @ORM\Column(name="lastSurveyTVD", type="float", nullable=true)
     */
    private $lastSurveyTVD;

    /**
     * @var float
     *
     * @ORM\Column(name="lastSurveyDLS", type="float", nullable=true)
     */
    private $lastSurveyDLS;

    /**
     * @var string
     *
     * @ORM\Column(name="direction", type="string", nullable=true)
     */
    private $direction;

    /**
     * @var string
     *
     * @ORM\Column(name="reason", type="string", nullable=true)
     */
    private $reason;

    /**
     * @var string
     *
     * @ORM\Column(name="reasonDescription", type="string", nullable=true)
     */
    private $reasonDescription;

    /**
     * @var float
     *
     * @ORM\Column(name="currentDepth", type="float", nullable=true)
     */
    private $currentDepth;

    // RELATIONS

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\DailyDrillingReport", inversedBy="updates")
     */
    private $dailyDrillingReport;

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
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Update
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set activity
     *
     * @param string $activity
     *
     * @return Update
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return string
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set forwardPlan
     *
     * @param string $forwardPlan
     *
     * @return Update
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
     * Set handoverNotes
     *
     * @param string $handoverNotes
     *
     * @return Update
     */
    public function setHandoverNotes($handoverNotes)
    {
        $this->handoverNotes = $handoverNotes;

        return $this;
    }

    /**
     * Get handoverNotes
     *
     * @return string
     */
    public function getHandoverNotes()
    {
        return $this->handoverNotes;
    }

    /**
     * Set currentInterval
     *
     * @param string $currentInterval
     *
     * @return Update
     */
    public function setCurrentInterval($currentInterval)
    {
        $this->currentInterval = $currentInterval;

        return $this;
    }

    /**
     * Get currentInterval
     *
     * @return string
     */
    public function getCurrentInterval()
    {
        return $this->currentInterval;
    }

    /**
     * Set nextMilestone
     *
     * @param string $nextMilestone
     *
     * @return Update
     */
    public function setNextMilestone($nextMilestone)
    {
        $this->nextMilestone = $nextMilestone;

        return $this;
    }

    /**
     * Get nextMilestone
     *
     * @return string
     */
    public function getNextMilestone()
    {
        return $this->nextMilestone;
    }

    /**
     * Set depth
     *
     * @param float $depth
     *
     * @return Update
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;

        return $this;
    }

    /**
     * Get depth
     *
     * @return float
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * Set lastSurveyDepth
     *
     * @param float $lastSurveyDepth
     *
     * @return Update
     */
    public function setLastSurveyDepth($lastSurveyDepth)
    {
        $this->lastSurveyDepth = $lastSurveyDepth;

        return $this;
    }

    /**
     * Get lastSurveyDepth
     *
     * @return float
     */
    public function getLastSurveyDepth()
    {
        return $this->lastSurveyDepth;
    }

    /**
     * Set lastSurveyInc
     *
     * @param float $lastSurveyInc
     *
     * @return Update
     */
    public function setLastSurveyInc($lastSurveyInc)
    {
        $this->lastSurveyInc = $lastSurveyInc;

        return $this;
    }

    /**
     * Get lastSurveyInc
     *
     * @return float
     */
    public function getLastSurveyInc()
    {
        return $this->lastSurveyInc;
    }

    /**
     * Set lastSurveyAzimuth
     *
     * @param float $lastSurveyAzimuth
     *
     * @return Update
     */
    public function setLastSurveyAzimuth($lastSurveyAzimuth)
    {
        $this->lastSurveyAzimuth = $lastSurveyAzimuth;

        return $this;
    }

    /**
     * Get lastSurveyAzimuth
     *
     * @return float
     */
    public function getLastSurveyAzimuth()
    {
        return $this->lastSurveyAzimuth;
    }

    /**
     * Set lastSurveyTVD
     *
     * @param float $lastSurveyTVD
     *
     * @return Update
     */
    public function setLastSurveyTVD($lastSurveyTVD)
    {
        $this->lastSurveyTVD = $lastSurveyTVD;

        return $this;
    }

    /**
     * Get lastSurveyTVD
     *
     * @return float
     */
    public function getLastSurveyTVD()
    {
        return $this->lastSurveyTVD;
    }

    /**
     * Set lastSurveyDLS
     *
     * @param float $lastSurveyDLS
     *
     * @return Update
     */
    public function setLastSurveyDLS($lastSurveyDLS)
    {
        $this->lastSurveyDLS = $lastSurveyDLS;

        return $this;
    }

    /**
     * Get lastSurveyDLS
     *
     * @return float
     */
    public function getLastSurveyDLS()
    {
        return $this->lastSurveyDLS;
    }

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return Update
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

    /**
     * Set dailyDrillingReport
     *
     * @param \App\Entity\RV\DailyDrillingReport $dailyDrillingReport
     *
     * @return Update
     */
    public function setDailyDrillingReport(\App\Entity\RV\DailyDrillingReport $dailyDrillingReport = null)
    {
        $this->dailyDrillingReport = $dailyDrillingReport;

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

    /**
     * Set direction
     *
     * @param string $direction
     *
     * @return Update
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Set reason
     *
     * @param UpdateReasonType $reason
     *
     * @return Update
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return UpdateReasonType
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set reasonDescription
     *
     * @param string $reasonDescription
     *
     * @return Update
     */
    public function setReasonDescription($reasonDescription)
    {
        $this->reasonDescription = $reasonDescription;

        return $this;
    }

    /**
     * Get reasonDescription
     *
     * @return string
     */
    public function getReasonDescription()
    {
        return $this->reasonDescription;
    }

    /**
     * Set currentDepth
     *
     * @param float $currentDepth
     *
     * @return Update
     */
    public function setCurrentDepth($currentDepth)
    {
        $this->currentDepth = $currentDepth;

        return $this;
    }

    /**
     * Get currentDepth
     *
     * @return float
     */
    public function getCurrentDepth()
    {
        return $this->currentDepth;
    }
}
