<?php


namespace App\Entity\RV;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @author Damian Wróblewski
 * @ORM\Entity()
 * @ORM\Table("rv_bit_end")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class BitEnd
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
     * @var Bit
     *
     * @ORM\OneToOne(targetEntity="App\Entity\RV\Bit", mappedBy="end")
     */
    private $bit;

    /**
     * @var string
     *
     * @ORM\Column(name="LOCATION", type="string", length=10, nullable=false)
     * @Serializer\Expose()
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="DULL_CHARACTERISTICS", type="string", length=10, nullable=false)
     * @Serializer\Expose()
     */
    private $dullCharacteristics;

    /**
     * @var string
     *
     * @ORM\Column(name="OTHER_DULL_CHARACTERISTICS", type="string", length=10, nullable=false)
     * @Serializer\Expose()
     */
    private $otherDullCharacteristics;


    /**
     * @var string
     *
     * @ORM\Column(name="REASON_PULLED", type="string", length=10, nullable=false)
     * @Serializer\Expose()
     */
    private $reasonPulled;

    /**
     * @var string
     *
     * @ORM\Column(name="GAUGE", type="string", length=10, nullable=false)
     * @Serializer\Expose()
     */
    private $gauge;


    /**
     * @var string
     *
     * @ORM\Column(name="INNER_CUTTING_STRUCTURE", type="integer", length=1, nullable=false)
     * @Serializer\Expose()
     */
    private $innerCuttingStructure;

    /**
     * @var string
     *
     * @ORM\Column(name="OUTER_CUTTING_STRUCTURE", type="integer", length=1, nullable=false)
     * @Serializer\Expose()
     */
    private $outerCuttingStructure;

    /**
     * @var string
     *
     * @ORM\Column(name="BEARINGS_SEALS", type="string", length=10, nullable=false)
     * @Serializer\Expose()
     */
    private $bearingsSeals;

    /**
     * @return int
     */
    public function getId()//: ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    private function setId(int $id = null)
    {
        $this->id = $id;
        return $this;
    }


    /**
     * @return Bit
     */
    public function getBit()//: ?Bit
    {
        return $this->bit;
    }

    /**
     * @param Bit $bit
     * @return $this
     */
    public function setBit(Bit $bit = null)
    {
        $this->bit = $bit;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation()//: ?string
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return $this
     */
    public function setLocation(string $location = null)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return string
     */
    public function getDullCharacteristics()//: ?string
    {
        return $this->dullCharacteristics;
    }

    /**
     * @param string $dullCharacteristics
     * @return $this
     */
    public function setDullCharacteristics(string $dullCharacteristics = null)
    {
        $this->dullCharacteristics = $dullCharacteristics;
        return $this;
    }

    /**
     * @return string
     */
    public function getOtherDullCharacteristics()//: ?string
    {
        return $this->otherDullCharacteristics;
    }

    /**
     * @param string $otherDullCharacteristics
     * @return $this
     */
    public function setOtherDullCharacteristics(string $otherDullCharacteristics = null)
    {
        $this->otherDullCharacteristics = $otherDullCharacteristics;
        return $this;
    }

    /**
     * @return string
     */
    public function getReasonPulled()//: ?string
    {
        return $this->reasonPulled;
    }

    /**
     * @param string $reasonPulled
     * @return $this
     */
    public function setReasonPulled(string $reasonPulled = null)
    {
        $this->reasonPulled = $reasonPulled;
        return $this;
    }

    /**
     * @return string
     */
    public function getGauge()//: ?string
    {
        return $this->gauge;
    }

    /**
     * @param string $gauge
     * @return $this
     */
    public function setGauge(string $gauge = null)
    {
        $this->gauge = $gauge;
        return $this;
    }

    /**
     * @return string
     */
    public function getInnerCuttingStructure()//: ?string
    {
        return $this->innerCuttingStructure;
    }

    /**
     * @param string $innerCuttingStructure
     * @return $this
     */
    public function setInnerCuttingStructure(string $innerCuttingStructure = null)
    {
        $this->innerCuttingStructure = $innerCuttingStructure;
        return $this;
    }

    /**
     * @return string
     */
    public function getOuterCuttingStructure()//: ?string
    {
        return $this->outerCuttingStructure;
    }

    /**
     * @param string $outerCuttingStructure
     * @return $this
     */
    public function setOuterCuttingStructure(string $outerCuttingStructure = null)
    {
        $this->outerCuttingStructure = $outerCuttingStructure;
        return $this;
    }

    /**
     * @return string
     */
    public function getBearingsSeals()//: ?string
    {
        return $this->bearingsSeals;
    }

    /**
     * @param string $bearingsSeals
     * @return $this
     */
    public function setBearingsSeals(string $bearingsSeals = null)
    {
        $this->bearingsSeals = $bearingsSeals;
        return $this;
    }


    public function __clone()
    {
        $this->setId(null);
    }
}
