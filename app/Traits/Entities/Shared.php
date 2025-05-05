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

    public function toArray(): array
    {
        $rfl = new \ReflectionClass($this);
        $props = $rfl->getProperties(\ReflectionProperty::IS_PUBLIC);
        $data = [];

        foreach ($props as $prop) {
            $name = $prop->getName();
            $value = $this->$name;

            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            } elseif (is_object($value) && method_exists($value, 'toArray')) {
                $value = $value->toArray();
            }

            $data[$name] = $value;
        }

        return $data;
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