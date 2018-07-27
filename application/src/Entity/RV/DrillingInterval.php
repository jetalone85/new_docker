<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Table(name="rv_drilling_interval")
 * @ORM\Entity(repositoryClass="App\Repository\RV\DrillingIntervalRepository")
 * @Serializer\ExclusionPolicy("all")
 *
 * @package App\Entity\RV
 */
class DrillingInterval
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
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\ProjectWellTypeInterval")
     * @ORM\JoinColumn(name="drilling_interval", referencedColumnName="id", nullable=true)
     * @Serializer\Expose()
     *
     * @var ProjectWellTypeInterval
     */
    protected $interval;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    protected $section;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    protected $holeSize;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     * @Serializer\SerializedName("afe_md")
     */
    protected $afeMD;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     * @Serializer\SerializedName("actual_md")
     */
    protected $actualMD;

    // RELATIONS

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="drillingIntervals")
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
     * @return ProjectWellTypeInterval
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * @param ProjectWellTypeInterval $interval
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
    }

    /**
     * @return string
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @param string $section
     */
    public function setSection($section)
    {
        $this->section = $section;
    }

    /**
     * @return string
     */
    public function getHoleSize()
    {
        return $this->holeSize;
    }

    /**
     * @param string $holeSize
     */
    public function setHoleSize($holeSize)
    {
        $this->holeSize = $holeSize;
    }

    /**
     * @return string
     */
    public function getAfeMD()
    {
        return $this->afeMD;
    }

    /**
     * @param string $afeMD
     */
    public function setAfeMD($afeMD)
    {
        $this->afeMD = $afeMD;
    }

    /**
     * @return string
     */
    public function getActualMD()
    {
        return $this->actualMD;
    }

    /**
     * @param string $actualMD
     */
    public function setActualMD($actualMD)
    {
        $this->actualMD = $actualMD;
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
