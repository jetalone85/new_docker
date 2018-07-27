<?php


namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RV\FormationRepository")
 * @ORM\Table("rv_formation")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Formation
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
     * @var string
     *
     * @ORM\Column(name="FORMATION", type="string", length=255)
     * @Serializer\Expose()
     */
    private $formation;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $prognosis_in_m = 0;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $sampleTopMD = 0;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $sampleTopTVD = 0;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $logTopMD = 0;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $logTopTVD = 0;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $subsea = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Serializer\Expose()
     * @Serializer\Type("Date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="COMMENTS", type="string", length=255)
     * @Serializer\Expose()
     * @Assert\NotBlank()
     */
    private $comments;

    /**
     * @var DailyDrillingReport
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\Prognosis", inversedBy="formations", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $prognosis;

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
     * @return string
     */
    public function getFormation()
    {
        return $this->formation;
    }

    /**
     * @param string $formation
     */
    public function setFormation(string $formation)
    {
        $this->formation = $formation;
    }

    /**
     * @return float
     */
    public function getPrognosisInM()
    {
        return $this->prognosis_in_m;
    }

    /**
     * @param float $prognosis_in_m
     */
    public function setPrognosisInM(float $prognosis_in_m)
    {
        $this->prognosis_in_m = $prognosis_in_m;
    }

    /**
     * @return float
     */
    public function getSampleTopMD()
    {
        return $this->sampleTopMD;
    }

    /**
     * @param float $sampleTopMD
     */
    public function setSampleTopMD(float $sampleTopMD)
    {
        $this->sampleTopMD = $sampleTopMD;
    }

    /**
     * @return float
     */
    public function getSampleTopTVD()
    {
        return $this->sampleTopTVD;
    }

    /**
     * @param float $sampleTopTVD
     */
    public function setSampleTopTVD(float $sampleTopTVD)
    {
        $this->sampleTopTVD = $sampleTopTVD;
    }

    /**
     * @return float
     */
    public function getLogTopMD()
    {
        return $this->logTopMD;
    }

    /**
     * @param float $logTopMD
     */
    public function setLogTopMD(float $logTopMD)
    {
        $this->logTopMD = $logTopMD;
    }

    /**
     * @return float
     */
    public function getLogTopTVD()
    {
        return $this->logTopTVD;
    }

    /**
     * @param float $logTopTVD
     */
    public function setLogTopTVD(float $logTopTVD)
    {
        $this->logTopTVD = $logTopTVD;
    }

    /**
     * @return float
     */
    public function getSubsea()
    {
        return $this->subsea;
    }

    /**
     * @param float $subsea
     */
    public function setSubsea(float $subsea)
    {
        $this->subsea = $subsea;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
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

    /**
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param string $comments
     */
    public function setComments(string $comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return DailyDrillingReport
     */
    public function getPrognosis()
    {
        return $this->prognosis;
    }

    /**
     * @param Prognosis $prognosis
     */
    public function setPrognosis(Prognosis $prognosis)
    {
        $this->prognosis = $prognosis;
    }
}
