<?php

namespace App\Entity\Shared;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccumapDevelopment
 *
 * @ORM\Table(name="accumap_development")
 * @ORM\Entity(repositoryClass="App\Repository\Shared\AccumapDevelopmentRepository")
 */
class AccumapDevelopment extends AccumapDevelopmentCommon
{
}
