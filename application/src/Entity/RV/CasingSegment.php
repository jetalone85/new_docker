<?php

namespace App\Entity\RV;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * CasingSegment
 *
 * @ORM\Table(name="rv_casing_segment")
 * @ORM\Entity(repositoryClass="App\Repository\RV\CasingSegmentRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class CasingSegment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="total_length", type="decimal", precision=10, scale=0, nullable=true)
     * @Serializer\Expose()
     */
    private $totalLength;

    /**
     * @var string
     *
     * @ORM\Column(name="total_left_in", type="decimal", precision=10, scale=0, nullable=true)
     * @Serializer\Expose()
     */
    private $totalLeftIn;

    /**
     * @var string
     *
     * @ORM\Column(name="total_left_out", type="decimal", precision=10, scale=0, nullable=true)
     * @Serializer\Expose()
     */
    private $totalLeftOut;

    // RELATIONS

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="casingSegments")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     *
     * @var Project
     */
    protected $project;

    /**
     * @ORM\OneToMany(targetEntity="CasingPiece", mappedBy="casingSegment", cascade={"all"})
     */
    private $casingPieces;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->casingPieces = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set type
     *
     * @param string $type
     *
     * @return CasingSegment
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set totalLength
     *
     * @param string $totalLength
     *
     * @return CasingSegment
     */
    public function setTotalLength($totalLength)
    {
        $this->totalLength = $totalLength;

        return $this;
    }

    /**
     * Get totalLength
     *
     * @return string
     */
    public function getTotalLength()
    {
        return $this->totalLength;
    }

    /**
     * Set totalLeftIn
     *
     * @param string $totalLeftIn
     *
     * @return CasingSegment
     */
    public function setTotalLeftIn($totalLeftIn)
    {
        $this->totalLeftIn = $totalLeftIn;

        return $this;
    }

    /**
     * Get totalLeftIn
     *
     * @return string
     */
    public function getTotalLeftIn()
    {
        return $this->totalLeftIn;
    }

    /**
     * Set totalLeftOut
     *
     * @param string $totalLeftOut
     *
     * @return CasingSegment
     */
    public function setTotalLeftOut($totalLeftOut)
    {
        $this->totalLeftOut = $totalLeftOut;

        return $this;
    }

    /**
     * Get totalLeftOut
     *
     * @return string
     */
    public function getTotalLeftOut()
    {
        return $this->totalLeftOut;
    }

    /**
     * Set project
     *
     * @param Project $project
     *
     * @return CasingSegment
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

    /**
     * Add casingPiece
     *
     * @param \App\Entity\RV\CasingPiece $casingPiece
     *
     * @return CasingSegment
     */
    public function addCasingPiece(\App\Entity\RV\CasingPiece $casingPiece)
    {
        $this->casingPieces[] = $casingPiece;

        return $this;
    }

    /**
     * Remove casingPiece
     *
     * @param \App\Entity\RV\CasingPiece $casingPiece
     */
    public function removeCasingPiece(\App\Entity\RV\CasingPiece $casingPiece)
    {
        $this->casingPieces->removeElement($casingPiece);
    }

    /**
     * Get casingPieces
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCasingPieces()
    {
        return $this->casingPieces;
    }
}
