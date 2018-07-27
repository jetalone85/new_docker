<?php


namespace App\Entity\RV;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Damian Wróblewski
 * @ORM\Entity()
 * @ORM\Table("rv_mud_pump_usage")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class MudPumpUsage
{
    const PRESSURE_TYPE_SINGLE = 'Single';
    const PRESSURE_TYPE_COMBINED = 'Combined';
    const PRESSURE_TYPE_PARALLEL = 'Parallel';

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")-1
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var DailyDrillingReport
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\DailyDrillingReport", inversedBy="mudPumpUsages", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $dailyReport;

    /**
     * @var MudPump
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\MudPump", inversedBy="mudPumpUsages", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     * @Assert\Valid()
     */
    private $mudPump;

    /**
     * @var Bit
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\Bit")
     * @ORM\JoinColumn(nullable=true)
     *
     * @Serializer\Expose()
     *
     *
     */
    private $bit;


    /**
     * @var MudSample
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\MudSample")
     * @ORM\JoinColumn(nullable=true)
     *
     * @Serializer\Expose()
     *
     *
     */
    private $mudSample;


    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank()
     */
    private $tourNo;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $pressureType;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $pressure;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $strokesPerMin;


    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Serializer\Expose()
     */
    private $reducedPressure;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Serializer\Expose()
     */
    private $reducedStrokesPerMin;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Serializer\Expose()
     */
    private $depth;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $linerSize;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $hoursRun;

    /**
     * @var string
     * @ORM\Column(type="string", length=8191)
     * @Serializer\Expose()
     */
    private $remarks;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", nullable=true, precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $drillingPipeDiameter;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", nullable=true, precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $drillingCollarDiameter;


    /**
     * @return int
     */
    public function getId()////: ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getTourNo()// : ?int
    {
        return $this->tourNo;
    }

    /**
     * @param int $piecesCount
     * @return $this
     */
    public function setTourNo(int $tourNo = null)
    {
        $this->tourNo = $tourNo;
        return $this;
    }

    /**
     * @return DailyDrillingReport
     */
    public function getDailyReport()////: ?DailyDrillingReport
    {
        return $this->dailyReport;
    }

    /**
     * @param DailyDrillingReport $dailyReport
     * @return $this
     */
    public function setDailyReport(DailyDrillingReport $dailyReport = null)
    {
        $this->dailyReport = $dailyReport;
        return $this;
    }

    /**
     * @return MudPump
     */
    public function getMudPump()////: ?MudPump
    {
        return $this->mudPump;
    }

    /**
     * @param MudPump $mudPump
     * @return $this
     */
    public function setMudPump(MudPump $mudPump = null)
    {
        $this->mudPump = $mudPump;
        return $this;
    }

    /**
     * @return string
     */
    public function getPressureType()////: ?string
    {
        return $this->pressureType;
    }

    /**
     * @param string $pressureType
     * @return $this
     */
    public function setPressureType(string $pressureType = null)
    {
        $this->pressureType = $pressureType;
        return $this;
    }

    /**
     * @return float
     */
    public function getPressure()////: ?float
    {
        return $this->pressure;
    }

    /**
     * @param float $pressure
     * @return $this
     */
    public function setPressure(float $pressure = null)
    {
        $this->pressure = $pressure;
        return $this;
    }

    /**
     * @return float
     */
    public function getStrokesPerMin()////: ?float
    {
        return $this->strokesPerMin;
    }

    /**
     * @param float $strokesPerMin
     * @return $this
     */
    public function setStrokesPerMin(float $strokesPerMin = null)
    {
        $this->strokesPerMin = $strokesPerMin;
        return $this;
    }

    /**
     * @return float
     */
    public function getDepth()////: ?float
    {
        return $this->depth;
    }

    /**
     * @param float $depth
     * @return $this
     */
    public function setDepth(float $depth = null)
    {
        $this->depth = $depth;
        return $this;
    }

    /**
     * @return string
     */
    public function getLinerSize()////: ?string
    {
        return $this->linerSize;
    }

    /**
     * @param string $linerSize
     * @return $this
     */
    public function setLinerSize(string $linerSize = null)
    {
        $this->linerSize = $linerSize;
        return $this;
    }

    /**
     * @return float
     */
    public function getHoursRun()////: ?float
    {
        return $this->hoursRun;
    }

    /**
     * @param float $hoursRun
     * @return $this
     */
    public function setHoursRun(float $hoursRun = null)
    {
        $this->hoursRun = $hoursRun;
        return $this;
    }

    /**
     * @return string
     */
    public function getRemarks()////: ?string
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
     * @return float
     */
    public function getReducedPressure()//: ?float
    {
        return $this->reducedPressure;
    }

    /**
     * @param float $reducedPressure
     * @return $this
     */
    public function setReducedPressure(float $reducedPressure = null)
    {
        $this->reducedPressure = $reducedPressure;
        return $this;
    }

    /**
     * @return float
     */
    public function getReducedStrokesPerMin()//: ?float
    {
        return $this->reducedStrokesPerMin;
    }

    /**
     * @param float $reducedStrokesPerMin
     * @return $this
     */
    public function setReducedStrokesPerMin(float $reducedStrokesPerMin = null)
    {
        $this->reducedStrokesPerMin = $reducedStrokesPerMin;
        return $this;
    }

    /**
     * @return float
     */
    public function getDrillingPipeDiameter()//: ?float
    {
        return $this->drillingPipeDiameter;
    }

    /**
     * @param float $drillingPipeDiameter
     * @return $this
     */
    public function setDrillingPipeDiameter(float $drillingPipeDiameter = null)
    {
        $this->drillingPipeDiameter = $drillingPipeDiameter;
        return $this;
    }

    /**
     * @return float
     */
    public function getDrillingCollarDiameter()//: ?float
    {
        return $this->drillingCollarDiameter;
    }

    /**
     * @param float $drillingCollarDiameter
     * @return $this
     */
    public function setDrillingCollarDiameter(float $drillingCollarDiameter = null)
    {
        $this->drillingCollarDiameter = $drillingCollarDiameter;
        return $this;
    }

    /**
     * @return MudSample
     */
    public function getMudSample()//: ?MudSample
    {
        return $this->mudSample;
    }

    /**
     * @param MudSample $mudSample
     * @return $this
     */
    public function setMudSample(MudSample $mudSample = null)
    {
        $this->mudSample = $mudSample;
        return $this;
    }


    /**
     * @return float|int
     * @Serializer\VirtualProperty()
     */
    public function getDpAnnularArea()
    {
        if (!$this->getBit()) {
            return null;
        }
        return pow($this->getBit()->getBitSize() / 2, 2) - (pow($this->getDrillingPipeDiameter() / 2, 2)) * M_PI;
    }

    /**
     * @return float|int
     * @Serializer\VirtualProperty()
     */
    public function getDcAnnularArea()
    {
        if (!$this->getBit()) {
            return null;
        }
        return pow($this->getBit()->getBitSize() / 2, 2) - (pow($this->getDrillingCollarDiameter() / 2, 2)) * M_PI;
    }

    /**
     * @return float|int
     * @Serializer\VirtualProperty()
     */
    public function getDpAnnularVelocity()
    {
        if (!$this->getDpAnnularArea()) {
            return null;
        }
        return $this->getPumpVolume() / $this->getDpAnnularArea();
    }

    /**
     * @return float|int
     * @Serializer\VirtualProperty()
     */
    public function getDcAnnularVelocity()
    {
        if (!$this->getDpAnnularArea()) {
            return null;
        }
        return $this->getPumpVolume() / $this->getDcAnnularArea();
    }

    /**
     * @return float|int
     * @Serializer\VirtualProperty()
     */
    public function getPumpVolume()
    {
        if (!$this->getMudPump()) {
            return null;
        }
        $dp = $this->getLinerSize() / 1000;
        $sl = $this->getMudPump()->getStrokeLength() / 1000;
        $dr = $this->getMudPump()->getRodSize() / 1000;
        $spm = $this->getStrokesPerMin();
        $efficiency = $this->getMudPump()->getEfficiency();

        $a = (M_PI * pow($dp, 2)) / 4;

        if ($this->getMudPump()->getPumpStyle() == MudPump::STYLE_TRIPLEX) {
            $litresCycle = $a * $sl * 3;
        } else {
            $b = (M_PI * (pow($dp, 2) - pow($dr, 2))) / 4;
            $litresCycle = ($a + $b) * $sl * 2;
        }

        return round($litresCycle * $spm * $efficiency, 4);
    }

    /**
     * @return float|int
     * @Serializer\VirtualProperty()
     */
    public function getJetVelocity()
    {
        if (!$this->getBit()) {
            return null;
        }
        return $this->getBit()->getTotalFlowArea() ? $this->getPumpVolume() / $this->getBit()->getTotalFlowArea() : null;
    }

    /**
     * @return float
     * @Serializer\VirtualProperty()
     */
    public function getHydraulicHorsePower()
    {
        if (!$this->getBit() || !$this->getMudSample() || !$this->getBit()->getTotalFlowArea()) {
            return null;
        }
        $q = $this->getPumpVolume();
        $mw = $this->getMudSample()->getDensity();
        $tfa = $this->getBit()->getTotalFlowArea();
        if (!$tfa) {
            return null; // div by 0
        }
        $pb = (pow($q, 2) * $mw / pow($tfa, 2)) * 153894;
        $hhp = $pb * $q * 1 / 60 * 1 / 0.745699871582;
        return round($hhp, 4);
    }
}
