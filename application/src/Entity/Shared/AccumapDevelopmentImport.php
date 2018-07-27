<?php

namespace App\Entity\Shared;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Table(name="accumap_development_import")
 * @ORM\Entity(repositoryClass="App\Repository\Shared\AccumapDevelopmentImportRepository")
 */
class AccumapDevelopmentImport extends AccumapDevelopmentCommon
{
}
