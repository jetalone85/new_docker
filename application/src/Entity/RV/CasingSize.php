<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RV\CasingSizeRepository")
 * @ORM\Table("rv_casing_sizes")
 * @Serializer\ExclusionPolicy("all")
 */
class CasingSize
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
     * @var int
     *
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     * @Serializer\SerializedName("innerDiameter")
     */
    private $innerDiameter;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     * @Serializer\SerializedName("outerDiameter")
     */
    private $outerDiameter;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean")
     */
    private $deleted = false;

    public function getId()
    {
        return $this->id;
    }

    public function getInnerDiameter()
    {
        return $this->innerDiameter;
    }

    public function setInnerDiameter($innerDiameter)
    {
        $this->innerDiameter = $innerDiameter;
    }

    public function getOuterDiameter()
    {
        return $this->outerDiameter;
    }

    public function setOuterDiameter($outerDiameter)
    {
        $this->outerDiameter = $outerDiameter;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function isDeleted()
    {
        return $this->deleted;
    }

    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    public function getName()
    {
        return sprintf(
            'ID: %01.2f (mm), OD: %01.2f (mm), Weight: %01.2f (kg/m)',
            $this->getInnerDiameter(),
            $this->getOuterDiameter(),
            $this->getWeight()
        );
    }
}
