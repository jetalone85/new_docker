<?php


namespace App\Entity\Shared;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Damian Wróblewski
 *
 * @ORM\Entity()
 */
class CompanyService
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
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var Company[]|Collection|array
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Shared\Company", mappedBy="services")
     */
    private $companies;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name = null)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Company[]|Collection|array
     */
    public function getCompanies()
    {
        return $this->companies;
    }

    /**
     * @param Company[]|Collection|array $companies
     * @return $this
     */
    public function setCompanies($companies = null)
    {
        $this->companies = $companies;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
