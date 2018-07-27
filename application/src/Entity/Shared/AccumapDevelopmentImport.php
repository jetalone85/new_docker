<?php

namespace App\Entity\Shared;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="accumap_development_temp")
 * @ORM\Entity(repositoryClass="App\Repository\Shared\AccumapDevelopmentImportRepository")
 */
class AccumapDevelopmentImport extends AccumapDevelopmentCommon
{
}
