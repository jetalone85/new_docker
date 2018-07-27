<?php

namespace App\Entity\RV;

interface SimpleTypeInterface
{
    public function getId();

    public function getName();

    public function isDeleted();

    public function setName($name);

    public function setDeleted($deleted);
}
