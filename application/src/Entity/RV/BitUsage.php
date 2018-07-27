<?php

namespace App\Entity\RV;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BitUsage
 *
 *
 * @ORM\MappedSuperclass
 * @ORM\Table(name="rv_bit_usage")
 * @ORM\Entity
 *
 * @Serializer\ExclusionPolicy("all")
 *
 */
class BitUsage
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\Expose()
     */
    private $id;


    /**
     * @var DailyDrillingReport
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\DailyDrillingReport", inversedBy="bitRecords")
     */
    private $dailyDrillingReport;

    /**
     * @var Bit
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\Bit", inversedBy="usages", cascade={"persist"})
     *
     * @Serializer\Expose()
     *
     * @Assert\Valid()
     */
    private $bit;

    /**
     * @var integer
     *
     * @ORM\Column(name="tourNo", type="integer")
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $tourNo;

    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=10, scale=0, nullable=false)
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $dayStartDepth;

    /**
     * @var float
     *
     * @ORM\Column(type="float", precision=10, scale=0, nullable=false)
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $dayEndDepth;

    /**
     * @var float
     *
     * @ORM\Column(name="DRILLING_HOURS", type="float", precision=10, scale=0, nullable=false)
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $drillingHours;

    /**
     * @var float
     *
     * @ORM\Column(name="WOB_MIN", type="float", precision=10, scale=0, nullable=true)
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $wobMin;

    /**
     * @var float
     *
     * @ORM\Column(name="WOB_MAX", type="float", precision=10, scale=0, nullable=true)
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $wobMax;

    /**
     * @var float
     *
     * @ORM\Column(name="RPM_MIN", type="float", precision=10, scale=0, nullable=true)
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $rpmMin;

    /**
     * @var float
     *
     * @ORM\Column(name="RPM_MAX", type="float", precision=10, scale=0, nullable=true)
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $rpmMax;

    /**
     * @var string
     *
     * @ORM\Column(name="REMARKS", type="string", length=500, nullable=true)
     * @Serializer\Expose()
     *
     */
    private $remarks;

    /**
     * @return int
     */
    public function getId()//: ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getTourNo()
    {
        return $this->tourNo;
    }

    /**
     * @param int|null $tourNo
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
    public function getDailyDrillingReport()//: ?DailyDrillingReport
    {
        return $this->dailyDrillingReport;
    }

    /**
     * @param DailyDrillingReport $dailyDrillingReport
     * @return $this
     */
    public function setDailyDrillingReport(DailyDrillingReport $dailyDrillingReport = null)
    {
        $this->dailyDrillingReport = $dailyDrillingReport;
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
    public function getDayStartDepth()//: ?float
    {
        return $this->dayStartDepth;
    }

    /**
     * @param float $depthIn
     * @return $this
     */
    public function setDayStartDepth(float $depthIn = null)
    {
        $this->dayStartDepth = $depthIn;
        return $this;
    }

    /**
     * @return float
     */
    public function getDayEndDepth()//: ?float
    {
        return $this->dayEndDepth;
    }

    /**
     * @param float $depthOut
     * @return $this
     */
    public function setDayEndDepth(float $depthOut = null)
    {
        $this->dayEndDepth = $depthOut;
        return $this;
    }

    /**
     * @return float
     * @Serializer\VirtualProperty()
     */
    public function getRunLength()//: ?float
    {
        return $this->getDayEndDepth() - $this->getDayStartDepth();
    }

    /**
     * @return float
     */
    public function getDrillingHours()//: ?float
    {
        return $this->drillingHours;
    }

    /**
     * @param float $drillingHours
     * @return $this
     */
    public function setDrillingHours(float $drillingHours = null)
    {
        $this->drillingHours = $drillingHours;
        return $this;
    }

    /**
     * @return float
     *
     * @Serializer\VirtualProperty()
     */
    public function getRop()//: ?float
    {
        return $this->getDrillingHours() != 0 ? $this->getRunLength() / $this->getDrillingHours() : 0;
    }

    /**
     * @return float
     */
    public function getWobMin()//: ?float
    {
        return $this->wobMin;
    }

    /**
     * @param float $wobMin
     * @return $this
     */
    public function setWobMin(float $wobMin = null)
    {
        $this->wobMin = $wobMin;
        return $this;
    }

    /**
     * @return float
     */
    public function getWobMax()//: ?float
    {
        return $this->wobMax;
    }

    /**
     * @param float $wobMax
     * @return $this
     */
    public function setWobMax(float $wobMax = null)
    {
        $this->wobMax = $wobMax;
        return $this;
    }

    /**
     * @return float
     */
    public function getRpmMin()//: ?float
    {
        return $this->rpmMin;
    }

    /**
     * @param float $rpmMin
     * @return $this
     */
    public function setRpmMin(float $rpmMin = null)
    {
        $this->rpmMin = $rpmMin;
        return $this;
    }

    /**
     * @return float
     */
    public function getRpmMax()//: ?float
    {
        return $this->rpmMax;
    }

    /**
     * @param float $rpmMax
     * @return $this
     */
    public function setRpmMax(float $rpmMax = null)
    {
        $this->rpmMax = $rpmMax;
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

    /**
     * @return BitEnd|null
     */
    public function getEnd()
    {
        return $this->getBit() ? $this->getBit()->getEnd() : null;
    }


    /**
     * @param BitEnd|null $end
     * @return $this
     */
    public function setEnd(BitEnd $end = null)
    {
        $this->getBit() && $this->getBit()->setEnd($end);
        return $this;
    }
}
