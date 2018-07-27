<?php

namespace App\Entity\RV;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Shared\AfeAccount;

/**
 * Project class.
 *
 * @ORM\Table(name="rv_project_type")
 * @ORM\Entity(repositoryClass="App\Repository\RV\ProjectTypeRepository")
 */
class ProjectType
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
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Project", mappedBy="projectType")
     *
     * @var Collection|Project[]
     */
    protected $projects;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Shared\AfeAccount", mappedBy="projectType")
     *
     * @var Collection|AfeAccount[]
     */
    protected $afeAccounts;



    /**
     * ProjectType constructor.
     */
    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }


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
     * @return ProjectType
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
     * Add project
     *
     * @param Project $project
     *
     * @return ProjectType
     */
    public function addProject(Project $project)
    {
        $this->projects[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param Project $project
     */
    public function removeProject(Project $project)
    {
        $this->projects->removeElement($project);
    }

    /**
     * Get projects
     *
     * @return Collection|Project[]
     */
    public function getProjects()
    {
        return $this->projects;
    }
}
