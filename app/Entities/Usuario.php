<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use App\Traits\Entities\Shared;

#[ORM\Entity]
#[ORM\Table(name: 'usuarios')]
class Usuario
{
    use Shared;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public int $id;

    #[ORM\Column(type: 'string', length: 100)]
    public string $nombre;

    #[ORM\Column(type: 'string', length: 100)]
    public string $apellido;

    #[ORM\Column(type: 'string', length: 100, unique: true)]
    public string $email;

    #[ORM\Column(type: 'string', length: 255)]
    public string $password;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    public ?string $telefono = null;

    #[ORM\Column(type: 'text', nullable: true)]
    public ?string $direccion = null;

    #[ORM\ManyToOne(targetEntity: Sucursal::class)]
    #[ORM\JoinColumn(name: 'sucursal_id', referencedColumnName: 'id', nullable: true)]
    public ?Sucursal $sucursal = null;

    #[ORM\ManyToOne(targetEntity: Rol::class)]
    #[ORM\JoinColumn(name: 'rol_id', referencedColumnName: 'id', nullable: false)]
    public Rol $rol;

    #[ORM\Column(type: 'date', nullable: true)]
    public ?\DateTime $fecha_contratacion = null;

    #[ORM\Column(type: 'date', nullable: true)]
    public ?\DateTime $fecha_nacimiento = null;
}