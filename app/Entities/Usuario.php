<?php

namespace App\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'usuarios')]
class Usuario extends Persona
{
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    public Sucursal $sucursal;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    public Rol $rol;

    #[ORM\Column(type: 'date', nullable: true)]
    public ?DateTime $fecha_contratacion = null;
}
