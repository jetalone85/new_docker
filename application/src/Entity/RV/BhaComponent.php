<?php

namespace App\Entity\RV;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author Damian Wróblewski
 * @ORM\Entity()
 * @ORM\Table("rv_bha_component")
 */
class BhaComponent
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
     * @var DailyDrillingReport
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\DailyDrillingReport", inversedBy="bhaComponents", cascade={"persist"})
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
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $piecesCount;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     */
    private $outerDiam;


    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     */
    private $innerDiam;


    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     */
    private $length;

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
    public function getPiecesCount()// : ?int
    {
        return $this->piecesCount;
    }

    /**
     * @param int $piecesCount
     * @return $this
     */
    public function setPiecesCount(int $piecesCount = null)
    {
        $this->piecesCount = $piecesCount;
        return $this;
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
    public function getDescription()// : ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description = null)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return float
     */
    public function getOuterDiam()// : ?float
    {
        return $this->outerDiam;
    }

    /**
     * @param float $outerDiam
     * @return $this
     */
    public function setOuterDiam(float $outerDiam = null)
    {
        $this->outerDiam = $outerDiam;
        return $this;
    }

    /**
     * @return float
     */
    public function getInnerDiam()// : ?float
    {
        return $this->innerDiam;
    }

    /**
     * @param float $innerDiam
     * @return $this
     */
    public function setInnerDiam(float $innerDiam = null)
    {
        $this->innerDiam = $innerDiam;
        return $this;
    }

    /**
     * @return float
     */
    public function getLength()// : ?float
    {
        return $this->length;
    }

    /**
     * @param float $length
     * @return $this
     */
    public function setLength(float $length = null)
    {
        $this->length = $length;
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
