<?php


namespace App\Entity\RV;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @author Damian Wróblewski
 * @ORM\Entity()
 * @ORM\Table("rv_shale_shaker")
 * @Serializer\ExclusionPolicy("all")
 */
class ShaleShaker
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
     * @var int
     *
     * @ORM\Column( type="integer")
     *
     * @Serializer\Expose()
     */
    private $shakerNo;
    
    /**
     * @var int
     *
     * @ORM\Column( type="integer")
     */
    private $screenNo;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     *
     * @Serializer\Expose()
     */
    private $make;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     *
     * @Serializer\Expose()
     */
    private $model;

    /**
     * @return int
     */
    public function getId()// : ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id = null)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getShakerNo()// : ?int
    {
        return $this->shakerNo;
    }

    /**
     * @param int $shakerNo
     * @return $this
     */
    public function setShakerNo(int $shakerNo = null)
    {
        $this->shakerNo = $shakerNo;
        return $this;
    }

    
    
    /**
     * @return int
     */
    public function getScreenNo()// : ?int
    {
        return $this->screenNo;
    }

    /**
     * @param int $screenNo
     * @return $this
     */
    public function setScreenNo(int $screenNo = null)
    {
        $this->screenNo = $screenNo;
        return $this;
    }

    /**
     * @return string
     */
    public function getMake()// : ?int
    {
        return $this->make;
    }

    /**
     * @param string $make
     * @return $this
     */
    public function setMake(string $make = null)
    {
        $this->make = $make;
        return $this;
    }

    /**
     * @return string
     */
    public function getModel()// : ?string
    {
        return $this->model;
    }

    /**
     * @param string $model
     * @return $this
     */
    public function setModel(string $model = null)
    {
        $this->model = $model;
        return $this;
    }

    public function __toString()
    {
        return $this->getModel();
    }
}
