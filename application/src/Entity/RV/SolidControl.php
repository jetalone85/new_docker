<?php


namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Entity()
 * @ORM\Table("rv_solid_control")
 * @Serializer\ExclusionPolicy("all")
 */
class SolidControl
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
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\DailyDrillingReport", inversedBy="solidControls", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $dailyReport;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $tourNo;
    
    
    /**
     * @var string
     * @ORM\Column(type="string")
     *
     * @Serializer\Expose()
     */
    private $equipmentName;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2)
     *
     * @Serializer\Expose()
     */
    private $hoursRun;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2)
     *
     * @Serializer\Expose()
     */
    private $intakeDensity;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2)
     *
     * @Serializer\Expose()
     */
    private $overflowDensity;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2)
     *
     * @Serializer\Expose()
     */
    private $underflowDensity;

    /**
     * @var string
     * @ORM\Column(type="string")
     *
     * @Serializer\Expose()
     */
    private $remarks;

    /**
     * @return int
     */
    public function getId()// : ?int
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
     * @return string
     */
    public function getEquipmentName()//: ?string
    {
        return $this->equipmentName;
    }

    /**
     * @param string $equipmentName
     * @return $this
     */
    public function setEquipmentName(string $equipmentName = null)
    {
        $this->equipmentName = $equipmentName;
        return $this;
    }



    /**
     * @return float
     */
    public function getHoursRun()// : ?float
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
     * @return float
     */
    public function getIntakeDensity()// : ?float
    {
        return $this->intakeDensity;
    }

    /**
     * @param float $intakeDensity
     * @return $this
     */
    public function setIntakeDensity(float $intakeDensity = null)
    {
        $this->intakeDensity = $intakeDensity;
        return $this;
    }

    /**
     * @return float
     */
    public function getOverflowDensity()// : ?float
    {
        return $this->overflowDensity;
    }

    /**
     * @param float $overflowDensity
     * @return $this
     */
    public function setOverflowDensity(float $overflowDensity = null)
    {
        $this->overflowDensity = $overflowDensity;
        return $this;
    }

    /**
     * @return float
     */
    public function getUnderflowDensity()//: ?float
    {
        return $this->underflowDensity;
    }

    /**
     * @param float $underflowDensity
     * @return $this
     */
    public function setUnderflowDensity(float $underflowDensity = null)
    {
        $this->underflowDensity = $underflowDensity;
        return $this;
    }



    /**
     * @return string
     */
    public function getRemarks()// : ?string
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
     * @return DailyDrillingReport
     */
    public function getDailyReport()
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
}
