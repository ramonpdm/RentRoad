<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'sucursales')]
class Sucursal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 100)]
    private string $nombre;

    #[ORM\Column(type: 'text')]
    private string $direccion;

    #[ORM\Column(type: 'string', length: 50)]
    private string $ciudad;

    #[ORM\Column(type: 'string', length: 20)]
    private string $telefono;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $aeropuerto_asociado = null;

    #[ORM\Column(type: 'time', nullable: true)]
    private ?\DateTime $horario_apertura = null;

    #[ORM\Column(type: 'time', nullable: true)]
    private ?\DateTime $horario_cierre = null;

    #[ORM\Column(type: 'boolean', options: ['default' => true])]
    private bool $activa = true;

    // Getters and setters...
}