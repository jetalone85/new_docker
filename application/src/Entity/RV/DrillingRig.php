<?php

namespace App\Entity\RV;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * DrillingRig class.
 *
 * @ORM\Table(name="rv_drilling_rig")
 * @ORM\Entity(repositoryClass="App\Repository\RV\DrillingRigRepository")
 * @Serializer\ExclusionPolicy("all")
 *
 * @package App\Entity\RV
 * @author Michał Haracewiat <michal.haracewiat@polcode.net>
 */
class DrillingRig
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose()
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(name="company", type="string", length=255)
     * @Serializer\Expose()
     *
     * @var string
     */
    protected $company;

    /**
     * @ORM\Column(name="number", type="integer")
     * @Serializer\Expose()
     *
     * @var int
     */
    protected $number;

    /**
     * @ORM\OneToMany(targetEntity="RigInspection", mappedBy="drillingRig")
     * @ORM\OrderBy({"date" = "DESC"})
     *
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EXTRA_LAZY"
     *
     * @var Collection|RigInspection[]
     */
    protected $rigInspections;


    /**
     * @var Project
     * @ORM\OneToOne(targetEntity="Project", inversedBy="drillingRig")
     * @ORM\JoinColumn(nullable=false)
     *
     * @var Licence
     */
    protected $project;


    /**
     * DrillingRig constructor.
     *
     * @codeCoverageIgnore
     *
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->setProject($project);
    }


    /**
     * Get id
     *
     * @codeCoverageIgnore
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set company
     *
     * @codeCoverageIgnore
     *
     * @param string $company
     * @return DrillingRig
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set number
     *
     * @codeCoverageIgnore
     *
     * @param integer $number
     * @return DrillingRig
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @codeCoverageIgnore
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set licence
     *
     * @param Project $licence
     *
     * @return DrillingRig
     */
    public function setProject(Project $licence)
    {
        $this->project = $licence;

        return $this;
    }

    /**
     * Get licence
     *
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }


    /**
     * Add rigInspection
     *
     * @param \App\Entity\RV\RigInspection $rigInspection
     *
     * @return DrillingRig
     */
    public function addRigInspection(\App\Entity\RV\RigInspection $rigInspection)
    {
        $this->rigInspections[] = $rigInspection;

        return $this;
    }

    /**
     * Remove rigInspection
     *
     * @param \App\Entity\RV\RigInspection $rigInspection
     */
    public function removeRigInspection(\App\Entity\RV\RigInspection $rigInspection)
    {
        $this->rigInspections->removeElement($rigInspection);
    }

    /**
     * Get rigInspections
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRigInspections()
    {
        return $this->rigInspections;
    }
}
