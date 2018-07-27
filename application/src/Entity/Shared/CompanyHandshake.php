<?php


namespace App\Entity\Shared;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

/**
 * operator company can be managed by consultant company
 * accepted field is used in case of handshake request
 *
 * @author Damian Wróblewski
 *
 * @ORM\Entity()
 */
class CompanyHandshake
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    protected $id;


    /**
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="handshakes")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $operatorCompany;

    /**
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="handshakesReceived")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $consultantCompany;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $accepted = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $acceptedAt;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $acceptedBy;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Company
     */
    public function getOperatorCompany()
    {
        return $this->operatorCompany;
    }

    /**
     * @param Company $operatorCompany
     * @return $this
     */
    public function setOperatorCompany(Company $operatorCompany = null)
    {
        $this->operatorCompany = $operatorCompany;
        return $this;
    }

    /**
     * @return Company
     */
    public function getConsultantCompany()
    {
        return $this->consultantCompany;
    }

    /**
     * @param Company $consultantCompany
     * @return $this
     */
    public function setConsultantCompany(Company $consultantCompany = null)
    {
        $this->consultantCompany = $consultantCompany;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAccepted()
    {
        return $this->accepted;
    }

    /**
     * @param bool $accepted
     * @return $this
     */
    public function setAccepted(bool $accepted = null)
    {
        $this->accepted = $accepted;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAcceptedAt()
    {
        return $this->acceptedAt;
    }

    /**
     * @return User
     */
    public function getAcceptedBy()
    {
        return $this->acceptedBy;
    }

    /**
     * @param User $acceptedBy
     * @return $this
     */
    public function setAcceptedBy(User $acceptedBy = null)
    {
        $this->acceptedBy = $acceptedBy;
        return $this;
    }
}
