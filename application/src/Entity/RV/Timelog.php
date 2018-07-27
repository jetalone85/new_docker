<?php


namespace App\Entity\RV;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Table("rv_timelog")
 * @ORM\Entity(repositoryClass="App\Repository\RV\TimelogRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class Timelog
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
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\DailyDrillingReport", inversedBy="timelogs", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $dailyReport;


    /**
     * @var \DateTime
     * @ORM\Column(type="time")
     *
     * @Serializer\Expose()
     * @Serializer\Type("Time")
     *
     * @Assert\NotBlank()
     */
    private $fromTime;

    /**
     * @var \DateTime
     * @ORM\Column(type="time")
     *
     * @Serializer\Expose()
     * @Serializer\Type("Time")
     *
     * @Assert\NotBlank()
     */
    private $toTime;

    /**
     * @var string
     * @ORM\Column(type="string")
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $timeCodeNo;


    /**
     * @var string
     * @ORM\Column(type="string", length=10)
     *
     * @Serializer\Expose()
     *
     */
    private $binTime;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2)
     * @Serializer\Expose()
     * @Assert\Expression("this.getTimeCodeNo() != '2' or this.getDepth()", message="Please define depth")
     *
     * @var float
     */
    private $depth;

    /**
     * @var string
     * @ORM\Column(type="string")
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $detail;


    /**
     * @return int
     */
    public function getId()// : ?int
    {
        return $this->id;
    }

    /**
     * @param bool $withDate
     * @return \DateTime
     */
    public function getFromTime($withDate = false)// : ?\DateTime
    {
        if ($withDate) {
            $date = $this->getDailyReport()->getDate();
            $toTime = clone $this->getFromTime();
            $toTime->setDate($date->format('Y'), $date->format('m'), $date->format('d'));
            return $toTime;
        }
        return $this->fromTime;
    }

    /**
     * @param \DateTime $fromTime
     * @return $this
     */
    public function setFromTime(\DateTime $fromTime = null)
    {
        $this->fromTime = $fromTime;
        return $this;
    }

    /**
     * @param bool $withDate
     * @return \DateTime
     */
    public function getToTime($withDate = false)// : ?\DateTime
    {
        if ($withDate) {
            $date = $this->getDailyReport()->getDate();
            $toTime = clone $this->getToTime();
            $toTime->setDate($date->format('Y'), $date->format('m'), $date->format('d'));
            return $toTime;
        }
        return $this->toTime;
    }

    /**
     * @param \DateTime $toTime
     * @return $this
     */
    public function setToTime(\DateTime $toTime = null)
    {
        $this->toTime = $toTime;
        return $this;
    }

    /**
     * @return null|string
     * @Serializer\VirtualProperty("elapsedTime")
     */
    public function getElapsedTime()
    {
        if ($this->getFromTime() && $this->getToTime()) {
            $fromTime = clone $this->getFromTime();
            $toTime = clone $this->getToTime();
            if ($toTime->format('H:i') == '00:00') {
                $toTime->setTime(23, 59);
                $fromTime->modify('-1 minute');
            }
            $diff = $fromTime->diff($toTime);
            $hours = $diff->h + ($diff->i / 60);
            return round($hours, 2);
        }
        return null;
    }

    /**
     * @return string
     */
    public function getTimeCodeNo()// : ?string
    {
        return $this->timeCodeNo;
    }

    /**
     * @return string
     */
    public function getBaseTimeCodeNo()// : ?string
    {
        preg_match('/[0-9]+/', $this->getTimeCodeNo(), $match);
        if (isset($match[0])) {
            return $match[0];
        }
        return null;
    }

    /**
     * @param string $timeCodeNo
     * @return $this
     */
    public function setTimeCodeNo(string $timeCodeNo = null)
    {
        $this->timeCodeNo = $timeCodeNo;
        return $this;
    }

    /**
     * @return string
     */
    public function getDetail()// : ?string
    {
        return $this->detail;
    }

    /**
     * @param string $detail
     * @return $this
     */
    public function setDetail(string $detail = null)
    {
        $this->detail = $detail;
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

    /**
     * @return float
     */
    public function getDepth()//: ?float
    {
        return $this->depth;
    }

    /**
     * @param float $depth
     * @return $this
     */
    public function setDepth(float $depth = null)
    {
        $this->depth = $depth;
        return $this;
    }

    /**
     * @return string
     */
    public function getBinTime()//: ?string
    {
        return $this->binTime;
    }

    /**
     * @param string $binTime
     * @return $this
     */
    public function setBinTime(string $binTime = null)
    {
        $this->binTime = $binTime;
        return $this;
    }


    public static function getAvailableCodes()
    {
        return [
            '1' => [
                'label' => 'Rig up',
                'children' => [
                    'A' => 'Move rig',
                    'B' => 'Rig up drive',
                    'C' => 'Spot rig/loads/buildings',
                    'D' => 'Level rig'
                ]
            ],
            '2' => [
                'label' => 'Drill',
                'children' => [
                    'A' => 'Drill mousehole',
                    'B' => 'Drill rathole',
                    'C' => 'Drill cement/drill out cement/drill float&shoe'
                ]
            ],
            '3' => [
                'label' => 'Reaming',
                'children' => [
                    'A' => 'Ream & clean',
                    'B' => 'Back reaming',
                    'C' => 'Ream – open hole  '
                ]
            ],
            '4' => [
                'label' => 'Coring',
                'children' => [
                    'A' => 'Handle core brls'
                ]
            ],
            '5' => [
                'label' => 'Condition mud & circulate',
                'children' => [
                    'A' => 'Build volume',
                    'B' => 'Displace to oil base',
                    'C' => 'Displace to water base',
                    'D' => 'Circulate and Condition',
                    'E' => 'C&C due to lost circulation',
                    'F' => 'Change out mud system',
                    'G' => 'Blow/unload hole',
                    'H' => 'Displace to completion fluid',
                    'I' => 'Clean out mud system',
                    'J' => 'Stab in cementation',
                    'K' => 'Clean cement stinger'
                ]
            ],
            '6' => [
                'label' => 'Trips',
                'children' => [
                    'A' => 'Trip in hole',
                    'B' => 'Trip out of hole',
                    'C' => 'Pick up BHA',
                    'D' => 'Lay down BHA',
                    'E' => 'Pick up drill pipe',
                    'F' => 'Lay down drill pipe',
                    'G' => 'Pick up 3rd party tools',
                    'H' => 'Lay down 3rd party tools',
                    'J' => 'Inspect BHA',
                    'M' => 'Wiper Trip'
                ]
            ],
            '7' => [
                'label' => 'Rig Service',
                'children' => [
                    'A' => 'Clean - floor/pump/screens',
                    'B' => 'Change pump head',
                    'C' => 'Change screens'
                ]
            ],
            '8' => [
                'label' => 'Rig Repair',
                'children' => [
                    'A' => 'Downtime - Instrumentation',
                    'B' => 'Downtime - Top drive',
                    'C' => 'Downtime - Mud pump',
                    'D' => 'Downtime - Engines',
                    'E' => 'Downtime - Scr/Electrical',
                    'F' => 'Downtime - Drawworks',
                    'G' => 'Downtime - Mud system',
                    'H' => 'Downtime    - BOP/choke',
                    'I' => 'Downtime Hoisting/lifting'
                ]
            ],
            '9' => [
                'label' => 'Cut off Drill Line',
                'children' => [
                    'A' => 'Slip/Cut drilling line',
                    'B' => 'Change drilling line'
                ]
            ],
            '10' => [
                'label' => 'Deviation survey',
                'children' => [
                    'A' => 'Wireline Surveys - Single shot surveys',
                    'B' => 'Wireline Surveys - Multi -shot surveys',
                ]
            ],
            '11' => [
                'label' => 'Wireline logs',
                'children' => [
                    'A' => 'Logging- Open hole logs',
                    'B' => 'Logging - Cased hole logs',
                    'C' => 'Logging - Coiled tubing logs',
                    'D' => 'Logging - Integrity logs'
                ]
            ],
            '12' => [
                'label' => 'Run casing & cementing',
                'children' => [
                    'A' => 'Rig up/down to run casing',
                    'B' => 'Run casing',
                    'C' => 'Cementing',
                    'D' => 'Top cement jobs',
                    'E' => 'Pressure test CSG/shoe',
                    'F' => 'Cement plugs',
                    'G' => 'Cement for lost circulation',
                    'H' => 'Pulling casing',
                ]
            ],
            '13' => [
                'label' => 'Wait on cement'
            ],
            '14' => [
                'label' => 'Nipple up BOP',
                'children' => [
                    'A' => 'Nipple up BOPs',
                    'B' => 'Nipple down BOPs',
                    'C' => 'Nipple up/down diverter system',
                    'D' => 'Change rams',
                    'E' => 'Install wellhead/tree'
                ]
            ],
            '15' => [
                'label' => 'Test BOP',
                'children' => [
                    'A' => 'Pressure test BOPs',
                    'B' => 'Function test BOPs',
                    'C' => 'Test diverter',
                    'D' => 'Test wellhead/tree'
                ]
            ],
            '16' => [
                'label' => 'Drill stem test',
                'children' => [
                    'A' => 'Handle test tools',
                    'B' => 'Trip in/out test tools',
                    'C' => 'Test formation',
                ]
            ],
            '17' => [
                'label' => 'Plug back'
            ],
            '18' => [
                'label' => 'Squeeze cement'
            ],
            '19' => [
                'label' => 'Fishing',
                'children' => [
                    'A' => 'Jarring',
                    'B' => 'Handle fishing tools',
                    'C' => 'Wait on fishing tools',
                    'D' => 'Trip fishing tools',
                    'E' => 'Wireline work'
                ]
            ],
            '20' => [
                'label' => 'Directional work',
                'children' => [
                    'A' => 'Directional surveys',
                    'B' => 'Controlled drilling',
                    'C' => 'Tool orientation',
                    'D' => 'Handle directional tools',
                    'E' => 'Wait on directional'
                ]
            ],
            '21' => [
                'label' => 'Safety meeting',
                'children' => [
                    'A' => 'Drills/BOP, etc.',
                    'B' => 'JSA (Job Safety Analysis)',
                    'C' => 'On job training',
                    'D' => 'Pre-job safety',
                    'E' => 'QMS/RMS',
                    'F' => 'Safety inspection',
                    'G' => 'Safety stand-down',
                    'H' => 'Third Party Orientation',
                ]
            ],
            '22' => [
                'label' => 'Tear down',
                'children' => [
                    'A' => 'Move rig',
                    'B' => 'Rig down top drive',
                    'C' => 'Load rig',
                ]
            ],
            '23' => [
                'label' => 'Waiting on',
                'children' => [
                    'A' => 'W/O Cementer',
                    'B' => 'W/O Daylight',
                    'C' => 'W/O Lease/Location',
                    'D' => 'W/O Loggers',
                    'E' => 'W/O Orders',
                    'F' => 'W/O Third Party Tools',
                    'G' => 'W/O Third Party Personnel',
                    'H' => 'W/O Tongs',
                    'I' => 'W/O Trucks',
                    'J' => 'W/O Water',
                    'K' => 'W/O Weather',
                    'L' => 'W/O Welder'
                ]
            ],
            '24' => [
                'label' => 'Rig Watch'
            ],
            '25' => [
                'label' => 'Other'
            ]
        ];
    }
}
