<?php

namespace App\Entities;

use App\Enums\TipoTarifa;
use Doctrine\ORM\Mapping as ORM;
use App\Traits\Entities\Shared;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'tarifas')]
class Tarifa
{
    use Shared;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public int $id;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    public Vehiculo $vehiculo;

    #[ORM\Column(enumType: TipoTarifa::class, options: ['default' => TipoTarifa::Economica])]
    public TipoTarifa $tipo = TipoTarifa::Economica;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    public float $costo_base;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, options: ['default' => 0])]
    public float $costo_seguro = 0;

    #[ORM\Column(type: 'text', nullable: true)]
    public ?string $descripcion = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    public bool $descontinuada = false;
}