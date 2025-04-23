<?php

namespace App\Traits\Entities;

use Doctrine\ORM\Mapping as ORM;

trait Shared
{
    #[ORM\Column(type: 'boolean', options: ['default' => true])]
    public bool $activo = true;

    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    public \DateTime $fecha_creacion;
}