<?php

namespace App\Entity\Shared;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\RV\Licence;
use App\Entity\RV\ProjectType;
use App\Entity\User;
use App\Entity\RV\ProjectAccess;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ApiResource()
 * @ORM\Table(name="eim_companies")
 * @ORM\Entity(repositoryClass="App\Repository\Shared\CompanyRepository")
 *
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Company
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     * @Serializer\Expose()
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $logo;

    /**
     * @var ProjectAccess[]|Collection
     * @ORM\OneToMany(targetEntity="App\Entity\RV\ProjectAccess", mappedBy="company")
     */
    private $projectAccess;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $type;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @var string
     *
     * @Serializer\Expose()
     *
     */
    protected $name;

    /**
     * @var LicencedCompany
     *
     * In case of operator this relation contains licenced company assignment
     * @ORM\OneToOne(targetEntity="App\Entity\Shared\LicencedCompany", mappedBy="company")
     *
     */
    protected $licencedCompany;

    /**
     * @ORM\Column(name="stripe_Id", type="string", length=255, nullable=true)
     *
     * @var string
     */
    protected $stripeId;

    /**
     * @ORM\Column(name="ba_Code", type="string", length=255)
     *
     * @var string
     */
    protected $baCode;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="company", cascade={"all"})
     * @ORM\OrderBy({"enabled": "desc", "lastName": "asc", "firstName": "asc"})
     *
     * @var Collection|User[]
     */
    protected $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="companyJoinRequest", cascade={"all"})
     * @ORM\OrderBy({"enabled": "desc", "lastName": "asc", "firstName": "asc"})
     *
     * @var Collection|User[]
     */
    protected $joinRequests;

    /**
     * @ORM\OneToMany(targetEntity="AccumapDevelopment", mappedBy="consultant", cascade={"all"})
     *
     * @var Collection|AccumapDevelopment[]
     */
    protected $accumapDevelopments;


    /**
     * "this company can be managed by companies in $handshakes"
     * @ORM\OneToMany(targetEntity="App\Entity\Shared\CompanyHandshake", cascade={"all"}, fetch="EXTRA_LAZY", mappedBy="operatorCompany", orphanRemoval=true)
     * @ORM\JoinTable("company_handshakes")
     *
     * @var Collection|CompanyHandshake[]
     */
    protected $handshakes;

    /**
     * "this company can manage companies in $handshakesReceived"
     * @ORM\OneToMany(targetEntity="App\Entity\Shared\CompanyHandshake", fetch="EXTRA_LAZY", mappedBy="consultantCompany")
     *
     * @var Collection|CompanyHandshake[]
     */
    protected $handshakesReceived;

    /**
     * @ORM\OneToMany(targetEntity="AfeAccount", mappedBy="company")
     *
     * @var Collection|AfeAccount[]
     */
    protected $afeAccounts;

    /**
     * @var CompanyService[]|Collection|array
     *
     * @ORM\ManyToMany(targetEntity="CompanyService", inversedBy="companies")
     *
     *
     * @var Collection|CompanyService[]
     */
    protected $services;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RV\Licence", mappedBy="operator")
     *
     * @var Collection|Licence[]
     */
    protected $licences;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $deleted = false;

    /**
     * Company constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->accumapDevelopments = new ArrayCollection();
        $this->handshakes = new ArrayCollection();
        $this->handshakesReceived = new ArrayCollection();
        $this->afeAccounts = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->licences = new ArrayCollection();
        $this->joinRequests = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return AfeAccount[]
     */
    public function getAfeAccountsByProject()
    {
        $result = [];

        foreach ($this->getAfeAccounts() as $afeAccount) {
            $result[$afeAccount->getProject()][] = $afeAccount;
        }

        return $result;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set logo.
     *
     * @param string|UploadedFile $logo
     *
     * @return Company
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo.
     *
     * @return string|UploadedFile
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set type.
     *
     * @param string $type
     *
     * @return Company
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Company
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set stripeId.
     *
     * @param string $stripeId
     *
     * @return Company
     */
    public function setStripeId($stripeId)
    {
        $this->stripeId = $stripeId;

        return $this;
    }

    /**
     * Get stripeId.
     *
     * @return string
     */
    public function getStripeId()
    {
        return $this->stripeId;
    }

    /**
     * Set baCode.
     *
     * @param string $baCode
     *
     * @return Company
     */
    public function setBaCode($baCode)
    {
        $this->baCode = $baCode;

        return $this;
    }

    /**
     * Get baCode.
     *
     * @return string
     */
    public function getBaCode()
    {
        return $this->baCode;
    }

    /**

    /**
     * Add user.
     *
     * @param User $user
     *
     * @return Company
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user.
     *
     * @param User $user
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users.
     *
     * @return Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add accumapDevelopment.
     *
     * @param AccumapDevelopment $accumapDevelopment
     *
     * @return Company
     */
    public function addAccumapDevelopment(AccumapDevelopment $accumapDevelopment)
    {
        $this->accumapDevelopments[] = $accumapDevelopment;

        return $this;
    }

    /**
     * Remove accumapDevelopment.
     *
     * @param AccumapDevelopment $accumapDevelopment
     */
    public function removeAccumapDevelopment(AccumapDevelopment $accumapDevelopment)
    {
        $this->accumapDevelopments->removeElement($accumapDevelopment);
    }

    /**
     * Get accumapDevelopments.
     *
     * @return Collection
     */
    public function getAccumapDevelopments()
    {
        return $this->accumapDevelopments;
    }

    /**
     * Add handshake.
     *
     * @param CompanyHandshake $handshake
     *
     * @return Company
     */
    public function addHandshake(CompanyHandshake $handshake)
    {
        $this->handshakes[] = $handshake;

        return $this;
    }

    /**
     * Remove handshake.
     *
     * @param CompanyHandshake $handshake
     */
    public function removeHandshake(CompanyHandshake $handshake)
    {
        $this->handshakes->removeElement($handshake);
    }

    /**
     * Get handshakes.
     *
     * @param bool $accepted
     * @return ArrayCollection|CompanyHandshake[]
     */
    public function getHandshakes(bool $accepted = null)
    {
        if ($accepted !== null) {
            $criteria = Criteria::create()->where(Criteria::expr()->eq('accepted', $accepted));
            return $this->handshakes->matching($criteria);
        }
        return $this->handshakes;
    }

    /**
     * @param Company $company
     * @return CompanyHandshake
     */
    public function getHandshakeByOperator(Company $company)
    {
        $criteria = Criteria::create()->where(Criteria::expr()->eq('operatorCompany', $company));
        return $this->getHandshakesReceived(false)->matching($criteria)->first();
    }

    /**
     * Add handshakesReceived.
     *
     * @param CompanyHandshake $handshakesReceived
     *
     * @return Company
     */
    public function addHandshakesReceived(CompanyHandshake $handshakesReceived)
    {
        $this->handshakesReceived[] = $handshakesReceived;

        return $this;
    }

    /**
     * Remove handshakesReceived.
     *
     * @param CompanyHandshake $handshakesReceived
     */
    public function removeHandshakesReceived(CompanyHandshake $handshakesReceived)
    {
        $this->handshakesReceived->removeElement($handshakesReceived);
    }

    /**
     * Get handshakesReceived.
     *
     * @param bool $accepted
     * @return ArrayCollection|CompanyHandshake[]
     */
    public function getHandshakesReceived(bool $accepted = null)
    {
        if ($accepted !== null) {
            $criteria = Criteria::create()->where(Criteria::expr()->eq('accepted', $accepted));
            return $this->handshakesReceived->matching($criteria);
        }
        return $this->handshakesReceived;
    }

    /**
     * Add afeAccount.
     *
     * @param AfeAccount $afeAccount
     *
     * @return Company
     */
    public function addAfeAccount(AfeAccount $afeAccount)
    {
        $this->afeAccounts[] = $afeAccount;

        return $this;
    }

    /**
     * Remove afeAccount.
     *
     * @param AfeAccount $afeAccount
     */
    public function removeAfeAccount(AfeAccount $afeAccount)
    {
        $this->afeAccounts->removeElement($afeAccount);
    }

    /**
     * Get afeAccounts.
     *
     * @param ProjectType|null $projectType
     *
     * @return Collection|AfeAccount[]
     */
    public function getAfeAccounts(ProjectType $projectType = null)
    {
        if (false == is_null($projectType)) {
            $criteria = Criteria::create()->where(Criteria::expr()->eq('projectType', $projectType));

            return $this->afeAccounts->matching($criteria);
        }

        return $this->afeAccounts;
    }

    /**
     * Add service.
     *
     * @param CompanyService $service
     *
     * @return Company
     */
    public function addService(CompanyService $service)
    {
        $this->services[] = $service;

        return $this;
    }

    /**
     * Remove service.
     *
     * @param CompanyService $service
     */
    public function removeService(CompanyService $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Get services.
     *
     * @return Collection|CompanyService[]
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Add licence.
     *
     * @param Licence $licence
     *
     * @return Company
     */
    public function addLicence(Licence $licence)
    {
        $this->licences[] = $licence;

        return $this;
    }

    /**
     * Remove licence.
     *
     * @param Licence $licence
     */
    public function removeLicence(Licence $licence)
    {
        $this->licences->removeElement($licence);
    }

    /**
     * Get licences.
     *
     * @return Collection|Licence[]
     */
    public function getLicences()
    {
        return $this->licences;
    }

    /**
     * @return Collection|User[]
     */
    public function getJoinRequests()
    {
        return $this->joinRequests;
    }

    /**
     * @param Collection|User[] $joinRequests
     * @return $this
     */
    public function setJoinRequests($joinRequests = null)
    {
        $this->joinRequests = $joinRequests;
        return $this;
    }

    /**
     * @return LicencedCompany
     */
    public function getLicencedCompany()
    {
        return $this->licencedCompany;
    }

    /**
     * @param LicencedCompany $licencedCompany
     * @return $this
     */
    public function setLicencedCompany(LicencedCompany $licencedCompany = null)
    {
        $licencedCompany->setCompany($this);
        $this->licencedCompany = $licencedCompany;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     */
    public function setDeleted(bool $deleted = null)
    {
        $this->deleted = $deleted;
    }
}
