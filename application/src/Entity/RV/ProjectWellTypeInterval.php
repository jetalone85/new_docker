<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Table(name="project_well_type_interval")
 * @ORM\Entity()
 * @Serializer\ExclusionPolicy("all")
 */
class ProjectWellTypeInterval
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
     * @ORM\ManyToOne(targetEntity="ProjectWellType", inversedBy="id")
     * @ORM\JoinColumn(name="project_well_type_id", referencedColumnName="id")
     * @Serializer\Expose()
     *
     * @var ProjectWellType
     */
    protected $projectWellType;

    /**
     * @var WellTypeMilestone
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\WellTypeMilestone")
     * @ORM\JoinColumn(name="milestone_from_id", referencedColumnName="id")
     * @Serializer\Expose()
     */
    private $from;

    /**
     * @var WellTypeMilestone
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\WellTypeMilestone")
     * @ORM\JoinColumn(name="milestone_to_id", referencedColumnName="id")
     * @Serializer\Expose()
     */
    private $to;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    protected $keyWellDays;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    protected $afeDays;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Serializer\Expose()
     */
    protected $actualDays;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ProjectWellType
     */
    public function getProjectWellType()
    {
        return $this->projectWellType;
    }

    /**
     * @param ProjectWellType $projectWellType
     */
    public function setProjectWellType($projectWellType)
    {
        $this->projectWellType = $projectWellType;
    }

    /**
     * @return WellTypeMilestone
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param WellTypeMilestone $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return WellTypeMilestone
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param WellTypeMilestone $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return float
     */
    public function getKeyWellDays()
    {
        return $this->keyWellDays;
    }

    /**
     * @param float $keyWellDays
     */
    public function setKeyWellDays($keyWellDays)
    {
        $this->keyWellDays = $keyWellDays;
    }

    /**
     * @return float
     */
    public function getAfeDays()
    {
        return $this->afeDays;
    }

    /**
     * @param float $afeDays
     */
    public function setAfeDays($afeDays)
    {
        $this->afeDays = $afeDays;
    }

    /**
     * @return float
     */
    public function getActualDays()
    {
        return $this->actualDays;
    }

    /**
     * @param float $actualDays
     */
    public function setActualDays($actualDays)
    {
        $this->actualDays = $actualDays;
    }

    /**
     * @return string
     *
     * @Serializer\Expose()
     * @Serializer\SerializedName("full_name")
     * @Serializer\VirtualProperty()
     */
    public function getFullName()
    {
        return sprintf('%s - %s', $this->getFrom()->getName(), $this->getTo()->getName());
    }

    /**
     * @return int
     *
     * @Serializer\Expose()
     * @Serializer\SerializedName("total_variance")
     * @Serializer\VirtualProperty()
     */
    public function getTotalVariance()
    {
        return floor(($this->afeDays - $this->actualDays)*24);
    }

    public function __toString()
    {
        return $this->getFullName();
    }
}
