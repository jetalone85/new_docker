<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Table(name="rv_casing_piece")
 * @ORM\Entity(repositoryClass="App\Repository\RV\CasingPieceRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class CasingPiece
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
     * @var CasingGroup
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\CasingGroup")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $group;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\CasingGroupItem")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="length", type="decimal", precision=10, scale=0)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $length;

    /**
     * @var string
     *
     * @ORM\Column(name="`in`", type="boolean", nullable=true)
     * @Serializer\Expose()
     */
    private $in;

    /**
     * @var int
     *
     * @ORM\Column(name="torque", type="integer")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $torque;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="`order`", type="integer", nullable=true)
     * @Serializer\Expose()
     */
    private $order;

    // RELATIONS

    /**
     * @ORM\ManyToOne(targetEntity="CasingSegment", inversedBy="casingPieces")
     */
    private $casingSegment;

    /**
     * @var ManufacturedCasing
     *
     * @ORM\ManyToOne(targetEntity="ManufacturedCasing")
     * @ORM\JoinColumn(fieldName="manufactured_casing_id", referencedColumnName="id", nullable=true)
     * @Serializer\Expose()
     */
    private $manufacturedCasing;

    /**
     * @var CasingSize
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\CasingSize")
     * @ORM\JoinColumn(fieldName="size_id", referencedColumnName="id", nullable=true)
     * @Serializer\Expose()
     */
    private $size;

    /**
     * @var Thread
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\Thread")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $thread;

    /**
     * @var Accessory
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\Accessory")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $accessory;

    /**
     * @var Grade
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\Grade")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $grade;

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
     * @return CasingPiece
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
     * Get outerDiameter
     *
     * @return string
     * @Serializer\VirtualProperty()
     * @Serializer\SerializedName("outer_diameter")
     */
    public function getOuterDiameter()
    {
        return $this->manufacturedCasing ? $this->manufacturedCasing->getOuterDiameter() :
            ($this->size ? $this->size->getOuterDiameter() : 0);
    }

    /**
     * Get innerDiameter
     *
     * @return string
     * @Serializer\VirtualProperty()
     * @Serializer\SerializedName("inner_diameter")
     */
    public function getInnerDiameter()
    {
        return $this->manufacturedCasing ? $this->manufacturedCasing->getInnerDiameter() :
            ($this->size ? $this->size->getInnerDiameter() : 0);
    }

    /**
     * Get weight
     *
     * @return string
     * @Serializer\VirtualProperty()
     * @Serializer\SerializedName("weight")
     */
    public function getWeight()
    {
        return $this->manufacturedCasing ? $this->manufacturedCasing->getWeight() :
            ($this->size ? $this->size->getWeight() : 0);
    }

    /**
     * Set thread
     *
     * @param string $thread
     *
     * @return CasingPiece
     */
    public function setThread($thread)
    {
        $this->thread = $thread;

        return $this;
    }

    /**
     * Get thread
     *
     * @return string
     */
    public function getThread()
    {
        return $this->thread;
    }

    /**
     * Set length
     *
     * @param string $length
     *
     * @return CasingPiece
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return string
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set torque
     *
     * @param integer $torque
     *
     * @return CasingPiece
     */
    public function setTorque($torque)
    {
        $this->torque = $torque;

        return $this;
    }

    /**
     * Get torque
     *
     * @return int
     */
    public function getTorque()
    {
        return $this->torque;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return CasingPiece
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set group
     *
     * @param string $group
     *
     * @return CasingPiece
     */
    public function setGroup($group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return CasingGroup
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set in
     *
     * @param boolean $in
     *
     * @return CasingPiece
     */
    public function setIn($in)
    {
        $this->in = $in;

        return $this;
    }

    /**
     * Get in
     *
     * @return boolean
     */
    public function getIn()
    {
        return $this->in;
    }

    /**
     * Set order
     *
     * @param integer $order
     *
     * @return CasingPiece
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set casingSegment
     *
     * @param CasingSegment $casingSegment
     *
     * @return CasingPiece
     */
    public function setCasingSegment(CasingSegment $casingSegment = null)
    {
        $this->casingSegment = $casingSegment;

        return $this;
    }

    /**
     * Get casingSegment
     *
     * @return CasingSegment
     */
    public function getCasingSegment()
    {
        return $this->casingSegment;
    }

    /**
     * @return CasingSize
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param CasingSize $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return Accessory
     */
    public function getAccessory()
    {
        return $this->accessory;
    }

    /**
     * @param Accessory $accessory
     */
    public function setAccessory($accessory)
    {
        $this->accessory = $accessory;
    }

    /**
     * @return Grade
     */
    public function getGrade()
    {
        return $this->manufacturedCasing ? $this->manufacturedCasing->getGrade() : $this->grade;
    }

    /**
     * @param Grade $grade
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;
    }

    /**
     * @return ManufacturedCasing
     */
    public function getManufacturedCasing()
    {
        return $this->manufacturedCasing;
    }

    /**
     * @param ManufacturedCasing $manufacturedCasing
     */
    public function setManufacturedCasing(ManufacturedCasing $manufacturedCasing)
    {
        $this->manufacturedCasing = $manufacturedCasing;
    }
}
