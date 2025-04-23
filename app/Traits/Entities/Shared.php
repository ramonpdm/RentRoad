<?php

namespace App\Traits\Entities;

use Doctrine\ORM\Mapping as ORM;

trait Shared
{
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    #[ORM\Column(type: 'boolean', options: ['default' => true])]
    public bool $activo = true;

    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    public \DateTime $fecha_creacion;

    #[ORM\PrePersist]
    public function setFechaCreacion(): void
    {
        $this->fecha_creacion = new \DateTime();
    }
}