<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Table(name="project_well_type")
 * @ORM\Entity()
 */
class ProjectWellType
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="projectWellType")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     *
     * @var Project
     */
    protected $project;

    /**
     * @var WellType
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\WellType")
     * @ORM\JoinColumn(name="well_type_id", referencedColumnName="id")
     */
    private $wellType;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RV\ProjectWellTypeInterval", mappedBy="projectWellType", cascade={"all"})
     *
     * @var Collection|ProjectWellTypeInterval[]
     */
    protected $intervals;

    public function __construct()
    {
        $this->intervals = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * @return WellType
     */
    public function getWellType()
    {
        return $this->wellType;
    }

    /**
     * @param WellType $wellType
     */
    public function setWellType($wellType)
    {
        $this->wellType = $wellType;
    }

    /**
     * @return Collection|ProjectWellTypeInterval[]
     */
    public function getIntervals()
    {
        return $this->intervals;
    }

    /**
     * @param Collection|ProjectWellTypeInterval[] $intervals
     */
    public function setIntervals($intervals)
    {
        $this->intervals = $intervals;
    }
}
