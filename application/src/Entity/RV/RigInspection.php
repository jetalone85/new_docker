<?php

namespace App\Entity\RV;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * RigInspection
 *
 * @ORM\Table(name="rv_rig_inspection")
 * @ORM\Entity(repositoryClass="App\Repository\RV\RigInspectionRepository")
 * @Serializer\ExclusionPolicy("all")
 *
 * @package App\Entity\RV
 */
class RigInspection
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", unique=true)
     * @Serializer\Expose()
     */
    private $date;


    /**
     * @ORM\ManyToOne(targetEntity="DrillingRig", inversedBy="rigInspections",  cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     *
     * @var DrillingRig
     */
    protected $drillingRig;
    
    /**
     * RigInspection constructor.
     *
     * @codeCoverageIgnore
     *
     * @param DrillingRig $drillingRig
     */
    public function __construct(DrillingRig $drillingRig)
    {
        $this->setDrillingRig($drillingRig);
    }
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return RigInspection
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set drillingRig
     *
     * @param \App\Entity\RV\DrillingRig $drillingRig
     *
     * @return RigInspection
     */
    public function setDrillingRig(\App\Entity\RV\DrillingRig $drillingRig)
    {
        $this->drillingRig = $drillingRig;

        return $this;
    }

    /**
     * Get drillingRig
     *
     * @return \App\Entity\RV\DrillingRig
     */
    public function getDrillingRig()
    {
        return $this->drillingRig;
    }
}
