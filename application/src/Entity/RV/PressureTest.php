<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Table(name="rv_pressure_test")
 * @ORM\Entity(repositoryClass="App\Repository\RV\PressureTestRepository")
 * @Serializer\ExclusionPolicy("all")
 *
 * @package App\Entity\RV
 * @author Michał Haracewiat <michal.haracewiat@polcode.net>
 */
class PressureTest
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose()
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="date", type="datetime")
     * @Serializer\Expose()
     *
     * @var \DateTime
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Licence", inversedBy="pressureTests")
     * @ORM\JoinColumn(nullable=false)
     *
     * @var Licence
     */
    protected $licence;


    /**
     * PressureTest constructor.
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
     * @return PressureTest
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
     * @return PressureTest
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
