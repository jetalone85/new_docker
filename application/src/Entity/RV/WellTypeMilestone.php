<?php

namespace App\Entity\RV;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RV\WellTypeMilestoneRepository")
 * @ORM\Table("well_type_milestones")
 * @Serializer\ExclusionPolicy("all")
 */
class WellTypeMilestone implements SimpleTypeInterface
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
     * @var WellType
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\WellType", inversedBy="milestones", cascade={"persist"})
     */
    private $wellType;

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

    public function getWellType()
    {
        return $this->wellType;
    }

    public function setWellType($wellType)
    {
        $this->wellType = $wellType;
    }
}
