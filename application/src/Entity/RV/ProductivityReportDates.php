<?php

namespace App\Entity\RV;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="rv_productivity_report_dates")
 * @ORM\Entity()
 */
class ProductivityReportDates
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $startDate;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $spudDate;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $afeRRDate;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $afeEndDate;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $lastUpdatedTime;

    /**
     * @ORM\OneToOne(targetEntity="Project", inversedBy="productivityReportDates")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     *
     * @var Project
     */
    protected $project;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return DateTime
     */
    public function getSpudDate()
    {
        return $this->spudDate;
    }

    /**
     * @param DateTime $spudDate
     */
    public function setSpudDate($spudDate)
    {
        $this->spudDate = $spudDate;
    }

    /**
     * @return DateTime
     */
    public function getAfeRRDate()
    {
        return $this->afeRRDate;
    }

    /**
     * @param DateTime $afeRRDate
     */
    public function setAfeRRDate($afeRRDate)
    {
        $this->afeRRDate = $afeRRDate;
    }

    /**
     * @return DateTime
     */
    public function getAfeEndDate()
    {
        return $this->afeEndDate;
    }

    /**
     * @param DateTime $afeEndDate
     */
    public function setAfeEndDate($afeEndDate)
    {
        $this->afeEndDate = $afeEndDate;
    }

    /**
     * @return DateTime
     */
    public function getLastUpdatedTime()
    {
        return $this->lastUpdatedTime;
    }

    /**
     * @param DateTime $lastUpdatedTime
     */
    public function setLastUpdatedTime($lastUpdatedTime)
    {
        $this->lastUpdatedTime = $lastUpdatedTime;
    }

    /**
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param Project $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }
}
