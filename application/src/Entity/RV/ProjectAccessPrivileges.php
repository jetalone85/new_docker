<?php

namespace App\Entity\RV;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

/**
 * @author Damian Wróblewski
 *
 * @ORM\Entity()
 */
class ProjectAccessPrivileges
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
     * @var ProjectAccess
     *
     * @ORM\ManyToOne(targetEntity="ProjectAccess", inversedBy="privileges")
     */
    private $access;

    /**
     * @var ProjectAccessArea
     *
     * @ORM\ManyToOne(targetEntity="ProjectAccessArea", inversedBy="privileges")
     */
    private $area;

    /**
     * @var array|string[]
     * @ORM\Column(type="simple_array")
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

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ProjectAccess
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @param ProjectAccess $access
     *
     * @return $this
     */
    public function setAccess(ProjectAccess $access = null)
    {
        $this->access = $access;

        return $this;
    }

    /**
     * @return ProjectAccessArea
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param ProjectAccessArea $area
     *
     * @return $this
     */
    public function setArea(ProjectAccessArea $area = null)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * @return array|string[]
     */
    public function getPrivileges()
    {
        return $this->privileges;
    }

    /**
     * @param array|string[] $privileges
     *
     * @return $this
     */
    public function setPrivileges($privileges = null)
    {
        $this->privileges = $privileges;

        return $this;
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
