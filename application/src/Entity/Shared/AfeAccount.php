<?php

namespace App\Entity\Shared;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\RV\AfeCostReport;
use App\Entity\RV\RentalItem;
use App\Entity\RV\ProjectType;
use App\Entity\User;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\Shared\AfeAccountRepository")
 * @Serializer\ExclusionPolicy("all")
 *
 * @package App\Entity\Shared
 */
class AfeAccount
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     *
     * @var string
     */
    protected $number;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\ProjectType", inversedBy="afeAccounts")
     * @ORM\JoinColumn(name="project_type_id", referencedColumnName="id")
     *
     * @var ProjectType
     */
    protected $projectType;

    /**
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="afeAccounts")
     *
     * @var Company
     */
    protected $company;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RV\AfeCostReport", mappedBy="afeAccount")
     *
     * @var Collection|AfeCostReport[]
     */
    protected $afeCostReports;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RV\MaterialTransferOperation", mappedBy="afeAccount")
     *
     * @var Collection|AfeCostReport[]
     */
    protected $materialTransferOperations;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     *
     * @var User
     */
    protected $createdBy;


    /**
     * AfeAccount constructor.
     */
    public function __construct()
    {
        $this->afeCostReports = new ArrayCollection();
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
     * @return AfeAccount
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
     * Set number
     *
     * @param string $number
     *
     * @return AfeAccount
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return AfeAccount
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
     * Set projectType
     *
     * @param ProjectType $projectType
     *
     * @return AfeAccount
     */
    public function setProjectType(ProjectType $projectType)
    {
        $this->projectType = $projectType;

        return $this;
    }

    /**
     * Get projectType
     *
     * @return ProjectType
     */
    public function getProjectType()
    {
        return $this->projectType;
    }

    /**
     * Set company
     *
     * @param Company $company
     *
     * @return AfeAccount
     */
    public function setCompany(Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Add afeCostReport
     *
     * @param AfeCostReport $afeCostReport
     *
     * @return AfeAccount
     */
    public function addAfeCostReport(AfeCostReport $afeCostReport)
    {
        $this->afeCostReports[] = $afeCostReport;

        return $this;
    }

    /**
     * Remove afeCostReport
     *
     * @param AfeCostReport $afeCostReport
     */
    public function removeAfeCostReport(AfeCostReport $afeCostReport)
    {
        $this->afeCostReports->removeElement($afeCostReport);
    }

    /**
     * Get afeCostReports
     *
     * @return Collection
     */
    public function getAfeCostReports()
    {
        return $this->afeCostReports;
    }

    /**
     * Set createdBy
     *
     * @param User $createdBy
     *
     * @return AfeAccount
     */
    public function setCreatedBy(User $createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function __toString()
    {
        return (string)$this->id;
    }
}
