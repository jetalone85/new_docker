<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity()
 */
class ProjectAccessArea
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @var ProjectAccessPrivileges[]|Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\RV\ProjectAccessPrivileges", mappedBy="area")
     */
    private $privileges;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return $this
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Collection|ProjectAccessPrivileges[]
     */
    public function getPrivileges()
    {
        return $this->privileges;
    }

    /**
     * @param Collection|ProjectAccessPrivileges[] $privileges
     *
     * @return $this
     */
    public function setPrivileges($privileges = null)
    {
        $this->privileges = $privileges;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name = null)
    {
        $this->name = $name;

        return $this;
    }

    public function __toString()
    {
        return ucwords(str_replace('_', ' ', $this->getName()));
    }
}
