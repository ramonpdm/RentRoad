<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use App\Traits\Entities\Shared;

#[ORM\MappedSuperclass]
abstract class Persona
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

    #[ORM\Column(type: 'date', nullable: true)]
    public ?\DateTime $fecha_nacimiento = null;

    public function getNombreCompleto(): string
    {
        return $this->nombre . ' ' . $this->apellido;
    }

    public function isCustomer(): bool
    {
        return $this instanceof Cliente;
    }

    public function isAdmin(): bool
    {
        return $this instanceof Usuario;
    }
}
