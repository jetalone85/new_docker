<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RV\WellTypeRepository")
 * @ORM\Table("well_types")
 * @Serializer\ExclusionPolicy("all")
 */
class WellType implements SimpleTypeInterface
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
     * @var string
     *
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean")
     */
    private $deleted = false;

    /**
     * @var WellTypeMilestone[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\RV\WellTypeMilestone", mappedBy="wellType")
     */
    private $milestones;

    public function __construct()
    {
        $this->milestones = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function isDeleted()
    {
        return $this->deleted;
    }

    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * @return ArrayCollection|WellTypeMilestone[]
     */
    public function getMilestones()
    {
        return $this->milestones;
    }

    /**
     * @param ArrayCollection|WellTypeMilestone[] $milestones
     */
    public function setMilestones($milestones)
    {
        $this->milestones = $milestones;
    }
}
