<?php


namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RV\DeviationSurveyRepository")
 * @ORM\Table("rv_deviation_survey")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class DeviationSurvey
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
     * @var DailyDrillingReport
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\DailyDrillingReport", inversedBy="deviationSurveys", cascade={"persist"})
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
    private $deviation;


    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $direction;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $surveyType;

    /**
     * @return int
     */
    public function getId()// : ?int
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getTime()// : ?\DateTime
    {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     * @return $this
     */
    public function setTime(\DateTime $time = null)
    {
        $this->time = $time;
        return $this;
    }

    /**
     * @return float
     */
    public function getDepth()// : ?float
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
     * @return float
     */
    public function getDeviation()// : ?float
    {
        return $this->deviation;
    }

    /**
     * @param float $deviation
     * @return $this
     */
    public function setDeviation(float $deviation = null)
    {
        $this->deviation = $deviation;
        return $this;
    }

    /**
     * @return float
     */
    public function getDirection()// : ?float
    {
        return $this->direction;
    }

    /**
     * @param float $direction
     * @return $this
     */
    public function setDirection(float $direction = null)
    {
        $this->direction = $direction;
        return $this;
    }

    /**
     * @return string
     */
    public function getSurveyType()// : ?string
    {
        return $this->surveyType;
    }

    /**
     * @param string $surveyType
     * @return $this
     */
    public function setSurveyType(string $surveyType = null)
    {
        $this->surveyType = $surveyType;
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
