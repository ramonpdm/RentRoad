<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use App\Traits\Entities\Shared;

#[ORM\Entity]
#[ORM\Table(name: 'categorias_vehiculos')]
class CategoriaVehiculo
{
    use Shared;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public int $id;

    #[ORM\Column(type: 'string', length: 50)]
    public string $nombre;

    #[ORM\Column(type: 'text', nullable: true)]
    public ?string $descripcion = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    public float $tarifa_base;
}