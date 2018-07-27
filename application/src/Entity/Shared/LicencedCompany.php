<?php

namespace App\Entity\Shared;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Table(name="shared_licenced_companies")
 * @ORM\Entity(repositoryClass="App\Repository\Shared\LicencedCompanyRepository")
 */
class LicencedCompany
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
     * @var Company
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Shared\Company", inversedBy="licencedCompany")
     */
    protected $company;

    /**
     * @var string
     *
     * @ORM\Column(name="baCode", type="string", length=8, unique=true)
     */
    private $baCode;

    /**
     * @var string
     *
     * @ORM\Column(name="licence", type="string", length=255)
     */
    private $licence;

    /**
     * @var string
     *
     * @ORM\Column(name="abbreviation", type="string", length=64)
     */
    private $abbreviation;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=64, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="agentName", type="string", length=128, nullable=true)
     */
    private $agentName;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=32, nullable=true)
     */
    private $code;


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
     * Set baCode
     *
     * @param string $baCode
     *
     * @return LicencedCompany
     */
    public function setBaCode($baCode)
    {
        $this->baCode = $baCode;

        return $this;
    }

    /**
     * Get baCode
     *
     * @return string
     */
    public function getBaCode()
    {
        return $this->baCode;
    }

    /**
     * Set licence
     *
     * @param string $licence
     *
     * @return LicencedCompany
     */
    public function setLicence($licence)
    {
        $this->licence = $licence;

        return $this;
    }

    /**
     * Get licence
     *
     * @return string
     */
    public function getLicence()
    {
        return $this->licence;
    }

    /**
     * Set abbreviation
     *
     * @param string $abbreviation
     *
     * @return LicencedCompany
     */
    public function setAbbreviation($abbreviation)
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    /**
     * Get abbreviation
     *
     * @return string
     */
    public function getAbbreviation()
    {
        return $this->abbreviation;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return LicencedCompany
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return LicencedCompany
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set agentName
     *
     * @param string $agentName
     *
     * @return LicencedCompany
     */
    public function setAgentName($agentName)
    {
        $this->agentName = $agentName;

        return $this;
    }

    /**
     * Get agentName
     *
     * @return string
     */
    public function getAgentName()
    {
        return $this->agentName;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return LicencedCompany
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
    /**
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param Company $company
     * @return $this
     */
    public function setCompany(Company $company = null)
    {
        $this->company = $company;
        return $this;
    }



    public function __toString()
    {
        return $this->getLicence().' ('.$this->getBaCode().')';
    }
}
