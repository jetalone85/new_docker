<?php


namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Entity()
 * @ORM\Table("rv_mud_materials")
 * @Serializer\ExclusionPolicy("all")
 */
class MudMaterial
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
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\DailyDrillingReport", inversedBy="mudMaterials", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $dailyReport;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $tourNo;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     *
     * @Serializer\Expose()
     */
    private $product;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     *
     * @Serializer\Expose()
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     *
     * @Serializer\Expose()
     */
    private $unit;



    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=15, scale=2)
     *
     * @Serializer\Expose()
     */
    private $unitQuantity;

    /**
     * @return int
     */
    public function getId()// : ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getTourNo()// : ?int
    {
        return $this->tourNo;
    }

    /**
     * @param int $piecesCount
     * @return $this
     */
    public function setTourNo(int $tourNo = null)
    {
        $this->tourNo = $tourNo;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getProduct()// : ?string
    {
        return $this->product;
    }

    /**
     * @param string $product
     * @return $this
     */
    public function setProduct(string $product = null)
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount()// : ?int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return $this
     */
    public function setAmount(int $amount = null)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnit()// : ?string
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     * @return $this
     */
    public function setUnit(string $unit = null)
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return float
     */
    public function getUnitQuantity()// : ?float
    {
        return $this->unitQuantity;
    }

    /**
     * @param float $unitQuantity
     * @return $this
     */
    public function setUnitQuantity(float $unitQuantity = null)
    {
        $this->unitQuantity = $unitQuantity;
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
