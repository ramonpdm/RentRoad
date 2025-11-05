<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'clientes')]
class Cliente extends Persona
{
    #[ORM\Column(type: 'text', nullable: true)]
    public ?string $direccion = null;

    #[ORM\Column(length: 50, unique: true)]
    public string $licencia_conducir;

    #[ORM\Column(type: 'date')]
    public \DateTime $fecha_vencimiento_licencia;

    public function licenciaValida(): bool
    {
        return $this->fecha_vencimiento_licencia >= new \DateTime('today');
    }
}
