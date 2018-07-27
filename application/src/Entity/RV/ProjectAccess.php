<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Shared\Company;
use App\Entity\User;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity()
 * @Serializer\ExclusionPolicy("all")
 */
class ProjectAccess
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
     * @var Project
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\Project", inversedBy="access")
     */
    private $project;

    /**
     * @var Company
     * @ORM\ManyToOne(targetEntity="App\Entity\Shared\Company", inversedBy="projectAccess")
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $company;

    /**
     * @var ProjectAccessPrivileges[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\RV\ProjectAccessPrivileges", mappedBy="access", cascade={"all"}, orphanRemoval=true)
     */
    private $privileges;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $createdBy;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $updatedBy;

    public function __construct()
    {
        $this->privileges = new ArrayCollection();
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
     *
     * @return $this
     */
    public function setProject(Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param Company $company
     *
     * @return $this
     */
    public function setCompany(Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return ProjectAccessPrivileges[]|Collection
     */
    public function getPrivileges()
    {
        return $this->privileges;
    }

    /**
     * @param ProjectAccessPrivileges[]|Collection $privileges
     *
     * @return $this
     */
    public function setPrivileges($privileges = null)
    {
        foreach ($privileges as $privilege) {
            $privilege->setAccess($this);
        }
        $this->privileges = $privileges;
        return $this;
    }

    /**
     * @param ProjectAccessPrivileges $privilege
     *
     * @return $this
     */
    public function addPrivilege($privilege = null)
    {
        $this->getPrivileges()->add($privilege);
        $privilege->setAccess($this);

        return $this;
    }

    /**
     * @param ProjectAccessPrivileges $privilege
     *
     * @return $this
     */
    public function removePrivilege($privilege = null)
    {
        $this->getPrivileges()->removeElement($privilege);

        return $this;
    }

    /**
     * @return string
     *
     * @Serializer\VirtualProperty()
     * @Serializer\Expose()
     */
    public function getPrivilegesShort()
    {
        $innerCount = 0;
        foreach ($this->getPrivileges() as $privilege) {
            $innerCount += count($privilege->getPrivileges());
        }

        return count($this->getPrivileges()) . ' area(s) with ' . $innerCount . ' privilege(s) total';
    }

    /**
     * @return User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param User $createdBy
     *
     * @return $this
     */
    public function setCreatedBy(User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return User
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param User $updatedBy
     *
     * @return $this
     */
    public function setUpdatedBy(User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }
}
