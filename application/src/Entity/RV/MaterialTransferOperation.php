<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Shared\AfeAccount;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @package App\Entity\RV
 * @ORM\Table(name="rv_material_transfer_operation")
 * @ORM\Entity(repositoryClass="App\Repository\RV\MaterialTransferOperationRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class MaterialTransferOperation
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="quantity", type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $quantity = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="unit", type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     */
    private $unit = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     * @Serializer\Expose()
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="cost_subcode", type="integer")
     * @Serializer\Expose()
     */
    /**
     * @var AfeAccount
     * @ORM\ManyToOne(targetEntity="App\Entity\Shared\AfeAccount", inversedBy="materialTransferOperations", cascade={"persist"})
     */
    private $afeAccount;

    /**
     * @var string
     *
     * @ORM\Column(name="condition_code", type="string", length=256, nullable=true)
     * @Serializer\Expose()
     */
    private $conditionCode;

    /**
     * @var string
     *
     * @ORM\Column(name="transport_ticket", type="string", length=255)
     * @Serializer\Expose()
     */
    private $transportTicket;

    /**
     * @var string
     *
     * @ORM\Column(name="transport_company", type="string", length=255)
     * @Serializer\Expose()
     */
    private $transportCompany;

    /**
     * @var MaterialTransfer
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\MaterialTransfer", inversedBy="operations", cascade={"persist"})
     * @ORM\JoinColumn(name="material_transfer_id", referencedColumnName="id")
     * @Serializer\Expose()
     */
    private $materialTransfer;

    /**
     * @return float
     * @Serializer\Expose()
     * @Serializer\VirtualProperty()
     */
    public function getTotalValue()
    {
        return $this->unit * $this->quantity;
    }

    /**
     * MaterialTransferOperation constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     */
    public function setQuantity(float $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return AfeAccount
     */
    public function getAfeAccount()
    {
        return $this->afeAccount;
    }

    /**
     * @param AfeAccount $afeAccount
     */
    public function setAfeAccount(AfeAccount $afeAccount)
    {
        $this->afeAccount = $afeAccount;
    }

    /**
     * @return string
     */
    public function getConditionCode()
    {
        return $this->conditionCode;
    }

    /**
     * @param string $conditionCode
     */
    public function setConditionCode(string $conditionCode)
    {
        $this->conditionCode = $conditionCode;
    }

    /**
     * @return float
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param float $unit
     */
    public function setUnit(float $unit)
    {
        $this->unit = $unit;
    }

    /**
     * @return string
     */
    public function getTransportTicket()
    {
        return $this->transportTicket;
    }

    /**
     * @param string $transportByTicket
     */
    public function setTransportTicket(string $transportTicket)
    {
        $this->transportTicket = $transportTicket;
    }

    /**
     * @return string
     */
    public function getTransportCompany()
    {
        return $this->transportCompany;
    }

    /**
     * @param string $transportCompany
     */
    public function setTransportCompany(string $transportCompany)
    {
        $this->transportCompany = $transportCompany;
    }

    /**
     * @return MaterialTransfer
     */
    public function getMaterialTransfer(): MaterialTransfer
    {
        return $this->materialTransfer;
    }

    /**
     * @param MaterialTransfer $MaterialTransfer
     */
    public function setMaterialTransfer(MaterialTransfer $MaterialTransfer)
    {
        $this->materialTransfer = $MaterialTransfer;
    }
}
