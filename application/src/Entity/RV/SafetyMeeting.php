<?php

namespace App\Entity\RV;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * SafetyMeeting class.
 *
 * @ORM\Table(name="rv_safety_meeting")
 * @ORM\Entity(repositoryClass="App\Repository\RV\SafetyMeetingRepository")
 * @Serializer\ExclusionPolicy("all")
 *
 * @package App\Entity\RV
 * @author Michał Haracewiat <michal.haracewiat@polcode.net>
 */
class SafetyMeeting
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose()
     *
     * @var int
     */
    protected $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Licence", inversedBy="safetyMeetings")
     * @ORM\JoinColumn(nullable=false)
     *
     * @var Licence
     */
    protected $licence;

    
    /**
     * @ORM\Column(name="date", type="datetime")
     * @Serializer\Expose()
     *
     * @var \DateTime
     */
    private $date;


    /**
     * SafetyMeeting constructor.
     *
     * @codeCoverageIgnore
     *
     * @param Licence $licence
     */
    public function __construct(Licence $licence)
    {
        $this->setLicence($licence);
    }


    /**
     * Get id
     *
     * @codeCoverageIgnore
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set licence
     *
     * @codeCoverageIgnore
     *
     * @param Licence $licence
     * @return SafetyMeeting
     */
    public function setLicence(Licence $licence)
    {
        $this->licence = $licence;

        return $this;
    }

    /**
     * Get licence
     *
     * @codeCoverageIgnore
     *
     * @return Licence
     */
    public function getLicence()
    {
        return $this->licence;
    }


    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return SafetyMeeting
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
