<?php


namespace App\Entity\RV;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Damian Wróblewski
 * @ORM\Entity(repositoryClass="App\Repository\RV\MudPumpRepository")
 * @ORM\Table("rv_mud_pump")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class MudPump
{
    const STYLE_DUPLEX = 'Duplex';
    const STYLE_TRIPLEX = 'Triplex';


    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Licence
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\Licence", inversedBy="mudPumps")
     * @ORM\JoinColumn(nullable=false)
     */
    private $licence;

    /**
     * @var MudPumpUsage
     * @ORM\OneToMany(targetEntity="MudPumpUsage", mappedBy="mudPump")
     */
    private $mudPumpUsages;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $pumpNo;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $make;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $rentalCompany;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $provider;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $expanseOf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $serialNo;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $strokeLength;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Serializer\Expose()
     */
    private $rodSize;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Serializer\Expose()
     */
    private $efficiency;


    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $pumpStyle;


    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10000)
     * @Serializer\Expose()
     */
    private $remarks;

    /**
     * @return int
     */
    public function getId()// //: ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPumpNo()// //: ?integer
    {
        return $this->pumpNo;
    }

    /**
     * @param int $pumpNo
     * @return $this
     */
    public function setPumpNo(int $pumpNo = null)
    {
        $this->pumpNo = $pumpNo;
        return $this;
    }

    /**
     * @return string
     */
    public function getMake()// //: ?string
    {
        return $this->make;
    }

    /**
     * @param string $make
     * @return $this
     */
    public function setMake(string $make = null)
    {
        $this->make = $make;
        return $this;
    }

    /**
     * @return string
     */
    public function getModel()// //: ?string
    {
        return $this->model;
    }

    /**
     * @param string $model
     * @return $this
     */
    public function setModel(string $model = null)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return string
     */
    public function getProvider()// //: ?string
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     * @return $this
     */
    public function setProvider(string $provider = null)
    {
        $this->provider = $provider;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpanseOf()// //: ?string
    {
        return $this->expanseOf;
    }

    /**
     * @param string $expanseOf
     * @return $this
     */
    public function setExpanseOf(string $expanseOf = null)
    {
        $this->expanseOf = $expanseOf;
        return $this;
    }

    /**
     * @return string
     */
    public function getSerialNo()// //: ?string
    {
        return $this->serialNo;
    }

    /**
     * @param string $serialNo
     * @return $this
     */
    public function setSerialNo(string $serialNo = null)
    {
        $this->serialNo = $serialNo;
        return $this;
    }

    /**
     * @return int
     */
    public function getStrokeLength()// //: ?int
    {
        return $this->strokeLength;
    }

    /**
     * @param int $strokeLength
     * @return $this
     */
    public function setStrokeLength(int $strokeLength = null)
    {
        $this->strokeLength = $strokeLength;
        return $this;
    }

    /**
     * @return float
     */
    public function getRodSize()// //: ?float
    {
        return $this->rodSize;
    }

    /**
     * @param float $rodSize
     * @return $this
     */
    public function setRodSize(float $rodSize = null)
    {
        $this->rodSize = $rodSize;
        return $this;
    }

    /**
     * @return string
     */
    public function getPumpStyle()// //: ?string
    {
        return $this->pumpStyle;
    }

    /**
     * @param string $pumpStyle
     * @return $this
     */
    public function setPumpStyle(string $pumpStyle = null)
    {
        $this->pumpStyle = $pumpStyle;
        return $this;
    }

    /**
     * @return Licence
     */
    public function getLicence()////: ?Licence
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
     * @return string
     */
    public function getRentalCompany()////: ?string
    {
        return $this->rentalCompany;
    }

    /**
     * @param string $rentalCompany
     * @return $this
     */
    public function setRentalCompany(string $rentalCompany = null)
    {
        $this->rentalCompany = $rentalCompany;
        return $this;
    }

    /**
     * @return MudPumpUsage
     */
    public function getMudPumpUsages()//: ?MudPumpUsage
    {
        return $this->mudPumpUsages;
    }

    /**
     * @param MudPumpUsage $mudPumpUsages
     * @return $this
     */
    public function setMudPumpUsages(MudPumpUsage $mudPumpUsages = null)
    {
        $this->mudPumpUsages = $mudPumpUsages;
        return $this;
    }

    /**
     * @return float
     */
    public function getEfficiency()//: ?float
    {
        return $this->efficiency;
    }

    /**
     * @param float $efficiency
     * @return $this
     */
    public function setEfficiency(float $efficiency = null)
    {
        $this->efficiency = $efficiency;
        return $this;
    }

    /**
     * @return string
     */
    public function getRemarks()//: ?string
    {
        return $this->remarks;
    }

    /**
     * @param string $remarks
     * @return $this
     */
    public function setRemarks(string $remarks = null)
    {
        $this->remarks = $remarks;
        return $this;
    }

    public function __toString()
    {
        return $this->getPumpNo() . '. ' . $this->getModel() . ' (' . $this->getSerialNo() . ')';
    }
}
