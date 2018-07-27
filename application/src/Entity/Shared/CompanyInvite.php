<?php


namespace App\Entity\Shared;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

/**
 * @author Damian Wróblewski
 * @ORM\Entity()
 */
class CompanyInvite
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
     * hash used for creating registration link
     * @var string
     * @ORM\Column(type="string", length=180)
     */
    private $hash;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $inviteeEmail;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $inviteeFirstName;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $inviteeLastName;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $inviteeCompanyType;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $inviteeCompanyName;

    /**
     * @var LicencedCompany
     * @ORM\ManyToOne(targetEntity="App\Entity\Shared\LicencedCompany")
     */
    private $inviteeLicencedCompany;

    /**
     * @var User
     *
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="invite")
     */
    private $registeredUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $registeredAt;


    /**
     * email confirmed after registration
     *
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $confirmedAt;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $message;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getInviteeEmail()
    {
        return $this->inviteeEmail;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setInviteeEmail(string $email = null)
    {
        $this->inviteeEmail = $email;
        return $this;
    }

    /**
     * @return User
     */
    public function getRegisteredUser()
    {
        return $this->registeredUser;
    }

    /**
     * @param User $registeredUser
     * @return $this
     */
    public function setRegisteredUser(User $registeredUser = null)
    {
        $this->registeredUser = $registeredUser;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getRegisteredAt()
    {
        return $this->registeredAt;
    }

    /**
     * @param \DateTime $registeredAt
     * @return $this
     */
    public function setRegisteredAt(\DateTime $registeredAt = null)
    {
        $this->registeredAt = $registeredAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message = null)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getConfirmedAt()
    {
        return $this->confirmedAt;
    }

    /**
     * @param \DateTime $confirmedAt
     * @return $this
     */
    public function setConfirmedAt(\DateTime $confirmedAt = null)
    {
        $this->confirmedAt = $confirmedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     * @return $this
     */
    public function setHash(string $hash = null)
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * @return string
     */
    public function getInviteeCompanyName()
    {
        return $this->inviteeCompanyName;
    }

    /**
     * @param string $inviteeCompanyName
     * @return $this
     */
    public function setInviteeCompanyName(string $inviteeCompanyName = null)
    {
        $this->inviteeCompanyName = $inviteeCompanyName;
        return $this;
    }


    /**
     * @return string
     */
    public function getInviteeFirstName()
    {
        return $this->inviteeFirstName;
    }

    /**
     * @param string $inviteeFirstName
     * @return $this
     */
    public function setInviteeFirstName(string $inviteeFirstName = null)
    {
        $this->inviteeFirstName = $inviteeFirstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getInviteeLastName()
    {
        return $this->inviteeLastName;
    }

    /**
     * @param string $inviteeLastName
     * @return $this
     */
    public function setInviteeLastName(string $inviteeLastName = null)
    {
        $this->inviteeLastName = $inviteeLastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getInviteeCompanyType()
    {
        return $this->inviteeCompanyType;
    }

    /**
     * @param string $inviteeCompanyType
     * @return $this
     */
    public function setInviteeCompanyType(string $inviteeCompanyType = null)
    {
        $this->inviteeCompanyType = $inviteeCompanyType;
        return $this;
    }

    /**
     * @return LicencedCompany
     */
    public function getInviteeLicencedCompany()
    {
        return $this->inviteeLicencedCompany;
    }

    /**
     * @param LicencedCompany $inviteeLicencedCompany
     * @return $this
     */
    public function setInviteeLicencedCompany(LicencedCompany $inviteeLicencedCompany = null)
    {
        $this->inviteeLicencedCompany = $inviteeLicencedCompany;
        return $this;
    }
}
