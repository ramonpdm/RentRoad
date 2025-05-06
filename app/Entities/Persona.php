<?php

namespace App\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Traits\Entities\Shared;

#[ORM\MappedSuperclass]
abstract class Persona
{
    use Shared;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\Column(length: 100)]
    public string $nombre;

    #[ORM\Column(length: 100)]
    public string $apellido;

    #[ORM\Column(length: 100, unique: true)]
    public string $email;

    #[ORM\Column(length: 255)]
    public string $password;

    #[ORM\Column(length: 20, nullable: true)]
    public ?string $telefono = null;

    #[ORM\Column]
    public DateTime $fecha_nacimiento;

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
