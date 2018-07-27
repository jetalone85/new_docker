<?php

namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ApiResource()
 * @ORM\Table(name="rv_casing_bowl")
 * @ORM\Entity(repositoryClass="App\Repository\RV\CasingBowlRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class CasingBowl
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
     * @ORM\Column(name="model", type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="serial", type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $serial;

    /**
     * @var string
     *
     * @ORM\Column(name="manufacturer", type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $manufacturer;

    /**
     * @var string
     *
     * @ORM\Column(name="top_size", type="decimal", precision=10, scale=0)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $topSize;

    /**
     * @var string
     *
     * @ORM\Column(name="bottom_size", type="decimal", precision=10, scale=0)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $bottomSize;

    /**
     * @var string
     *
     * @ORM\Column(name="outletType", type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $outletType;

    /**
     * @var float
     *
     * @ORM\Column(name="rating", type="decimal", precision=10, scale=0)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $rating;

    /**
     * @var string
     *
     * @ORM\Column(name="reman", type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $reman;

    /**
     * @var string
     *
     * @ORM\Column(name="sour_service", type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $sourService;

    /**
     * @var string
     *
     * @ORM\Column(name="material", type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $material;

    /**
     * @var string
     *
     * @ORM\Column(name="schematic", type="string", length=255)
     * @Serializer\Expose()
     */
    private $schematic;

    /**
     * @var string
     *
     * @ORM\Column(name="bill_of_lading", type="string", length=255)
     * @Serializer\Expose()
     */
    private $billOfLading;

    // RELATIONS

    /**
     * @ORM\OneToOne(targetEntity="Licence", inversedBy="casingBowl")
     */
    private $licence;

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
     * Set model
     *
     * @param string $model
     *
     * @return CasingBowl
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set serial
     *
     * @param string $serial
     *
     * @return CasingBowl
     */
    public function setSerial($serial)
    {
        $this->serial = $serial;

        return $this;
    }

    /**
     * Get serial
     *
     * @return string
     */
    public function getSerial()
    {
        return $this->serial;
    }

    /**
     * Set manufacturer
     *
     * @param string $manufacturer
     *
     * @return CasingBowl
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return string
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Set topSize
     *
     * @param string $topSize
     *
     * @return CasingBowl
     */
    public function setTopSize($topSize)
    {
        $this->topSize = $topSize;

        return $this;
    }

    /**
     * Get topSize
     *
     * @return string
     */
    public function getTopSize()
    {
        return $this->topSize;
    }

    /**
     * Set bottomSize
     *
     * @param string $bottomSize
     *
     * @return CasingBowl
     */
    public function setBottomSize($bottomSize)
    {
        $this->bottomSize = $bottomSize;

        return $this;
    }

    /**
     * Get bottomSize
     *
     * @return string
     */
    public function getBottomSize()
    {
        return $this->bottomSize;
    }

    /**
     * Set outletType
     *
     * @param string $outletType
     *
     * @return CasingBowl
     */
    public function setOutletType($outletType)
    {
        $this->outletType = $outletType;

        return $this;
    }

    /**
     * Get outletType
     *
     * @return string
     */
    public function getOutletType()
    {
        return $this->outletType;
    }

    /**
     * Set rating
     *
     * @param string $rating
     *
     * @return CasingBowl
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set reman
     *
     * @param string $reman
     *
     * @return CasingBowl
     */
    public function setReman($reman)
    {
        $this->reman = $reman;

        return $this;
    }

    /**
     * Get reman
     *
     * @return string
     */
    public function getReman()
    {
        return $this->reman;
    }

    /**
     * Set sourService
     *
     * @param string $sourService
     *
     * @return CasingBowl
     */
    public function setSourService($sourService)
    {
        $this->sourService = $sourService;

        return $this;
    }

    /**
     * Get sourService
     *
     * @return string
     */
    public function getSourService()
    {
        return $this->sourService;
    }

    /**
     * Set material
     *
     * @param string $material
     *
     * @return CasingBowl
     */
    public function setMaterial($material)
    {
        $this->material = $material;

        return $this;
    }

    /**
     * Get material
     *
     * @return string
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Set schematic
     *
     * @param string $schematic
     *
     * @return CasingBowl
     */
    public function setSchematic($schematic)
    {
        $this->schematic = $schematic;

        return $this;
    }

    /**
     * Get schematic
     *
     * @return string
     */
    public function getSchematic()
    {
        return $this->schematic;
    }

    /**
     * Set billOfLading
     *
     * @param string $billOfLading
     *
     * @return CasingBowl
     */
    public function setBillOfLading($billOfLading)
    {
        $this->billOfLading = $billOfLading;

        return $this;
    }

    /**
     * Get billOfLading
     *
     * @return string
     */
    public function getBillOfLading()
    {
        return $this->billOfLading;
    }

    /**
     * Set licence
     *
     * @param \App\Entity\RV\Licence $licence
     *
     * @return CasingBowl
     */
    public function setLicence(\App\Entity\RV\Licence $licence = null)
    {
        $this->licence = $licence;

        return $this;
    }

    /**
     * Get licence
     *
     * @return \App\Entity\RV\Licence
     */
    public function getLicence()
    {
        return $this->licence;
    }
}
