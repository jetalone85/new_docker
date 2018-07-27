<?php

namespace App\Entity\Shared;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Table(name="global_well_access_table")
 * @ORM\Entity
 */
class GlobalWellAccessTable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="WELL_LICENCE_ID", type="string", nullable=false)
     */
    public $wellLicenceId;

    /**
     * @var integer
     *
     * @ORM\Column(name="COMPANY_ID", type="integer", nullable=false)
     */
    public $companyId;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id;
}
