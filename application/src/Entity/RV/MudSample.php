<?php


namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Entity()
 * @ORM\Table("rv_mud_sample")
 * @Serializer\ExclusionPolicy("all")
 *
 * @package App\Entity\RV
 * @author Damian Wróblewski <damian.wroblewski@polcode.net>
 */
class MudSample
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
     * @var DailyDrillingReport
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\DailyDrillingReport", inversedBy="mudSamples", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $dailyReport;

    /**
     * @var \DateTime
     * @ORM\Column(type="time")
     * @Serializer\Expose()
     * @Serializer\Type("Time")
     */
    private $time;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $depth;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $density;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $funnelViscosity;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $waterLoss;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Serializer\Expose()
     */
    private $fluidLoss;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $fluidPh;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $test1Type;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $test1Value;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $test2Type;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $test2Value;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $test3Type;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $test3Value;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $test4Type;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $test4Value;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $sampleLocation;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $pvt;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Serializer\Expose()
     */
    private $yp;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Serializer\Expose()
     */
    private $gels10s;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Serializer\Expose()
     */
    private $gels10min;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Serializer\Expose()
     */
    private $fc;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Serializer\Expose()
     */
    private $solids;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Serializer\Expose()
     */
    private $mbt;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Serializer\Expose()
     */
    private $cl;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Serializer\Expose()
     */
    private $ca;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Serializer\Expose()
     */
    private $k;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     * @Serializer\Expose()
     */
    private $oilPercent;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $remarks;


    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s %s, %sm', $this->getDailyReport()->getDate()->format('Y-m-d'), $this->getTime()->format('H:i'), $this->getDepth());
    }


    /**
     * @deprecated
     *
     * @param $vis
     * @return MudSample
     */
    public function setVis($vis)
    {
        @trigger_error(sprintf('The setVis() method is deprecated. Use setFunnelViscosity() instead.'), E_USER_DEPRECATED);
        return $this->setFunnelViscosity($vis);
    }

    /**
     * @deprecated
     *
     * @return string
     */
    public function getVis()
    {
        @trigger_error(sprintf('The getVis() method is deprecated. Use getFunnelViscosity() instead.'), E_USER_DEPRECATED);
        return $this->getFunnelViscosity();
    }

    /**
     * @deprecated
     *
     * @param $pv
     * @return MudSample
     */
    public function setPv($pv)
    {
        @trigger_error(sprintf('The setPv() method is deprecated. Use setPvt() instead.'), E_USER_DEPRECATED);
        return $this->setPvt($pv);
    }

    /**
     * @deprecated
     *
     * @return string
     */
    public function getPv()
    {
        @trigger_error(sprintf('The getPv() method is deprecated. Use getPvt() instead.'), E_USER_DEPRECATED);
        return $this->getPvt();
    }

    /**
     * @deprecated
     *
     * @param $ph
     * @return MudSample
     */
    public function setPh($ph)
    {
        @trigger_error(sprintf('The setPh() method is deprecated. Use setFluidPh() instead.'), E_USER_DEPRECATED);
        return $this->setFluidPh($ph);
    }

    /**
     * @deprecated
     *
     * @return string
     */
    public function getPh()
    {
        @trigger_error(sprintf('The getPh() method is deprecated. Use getFluidPh() instead.'), E_USER_DEPRECATED);
        return $this->getFluidPh();
    }


    /**
     * @Serializer\VirtualProperty()
     *
     * @return string
     */
    public function getTest1()
    {
        return $this->getTest1Type() . ': ' . $this->getTest1Value();
    }

    /**
     * @Serializer\VirtualProperty()
     *
     * @return string
     */
    public function getTest2()
    {
        return $this->getTest2Type() . ': ' . $this->getTest2Value();
    }

    /**
     * @Serializer\VirtualProperty()
     *
     * @return string
     */
    public function getTest3()
    {
        return $this->getTest3Type() . ': ' . $this->getTest3Value();
    }

    /**
     * @Serializer\VirtualProperty()
     *
     * @return string
     */
    public function getTest4()
    {
        return $this->getTest4Type() . ': ' . $this->getTest4Value();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return MudSample
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set depth
     *
     * @param string $depth
     *
     * @return MudSample
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;

        return $this;
    }

    /**
     * Get depth
     *
     * @return string
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * Set density
     *
     * @param string $density
     *
     * @return MudSample
     */
    public function setDensity($density)
    {
        $this->density = $density;

        return $this;
    }

    /**
     * Get density
     *
     * @return string
     */
    public function getDensity()
    {
        return $this->density;
    }

    /**
     * Set funnelViscosity
     *
     * @param string $funnelViscosity
     *
     * @return MudSample
     */
    public function setFunnelViscosity($funnelViscosity)
    {
        $this->funnelViscosity = $funnelViscosity;

        return $this;
    }

    /**
     * Get funnelViscosity
     *
     * @return string
     */
    public function getFunnelViscosity()
    {
        return $this->funnelViscosity;
    }

    /**
     * Set waterLoss
     *
     * @param string $waterLoss
     *
     * @return MudSample
     */
    public function setWaterLoss($waterLoss)
    {
        $this->waterLoss = $waterLoss;

        return $this;
    }

    /**
     * Get waterLoss
     *
     * @return string
     */
    public function getWaterLoss()
    {
        return $this->waterLoss;
    }

    /**
     * Set fluidLoss
     *
     * @param string $fluidLoss
     *
     * @return MudSample
     */
    public function setFluidLoss($fluidLoss)
    {
        $this->fluidLoss = $fluidLoss;

        return $this;
    }

    /**
     * Get fluidLoss
     *
     * @return string
     */
    public function getFluidLoss()
    {
        return $this->fluidLoss;
    }

    /**
     * Set fluidPh
     *
     * @param string $fluidPh
     *
     * @return MudSample
     */
    public function setFluidPh($fluidPh)
    {
        $this->fluidPh = $fluidPh;

        return $this;
    }

    /**
     * Get fluidPh
     *
     * @return string
     */
    public function getFluidPh()
    {
        return $this->fluidPh;
    }

    /**
     * Set test1Type
     *
     * @param string $test1Type
     *
     * @return MudSample
     */
    public function setTest1Type($test1Type)
    {
        $this->test1Type = $test1Type;

        return $this;
    }

    /**
     * Get test1Type
     *
     * @return string
     */
    public function getTest1Type()
    {
        return $this->test1Type;
    }

    /**
     * Set test1Value
     *
     * @param string $test1Value
     *
     * @return MudSample
     */
    public function setTest1Value($test1Value)
    {
        $this->test1Value = $test1Value;

        return $this;
    }

    /**
     * Get test1Value
     *
     * @return string
     */
    public function getTest1Value()
    {
        return $this->test1Value;
    }

    /**
     * Set test2Type
     *
     * @param string $test2Type
     *
     * @return MudSample
     */
    public function setTest2Type($test2Type)
    {
        $this->test2Type = $test2Type;

        return $this;
    }

    /**
     * Get test2Type
     *
     * @return string
     */
    public function getTest2Type()
    {
        return $this->test2Type;
    }

    /**
     * Set test2Value
     *
     * @param string $test2Value
     *
     * @return MudSample
     */
    public function setTest2Value($test2Value)
    {
        $this->test2Value = $test2Value;

        return $this;
    }

    /**
     * Get test2Value
     *
     * @return string
     */
    public function getTest2Value()
    {
        return $this->test2Value;
    }

    /**
     * Set test3Type
     *
     * @param string $test3Type
     *
     * @return MudSample
     */
    public function setTest3Type($test3Type)
    {
        $this->test3Type = $test3Type;

        return $this;
    }

    /**
     * Get test3Type
     *
     * @return string
     */
    public function getTest3Type()
    {
        return $this->test3Type;
    }

    /**
     * Set test3Value
     *
     * @param string $test3Value
     *
     * @return MudSample
     */
    public function setTest3Value($test3Value)
    {
        $this->test3Value = $test3Value;

        return $this;
    }

    /**
     * Get test3Value
     *
     * @return string
     */
    public function getTest3Value()
    {
        return $this->test3Value;
    }

    /**
     * Set test4Type
     *
     * @param string $test4Type
     *
     * @return MudSample
     */
    public function setTest4Type($test4Type)
    {
        $this->test4Type = $test4Type;

        return $this;
    }

    /**
     * Get test4Type
     *
     * @return string
     */
    public function getTest4Type()
    {
        return $this->test4Type;
    }

    /**
     * Set test4Value
     *
     * @param string $test4Value
     *
     * @return MudSample
     */
    public function setTest4Value($test4Value)
    {
        $this->test4Value = $test4Value;

        return $this;
    }

    /**
     * Get test4Value
     *
     * @return string
     */
    public function getTest4Value()
    {
        return $this->test4Value;
    }

    /**
     * Set sampleLocation
     *
     * @param string $sampleLocation
     *
     * @return MudSample
     */
    public function setSampleLocation($sampleLocation)
    {
        $this->sampleLocation = $sampleLocation;

        return $this;
    }

    /**
     * Get sampleLocation
     *
     * @return string
     */
    public function getSampleLocation()
    {
        return $this->sampleLocation;
    }

    /**
     * Set pvt
     *
     * @param string $pvt
     *
     * @return MudSample
     */
    public function setPvt($pvt)
    {
        $this->pvt = $pvt;

        return $this;
    }

    /**
     * Get pvt
     *
     * @return string
     */
    public function getPvt()
    {
        return $this->pvt;
    }

    /**
     * Set yp
     *
     * @param string $yp
     *
     * @return MudSample
     */
    public function setYp($yp)
    {
        $this->yp = $yp;

        return $this;
    }

    /**
     * Get yp
     *
     * @return string
     */
    public function getYp()
    {
        return $this->yp;
    }

    /**
     * Set gels10s
     *
     * @param string $gels10s
     *
     * @return MudSample
     */
    public function setGels10s($gels10s)
    {
        $this->gels10s = $gels10s;

        return $this;
    }

    /**
     * Get gels10s
     *
     * @return string
     */
    public function getGels10s()
    {
        return $this->gels10s;
    }

    /**
     * Set gels10min
     *
     * @param string $gels10min
     *
     * @return MudSample
     */
    public function setGels10min($gels10min)
    {
        $this->gels10min = $gels10min;

        return $this;
    }

    /**
     * Get gels10min
     *
     * @return string
     */
    public function getGels10min()
    {
        return $this->gels10min;
    }

    /**
     * Set fc
     *
     * @param string $fc
     *
     * @return MudSample
     */
    public function setFc($fc)
    {
        $this->fc = $fc;

        return $this;
    }

    /**
     * Get fc
     *
     * @return string
     */
    public function getFc()
    {
        return $this->fc;
    }

    /**
     * Set solids
     *
     * @param string $solids
     *
     * @return MudSample
     */
    public function setSolids($solids)
    {
        $this->solids = $solids;

        return $this;
    }

    /**
     * Get solids
     *
     * @return string
     */
    public function getSolids()
    {
        return $this->solids;
    }

    /**
     * Set mbt
     *
     * @param string $mbt
     *
     * @return MudSample
     */
    public function setMbt($mbt)
    {
        $this->mbt = $mbt;

        return $this;
    }

    /**
     * Get mbt
     *
     * @return string
     */
    public function getMbt()
    {
        return $this->mbt;
    }

    /**
     * Set cl
     *
     * @param string $cl
     *
     * @return MudSample
     */
    public function setCl($cl)
    {
        $this->cl = $cl;

        return $this;
    }

    /**
     * Get cl
     *
     * @return string
     */
    public function getCl()
    {
        return $this->cl;
    }

    /**
     * Set ca
     *
     * @param string $ca
     *
     * @return MudSample
     */
    public function setCa($ca)
    {
        $this->ca = $ca;

        return $this;
    }

    /**
     * Get ca
     *
     * @return string
     */
    public function getCa()
    {
        return $this->ca;
    }

    /**
     * Set k
     *
     * @param string $k
     *
     * @return MudSample
     */
    public function setK($k)
    {
        $this->k = $k;

        return $this;
    }

    /**
     * Get k
     *
     * @return string
     */
    public function getK()
    {
        return $this->k;
    }

    /**
     * Set oilPercent
     *
     * @param string $oilPercent
     *
     * @return MudSample
     */
    public function setOilPercent($oilPercent)
    {
        $this->oilPercent = $oilPercent;

        return $this;
    }

    /**
     * Get oilPercent
     *
     * @return string
     */
    public function getOilPercent()
    {
        return $this->oilPercent;
    }

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return MudSample
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;

        return $this;
    }

    /**
     * Get remarks
     *
     * @return string
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * Set dailyReport
     *
     * @param DailyDrillingReport $dailyReport
     *
     * @return MudSample
     */
    public function setDailyReport(DailyDrillingReport $dailyReport)
    {
        $this->dailyReport = $dailyReport;

        return $this;
    }

    /**
     * Get dailyReport
     *
     * @return DailyDrillingReport
     */
    public function getDailyReport()
    {
        return $this->dailyReport;
    }
}
