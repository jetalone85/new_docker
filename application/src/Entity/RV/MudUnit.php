<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Table(name="rv_mud_unit")
 * @ORM\Entity(repositoryClass="App\Repository\RV\MudUnitRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class MudUnit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="abreviation", type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $abreviation;

    /**
     * @var string
     *
     * @ORM\Column(name="system", type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $system;

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
     * Set name
     *
     * @param string $name
     *
     * @return MudUnit
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
     * Set abreviation
     *
     * @param string $abreviation
     *
     * @return MudUnit
     */
    public function setAbreviation($abreviation)
    {
        $this->abreviation = $abreviation;

        return $this;
    }

    /**
     * Get abreviation
     *
     * @return string
     */
    public function getAbreviation()
    {
        return $this->abreviation;
    }

    /**
     * Set system
     *
     * @param string $system
     *
     * @return MudUnit
     */
    public function setSystem($system)
    {
        $this->system = $system;

        return $this;
    }

    /**
     * Get system
     *
     * @return string
     */
    public function getSystem()
    {
        return $this->system;
    }
}
