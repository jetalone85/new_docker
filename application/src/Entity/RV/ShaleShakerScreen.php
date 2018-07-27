<?php


namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Entity()
 * @ORM\Table("rv_shale_shaker_screen")
 * @Serializer\ExclusionPolicy("all")
 */
class ShaleShakerScreen
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var DailyDrillingReport
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\DailyDrillingReport", inversedBy="shaleShakerScreens", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $dailyReport;


    /**
     * @var ShaleShaker
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\ShaleShaker")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Serializer\Expose()
     */
    private $shaker;

    /**
     * @var int
     *
     * @ORM\Column( type="integer")
     *
     * @Serializer\Expose()
     */
    private $position;

    /**
     * @var int
     *
     * @ORM\Column( type="integer", nullable=true)
     *
     * @Serializer\Expose()
     */
    private $size;

    /**
     * @var boolean
     *
     * @ORM\Column( type="boolean")
     *
     * @Serializer\Expose()
     */
    private $screenChanged;

    /**
     * @var boolean
     *
     * @ORM\Column( type="boolean")
     *
     * @Serializer\Expose()
     */
    private $new;

    /**
     * @return int
     */
    public function getId()// : ?int
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
     * @return ShaleShaker
     */
    public function getShaker()// : ?ShaleShaker
    {
        return $this->shaker;
    }

    /**
     * @param ShaleShaker $shaker
     * @return $this
     */
    public function setShaker(ShaleShaker $shaker = null)
    {
        $this->shaker = $shaker;
        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()// : ?int
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return $this
     */
    public function setPosition(int $position = null)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize()// : ?int
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return $this
     */
    public function setSize(int $size = null)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return bool
     */
    public function isScreenChanged()// : ?bool
    {
        return $this->screenChanged;
    }

    /**
     * @param bool $screenChanged
     * @return $this
     */
    public function setScreenChanged(bool $screenChanged = null)
    {
        $this->screenChanged = $screenChanged;
        return $this;
    }

    /**
     * @return bool
     */
    public function isNew()// : ?bool
    {
        return $this->new;
    }

    /**
     * @param bool $new
     * @return $this
     */
    public function setNew(bool $new = null)
    {
        $this->new = $new;
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
