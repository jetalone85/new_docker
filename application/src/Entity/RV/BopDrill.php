<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Table(name="rv_bop_drill")
 * @ORM\Entity(repositoryClass="App\Repository\RV\BopDrillRepository")
 *
 * @package App\Entity\RV
 */
class BopDrill
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Licence", inversedBy="bopDrills")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Exclude()
     *
     * @var Licence
     */
    protected $licence;


    /**
     * BopDrill constructor.
     *
     * @codeCoverageIgnore
     *
     * @param Licence $licence
     */
    public function __construct(Licence $licence)
    {
        $this->setLicence($licence);
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
     * @return BopDrill
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
     * Set licence
     *
     * @param Licence $licence
     * @return BopDrill
     */
    public function setLicence(Licence $licence)
    {
        $this->licence = $licence;

        return $this;
    }

    /**
     * Get licence
     *
     * @return Licence
     */
    public function getLicence()
    {
        return $this->licence;
    }
}
