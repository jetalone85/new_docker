<?php


namespace App\Entity\RV;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Damian Wróblewski
 * @ORM\Entity(repositoryClass="App\Repository\RV\BitRepository")
 * @ORM\Table("rv_bit")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Bit
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var Licence
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\Licence", inversedBy="bits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $licence;

    /**
     * @var BitUsage[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\RV\BitUsage", mappedBy="bit")
     */
    private $usages;

    /**
     * @var BitEnd
     *
     * @ORM\OneToOne(targetEntity="App\Entity\RV\BitEnd", inversedBy="bit", orphanRemoval=true, cascade={"all"})
     *
     * @Serializer\Expose()
     *
     * @Assert\Valid(groups={"bit_end"})
     */
    private $end;

    /**
     * @var integer
     *
     * @ORM\Column(name="bit_no", type="integer", nullable=false)
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $bitNo;


    /**
     * @var float
     *
     * @ORM\Column(name="BIT_SIZE", type="float", precision=10, scale=0, nullable=false)
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $bitSize;

    /**
     * @var string
     *
     * @ORM\Column(name="BIT_TYPE", type="string", length=50, nullable=false)
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $bitType;

    /**
     * @var integer
     *
     * @ORM\Column(name="BIT_SERIAL_NUM", type="string", nullable=false)
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $bitSerialNum;


    /**
     * @var string
     *
     * @ORM\Column(name="MANUFACTURER", type="string", length=50, nullable=false)
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $manufacturer;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $bitCategory;

    /**
     * @var array|int[]
     *
     * @ORM\Column(type="simple_array", nullable=true)
     * @Serializer\Expose()
     *
     */
    private $jets;

    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=10, scale=0, nullable=true)
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $totalFlowArea;

    public function __construct()
    {
        $this->usages = new ArrayCollection();
    }


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
    public function setId(int $id = null)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Licence
     */
    public function getLicence()//: ?Licence
    {
        return $this->licence;
    }

    /**
     * @param Licence $licence
     * @return $this
     */
    public function setLicence(Licence $licence = null)
    {
        $this->licence = $licence;
        return $this;
    }

    /**
     * @return BitUsage[]|ArrayCollection
     */
    public function getUsages()//: ?array
    {
        return $this->usages;
    }

    /**
     * @param BitUsage[] $usages
     * @return $this
     */
    public function setUsages(array $usages = null)
    {
        $this->usages = $usages;
        return $this;
    }

    /**
     * @return int
     */
    public function getBitNo()//: ?int
    {
        return $this->bitNo;
    }

    /**
     * @param int $bitNo
     * @return $this
     */
    public function setBitNo(int $bitNo = null)
    {
        $this->bitNo = $bitNo;
        return $this;
    }

    /**
     * @return float
     */
    public function getBitSize()//: ?float
    {
        return $this->bitSize;
    }

    /**
     * @param float $bitSize
     * @return $this
     */
    public function setBitSize(float $bitSize = null)
    {
        $this->bitSize = $bitSize;
        return $this;
    }

    /**
     * @return string
     */
    public function getBitType()//: ?string
    {
        return $this->bitType;
    }

    /**
     * @param string $bitType
     * @return $this
     */
    public function setBitType(string $bitType = null)
    {
        $this->bitType = $bitType;
        return $this;
    }

    /**
     * @return string
     */
    public function getBitSerialNum()//: ?int
    {
        return $this->bitSerialNum;
    }

    /**
     * @param string $bitSerialNum
     * @return $this
     */
    public function setBitSerialNum(string $bitSerialNum = null)
    {
        $this->bitSerialNum = $bitSerialNum;
        return $this;
    }

    /**
     * @return string
     */
    public function getManufacturer()//: ?string
    {
        return $this->manufacturer;
    }

    /**
     * @param string $manufacturer
     * @return $this
     */
    public function setManufacturer(string $manufacturer = null)
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }

    /**
     * @return string
     */
    public function getBitCategory()//: ?string
    {
        return $this->bitCategory;
    }

    /**
     * @param string $bitCategory
     * @return $this
     */
    public function setBitCategory(string $bitCategory = null)
    {
        $this->bitCategory = $bitCategory;
        return $this;
    }


    /**
     * @return float
     */
    public function getDepthIn()
    {
        if (!$this->getUsages()->count()) {
            return null;
        }
        $min = $this->getUsages()[0]->getDayStartDepth();

        foreach ($this->getUsages() as $usage) {
            $min = min($usage->getDayStartDepth(), $min);
        }
        return $min;
    }

    /**
     * @return float
     */
    public function getDepthOut()
    {
        if (!$this->getUsages()->count()) {
            return null;
        }
        $max = $this->getUsages()[0]->getDayEndDepth();

        foreach ($this->getUsages() as $usage) {
            $max = max($usage->getDayEndDepth(), $max);
        }
        return $max;
    }

    /**
     * @return float
     */
    public function getRunLength()
    {
        if (!$this->getDepthIn() || !$this->getDepthOut()) {
            return null;
        }
        return $this->getDepthOut() - $this->getDepthIn();
    }


    /**
     * @return float
     */
    public function getDrillingHours()
    {
        $sum = 0;
        foreach ($this->getUsages() as $usage) {
            $sum += $usage->getDrillingHours();
        }
        return $sum;
    }

    /**
     * @return float
     */
    public function getRopAvg()
    {
        if (!$this->getDrillingHours()) {
            return 0;
        }
        return $this->getRunLength() / $this->getDrillingHours();
    }

    /**
     * @return null|string
     */
    public function getRemarks()
    {
        $remarks = [];
        foreach ($this->getUsages() as $usage) {
            if ($usage->getRemarks()) {
                $remarks[] = $usage->getRemarks();
            }
        }
        return implode("\n", $remarks);
    }

    /**
     * @return BitEnd
     */
    public function getEnd()//: ?BitEnd
    {
        return $this->end;
    }

    /**
     * @param BitEnd $end
     * @return $this
     */
    public function setEnd(BitEnd $end = null)
    {
        $this->end = $end;
        return $this;
    }

    /**
     * @return string
     */
    public function getTotalFlowArea()//: ?string
    {
        return $this->totalFlowArea;
    }

    /**
     * @param float $totalFlowArea
     * @return $this
     */
    public function setTotalFlowArea(float $totalFlowArea = null)
    {
        $this->totalFlowArea = $totalFlowArea;
        return $this;
    }

    /**
     * @return array|int[]
     * @Serializer\Expose()
     */
    public function getJets()
    {
        return $this->jets;
    }

    /**
     * @param array|int[] $jets
     * @return $this
     */
    public function setJets($jets = null)
    {
        $this->jets = $jets;
        return $this;
    }

    /**
     * @return string
     * @Serializer\VirtualProperty()
     */
    public function getTfaEnterMethod()
    {
        if ($this->getTotalFlowArea()) {
            return count($this->getJets()) ? 'jets' : 'manual';
        }
        return null;
    }

    /**
     * @param $method
     * @return string
     */
    public function setTfaEnterMethod($method)
    {
        if ($method == 'manual') {
            $this->jets = [];
        }
        return $this;
    }


    public function __toString()
    {
        return $this->getBitNo() . '. ' . $this->getBitSerialNum() . ', ' . $this->getManufacturer() . ', ' . $this->getBitType() . ', ' . $this->getBitSize();
    }
}
