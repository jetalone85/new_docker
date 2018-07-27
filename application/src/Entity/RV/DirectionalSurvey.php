<?php


namespace App\Entity\RV;

use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @author Damian Wróblewski
 * @ORM\Entity(repositoryClass="App\Repository\RV\DirectionalSurveyRepository")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class DirectionalSurvey
{

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose()
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Serializer\Expose()
     */
    protected $date;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    protected $measuredDepth;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Required()
     * @Serializer\Expose()
     */
    protected $deltaMeasuredDepth;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    protected $inclination;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    protected $azimuth;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    protected $northSouthDisplacement;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    protected $eastWestDisplacement;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    protected $vectorSummary;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    protected $totalVerticalDepth;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    protected $totalVerticalDepthSubSea;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    protected $dogLegSection;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    protected $source;

    // RELATIONS

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="directionalSurveys")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     *
     * @var Project
     */
    protected $project;


    /**
     * @return int
     */
    public function getId()//: ??int
    {
        return $this->id;
    }

    /**
     * @deprecated
     *
     * @return DrillingEvent
     */
    public function getEvent()//: ?DrillingEvent
    {
        return $this->getProject()->getDrillingEvent();
    }

    /**
     * @deprecated
     *
     * @param DrillingEvent $event
     * @return $this
     */
    public function setEvent(DrillingEvent $event = null)
    {
        $this->getProject()->setDrillingEvent($event);
        return $this;
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
     * @return \DateTime
     */
    public function getDate()//: ??\DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return $this
     */
    public function setDate(\DateTime $date = null)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return float
     */
    public function getMeasuredDepth()//: ??float
    {
        return $this->measuredDepth;
    }

    /**
     * @param float $measuredDepth
     * @return $this
     */
    public function setMeasuredDepth(float $measuredDepth = null)
    {
        $this->measuredDepth = $measuredDepth;
        return $this;
    }

    /**
     * @return float
     */
    public function getDeltaMeasuredDepth()//: ??float
    {
        return $this->deltaMeasuredDepth;
    }

    /**
     * @param float $deltaMeasuredDepth
     * @return $this
     */
    public function setDeltaMeasuredDepth(float $deltaMeasuredDepth = null)
    {
        $this->deltaMeasuredDepth = $deltaMeasuredDepth;
        return $this;
    }

    /**
     * @return float
     */
    public function getInclination()//: ??float
    {
        return $this->inclination;
    }

    /**
     * @param float $inclination
     * @return $this
     */
    public function setInclination(float $inclination = null)
    {
        $this->inclination = $inclination;
        return $this;
    }

    /**
     * @return float
     */
    public function getAzimuth()//: ??float
    {
        return $this->azimuth;
    }

    /**
     * @param float $azimuth
     * @return $this
     */
    public function setAzimuth(float $azimuth = null)
    {
        $this->azimuth = $azimuth;
        return $this;
    }

    /**
     * @return float
     */
    public function getDisplacement()//: ??float
    {
        return $this->displacement;
    }

    /**
     * @param float $displacement
     * @return $this
     */
    public function setDisplacement(float $displacement = null)
    {
        $this->displacement = $displacement;
        return $this;
    }

    /**
     * @return float
     */
    public function getNorthSouthDisplacement()//: ?float
    {
        return $this->northSouthDisplacement;
    }

    /**
     * @param float $northSouthDisplacement
     * @return $this
     */
    public function setNorthSouthDisplacement(float $northSouthDisplacement = null)
    {
        $this->northSouthDisplacement = $northSouthDisplacement;
        return $this;
    }


    /**
     * @return float
     */
    public function getEastWestDisplacement()//: ??float
    {
        return $this->eastWestDisplacement;
    }

    /**
     * @param float $eastWestDisplacement
     * @return $this
     */
    public function setEastWestDisplacement(float $eastWestDisplacement = null)
    {
        $this->eastWestDisplacement = $eastWestDisplacement;
        return $this;
    }

    /**
     * @return float
     */
    public function getCumulativeDisplacement()//: ??float
    {
        return $this->cumulativeDisplacement;
    }

    /**
     * @param float $cumulativeDisplacement
     * @return $this
     */
    public function setCumulativeDisplacement(float $cumulativeDisplacement = null)
    {
        $this->cumulativeDisplacement = $cumulativeDisplacement;
        return $this;
    }

    /**
     * @return float
     */
    public function getVectorSummary()//: ?float
    {
        return $this->vectorSummary;
    }

    /**
     * @param float $vectorSummary
     * @return $this
     */
    public function setVectorSummary(float $vectorSummary = null)
    {
        $this->vectorSummary = $vectorSummary;
        return $this;
    }


    /**
     * @return float
     */
    public function getTotalVerticalDepth()//: ??float
    {
        return $this->totalVerticalDepth;
    }

    /**
     * @param float $totalVerticalDepth
     * @return $this
     */
    public function setTotalVerticalDepth(float $totalVerticalDepth = null)
    {
        $this->totalVerticalDepth = $totalVerticalDepth;
        return $this;
    }

    /**
     * @return float
     */
    public function getDogLegSection()//: ??float
    {
        return $this->dogLegSection;
    }

    /**
     * @param float $dogLegSection
     * @return $this
     */
    public function setDogLegSection(float $dogLegSection = null)
    {
        $this->dogLegSection = $dogLegSection;
        return $this;
    }

    /**
     * @return string
     */
    public function getSource()//: ??string
    {
        return $this->source;
    }

    /**
     * @param string $source
     * @return $this
     */
    public function setSource(string $source = null)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotalVerticalDepthSubSea()//: ?float
    {
        return $this->totalVerticalDepthSubSea;
    }

    /**
     * @param float $totalVerticalDepthSubSea
     * @return $this
     */
    public function setTotalVerticalDepthSubSea(float $totalVerticalDepthSubSea = null)
    {
        $this->totalVerticalDepthSubSea = $totalVerticalDepthSubSea;
        return $this;
    }

    /**
     * Set project
     *
     * @param Project $project
     *
     * @return DirectionalSurvey
     */
    public function setProject(Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }
}
