<?php

namespace App\Entity\RV;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class MaterialTransfer
 * @package App\Entity\RV
 * @author Marcin Pyrka <marcin.pyrka@polcode.net>
 *
 * @ORM\Table(name="rv_material_transfer")
 * @ORM\Entity(repositoryClass="App\Repository\RV\MaterialTransferRepository")
 * @Serializer\ExclusionPolicy("all")
 *
 * @UniqueEntity(fields={"dailyReport", "type"}, errorPath="type", message="Combination of date and type is already in use.")
 */
class MaterialTransfer
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
     * @ORM\Column(name="type", type="string", nullable=false)
     * @Serializer\Expose()
     */
    private $type;

    /**
     * @var Project
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\Project", inversedBy="materialTransfers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    /**
     * @var DailyDrillingReport
     * @ORM\ManyToOne(targetEntity="App\Entity\RV\DailyDrillingReport", inversedBy="MaterialTransfers", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     *
     * @Serializer\Expose()
     */
    private $dailyReport;

    /**
     * @ORM\OneToMany(
     *     targetEntity="MaterialTransferOperation",
     *     mappedBy="materialTransfer",
     *     cascade={"all"},
     *     orphanRemoval=true,
     *     fetch="EXTRA_LAZY"
     * )
     */
    private $operations;

    /**
     * MaterialTransfer constructor.
     */
    public function __construct()
    {
        $this->operations = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
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
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param Project $project
     * @return $this
     */
    public function setProject(Project $project = null)
    {
        $this->project = $project;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     * @Serializer\VirtualProperty()
     */
    public function getOperationsCount()
    {
        return $this->getOperations()->count();
    }


    /**
     * @return Collection|MaterialTransfer[]
     */
    public function getOperations()
    {
        return $this->operations;
    }

    /**
     * @param PersistentCollection $operations
     * @return MaterialTransfer
     */
    public function setOperations($operations)
    {
        $this->operations = $operations;

        foreach ($operations as $operation) {
            $operation->setMaterialTransfer($this);
        }
        $this->operations = $operations;

        return $this;
    }
}
