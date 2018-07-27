<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Table(name="rv_man_power_report")
 * @ORM\Entity(repositoryClass="App\Repository\RV\ManPowerReportRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class ManPowerReport
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
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\DailyDrillingReport", inversedBy="manPowerReports", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $dailyReport;

    /**
     * @var SafetyTag
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\SafetyTag")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $safetyTag;

    /**
     * @var string
     *
     * @ORM\Column(name="COMPANY", type="string", length=255)
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $job;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMBER_OF_PERSONS", type="integer")
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $numberOfPersons;

    /**
     * @var int
     *
     * @ORM\Column(name="HOURS", type="integer")
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $hours;

    /**
     * @var string
     *
     * @ORM\Column(name="COMMENTS", type="string", length=255)
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $comments;

    /**
     * @var string
     *
     * @ORM\Column(name="CARRY_FORWARD", type="string", length=6)
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $carryForward = 'No';

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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set safetyTag
     *
     * @param string $safetyTag
     *
     * @return ManPowerReport
     */
    public function setSafetyTag($safetyTag)
    {
        $this->safetyTag = $safetyTag;

        return $this;
    }

    /**
     * Get safetyTag
     *
     * @return string
     */
    public function getSafetyTag()
    {
        return $this->safetyTag;
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return ManPowerReport
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set numberOfPersons
     *
     * @param string $numberOfPersons
     *
     * @return ManPowerReport
     */
    public function setNumberOfPersons($numberOfPersons)
    {
        $this->numberOfPersons = $numberOfPersons;

        return $this;
    }

    /**
     * Get numberOfPersons
     *
     * @return string
     */
    public function getNumberOfPersons()
    {
        return $this->numberOfPersons;
    }

    /**
     * Set hours
     *
     * @param integer $hours
     *
     * @return ManPowerReport
     */
    public function setHours($hours)
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * Get hours
     *
     * @return int
     */
    public function getHours()
    {
        return $this->hours;
    }


    /**
     * @return int
     * @Serializer\VirtualProperty()
     */
    public function getTotalHours()
    {
        return $this->getHours() * $this->getNumberOfPersons();
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return ManPowerReport
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
     * @return string
     */
    public function getCarryForward()
    {
        return $this->carryForward;
    }

    /**
     * @param string $carryForward
     * @return $this
     */
    public function setCarryForward(string $carryForward = null)
    {
        $this->carryForward = $carryForward;
        return $this;
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
     * Set job
     *
     * @param string $job
     *
     * @return ManPowerReport
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ManPowerReport
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
}
