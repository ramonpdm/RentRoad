<?php

namespace App\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Traits\Entities\Shared;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'sucursales')]
class Sucursal
{
    use Shared;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\Column(length: 100)]
    public string $nombre;

    #[ORM\Column(type: 'text')]
    public string $direccion;

    #[ORM\Column(length: 50)]
    public string $ciudad;

    #[ORM\Column(length: 20)]
    public string $telefono;

    #[ORM\Column(length: 100, nullable: true)]
    public ?string $email = null;

    #[ORM\Column(length: 100, nullable: true)]
    public ?string $aeropuerto_asociado = null;

    #[ORM\Column(type: 'time')]
    public DateTime $horario_apertura;

    #[ORM\Column(type: 'time')]
    public DateTime $horario_cierre;
}