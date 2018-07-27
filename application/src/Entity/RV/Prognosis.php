<?php


namespace App\Entity\RV;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Marcin Pyrka <marcin.pyrka@polcode.net>
 *
 * @ORM\Entity(repositoryClass="App\Repository\RV\PrognosisRepository")
 * @ORM\Table("rv_prognosis")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Prognosis
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
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Serializer\Expose()
     * @Serializer\Type("Date")
     */
    private $date;

//    /**
//     * @var float
//     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
//     * @Serializer\Expose()
//     * @Serializer\Type("double")
//     */
//    private $kellyBushingElevation;
//
//    /**
//     * @var float
//     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
//     * @Serializer\Expose()
//     * @Serializer\Type("double")
//     */
//    private $groundElevation;
//
//    /**
//     * @var float
//     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
//     * @Serializer\Expose()
//     * @Serializer\Type("double")
//     */
//    private $casingFlangeElevation;

    /**
     * @var Formation
     * @ORM\OneToMany(targetEntity="App\Entity\RV\Formation", mappedBy="prognosis", cascade={"all"}, fetch="EXTRA_LAZY")
     * @Serializer\Expose()
     */
    private $formations;

    /**
     * @var Licence
     * @ORM\OneToOne(targetEntity="App\Entity\RV\Licence", inversedBy="prognosis")
     * @ORM\JoinColumn(name="licence_id", referencedColumnName="id")
     */
    private $licence;

    /**
     * @var DrillingEvent
     * @ORM\OneToOne(targetEntity="App\Entity\RV\DrillingEvent", inversedBy="prognosis")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $event;

    /**
     * @var DrillingEvent
     * @ORM\OneToOne(targetEntity="App\Entity\RV\Project", inversedBy="prognosis")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()// : ??int
    {
        return $this->id;
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
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

//    /**
//     * @return float
//     */
//    public function getKellyBushingElevation()
//    {
//        return $this->kellyBushingElevation;
//    }
//
//    /**
//     * @param float $kellyBushingElevation
//     */
//    public function setKellyBushingElevation($kellyBushingElevation)
//    {
//        $this->kellyBushingElevation = $kellyBushingElevation;
//    }
//
//    /**
//     * @return float
//     */
//    public function getGroundElevation()
//    {
//        return $this->groundElevation;
//    }
//
//    /**
//     * @param float $groundElevation
//     */
//    public function setGroundElevation($groundElevation)
//    {
//        $this->groundElevation = $groundElevation;
//    }
//
//    /**
//     * @return float
//     */
//    public function getCasingFlangeElevation()
//    {
//        return $this->casingFlangeElevation;
//    }
//
//    /**
//     * @param float $casingFlangeElevation
//     */
//    public function setCasingFlangeElevation($casingFlangeElevation)
//    {
//        $this->casingFlangeElevation = $casingFlangeElevation;
//    }

    /**
     * @return mixed
     */
    public function getFormations()
    {
        return $this->formations;
    }

    /**
     * @param mixed $formations
     */
    public function setFormations($formations)
    {
        $this->formations = $formations;
    }

    /**
     * @return Licence
     */
    public function getLicence()
    {
        return $this->licence;
    }

    /**
     * @param Licence $licence
     */
    public function setLicence(Licence $licence)
    {
        $this->licence = $licence;
    }

    /**
     * @return DrillingEvent
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param DrillingEvent $event
     */
    public function setEvent(DrillingEvent $event)
    {
        $this->event = $event;
    }
}
