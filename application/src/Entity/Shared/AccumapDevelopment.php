<?php

namespace App\Entity\Shared;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Table(name="accumap_development")
 * @ORM\Entity(repositoryClass="App\Repository\Shared\AccumapDevelopmentRepository")
 */
class AccumapDevelopment extends AccumapDevelopmentCommon
{
}
