<?php

namespace App\Entity\RV;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RV\ManufacturedCasingRepository")
 * @ORM\Table("rv_manufactured_casing")
 * @Serializer\ExclusionPolicy("all")
 */
class ManufacturedCasing
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
     * @var int
     *
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     * @Serializer\SerializedName("innerDiameter")
     * @Assert\NotBlank()
     */
    private $innerDiameter;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     * @Serializer\SerializedName("outerDiameter")
     * @Assert\NotBlank()
     */
    private $outerDiameter;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     * @Serializer\SerializedName("driftDiameter")
     * @Assert\NotBlank()
     */
    private $driftDiameter;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     * @Assert\NotBlank()
     */
    private $weight;

    /**
     * @var Grade
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\Grade")
     * @Serializer\Expose()
     * @Assert\NotBlank()
     */
    private $grade;

    /**
     * @var Thread
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\Thread")
     * @Serializer\Expose()
     * @Assert\NotBlank()
     */
    private $thread;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     * @Assert\NotBlank()
     */
    private $connection;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     * @Serializer\SerializedName("collapseStrength")
     * @Assert\NotBlank()
     */
    private $collapseStrength;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     * @Serializer\SerializedName("burstStrength")
     * @Assert\NotBlank()
     */
    private $burstStrength;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     * @Serializer\SerializedName("jointStrength")
     * @Assert\NotBlank()
     */
    private $jointStrength;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     * @Serializer\SerializedName("setDepth")
     * @Assert\NotBlank()
     */
    private $setDepth;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     * @Serializer\SerializedName("minimumMakeUpTorque")
     * @Assert\NotBlank()
     */
    private $minimumMakeUpTorque;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     * @Serializer\SerializedName("optimumMakeUpTorque")
     * @Assert\NotBlank()
     */
    private $optimumMakeUpTorque;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     * @Serializer\SerializedName("maximumMakeUpTorque")
     * @Assert\NotBlank()
     */
    private $maximumMakeUpTorque;

    /**
     * @var string
     *
     * @ORM\Column(type="boolean")
     */
    private $deleted = false;

    public function __toString()
    {
        return sprintf(
            'ID: %s, IN: %s, Connection: %s, DD: %s',
            $this->id,
            $this->innerDiameter,
            $this->connection,
            $this->driftDiameter
        );
    }

    public function getId()
    {
        return $this->id;
    }

    public function getInnerDiameter()
    {
        return $this->innerDiameter;
    }

    public function setInnerDiameter($innerDiameter)
    {
        $this->innerDiameter = $innerDiameter;
    }

    public function getOuterDiameter()
    {
        return $this->outerDiameter;
    }

    public function setOuterDiameter($outerDiameter)
    {
        $this->outerDiameter = $outerDiameter;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function isDeleted()
    {
        return $this->deleted;
    }

    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * @return int
     */
    public function getDriftDiameter()
    {
        return $this->driftDiameter;
    }

    /**
     * @param int $driftDiameter
     */
    public function setDriftDiameter(int $driftDiameter = null)
    {
        $this->driftDiameter = $driftDiameter;
    }

    /**
     * @return Grade
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * @param Grade $grade
     */
    public function setGrade(Grade $grade = null)
    {
        $this->grade = $grade;
    }

    /**
     * @return Thread
     */
    public function getThread()
    {
        return $this->thread;
    }

    /**
     * @param Thread $thread
     */
    public function setThread(Thread $thread)
    {
        $this->thread = $thread;
    }

    /**
     * @return string
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param string $connection
     */
    public function setConnection(string $connection = null)
    {
        $this->connection = $connection;
    }

    /**
     * @return float
     */
    public function getCollapseStrength()
    {
        return $this->collapseStrength;
    }

    /**
     * @param float $collapseStrength
     */
    public function setCollapseStrength(float $collapseStrength = null)
    {
        $this->collapseStrength = $collapseStrength;
    }

    /**
     * @return float
     */
    public function getBurstStrength()
    {
        return $this->burstStrength;
    }

    /**
     * @param float $burstStrength
     */
    public function setBurstStrength(float $burstStrength = null)
    {
        $this->burstStrength = $burstStrength;
    }

    /**
     * @return float
     */
    public function getJointStrength()
    {
        return $this->jointStrength;
    }

    /**
     * @param float $jointStrength
     */
    public function setJointStrength(float $jointStrength = null)
    {
        $this->jointStrength = $jointStrength;
    }

    /**
     * @return float
     */
    public function getSetDepth()
    {
        return $this->setDepth;
    }

    /**
     * @param float $setDepth
     */
    public function setSetDepth(float $setDepth = null)
    {
        $this->setDepth = $setDepth;
    }

    /**
     * @return float
     */
    public function getMinimumMakeUpTorque()
    {
        return $this->minimumMakeUpTorque;
    }

    /**
     * @param float $minimumMakeUpTorque
     */
    public function setMinimumMakeUpTorque(float $minimumMakeUpTorque = null)
    {
        $this->minimumMakeUpTorque = $minimumMakeUpTorque;
    }

    /**
     * @return float
     */
    public function getOptimumMakeUpTorque()
    {
        return $this->optimumMakeUpTorque;
    }

    /**
     * @param float $optimumMakeUpTorque
     */
    public function setOptimumMakeUpTorque(float $optimumMakeUpTorque = null)
    {
        $this->optimumMakeUpTorque = $optimumMakeUpTorque;
    }

    /**
     * @return float
     */
    public function getMaximumMakeUpTorque()
    {
        return $this->maximumMakeUpTorque;
    }

    /**
     * @param float $maximumMakeUpTorque
     */
    public function setMaximumMakeUpTorque(float $maximumMakeUpTorque = null)
    {
        $this->maximumMakeUpTorque = $maximumMakeUpTorque;
    }
}
