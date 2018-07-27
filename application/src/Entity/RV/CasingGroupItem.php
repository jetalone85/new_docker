<?php

namespace App\Entity\RV;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RV\CasingGroupItemRepository")
 * @ORM\Table("rv_casing_group_items")
 */
class CasingGroupItem
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean")
     */
    private $deleted = false;

    /**
     * @var CasingGroup
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\CasingGroup", inversedBy="items", cascade={"persist"})
     */
    private $casingGroup;

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

    public function getCasingGroup()
    {
        return $this->casingGroup;
    }

    public function setCasingGroup($casingGroup)
    {
        $this->casingGroup = $casingGroup;
    }
}
