<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use App\Traits\Entities\Shared;

#[ORM\Entity]
#[ORM\Table(name: 'reservas')]
class Reserva
{
    use Shared;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public int $id;

    #[ORM\ManyToOne(targetEntity: Usuario::class)]
    #[ORM\JoinColumn(name: 'usuario_id', referencedColumnName: 'id', nullable: false)]
    public Usuario $usuario;

    #[ORM\ManyToOne(targetEntity: Vehiculo::class)]
    #[ORM\JoinColumn(name: 'vehiculo_id', referencedColumnName: 'id', nullable: false)]
    public Vehiculo $vehiculo;

    #[ORM\ManyToOne(targetEntity: Sucursal::class)]
    #[ORM\JoinColumn(name: 'sucursal_recogida_id', referencedColumnName: 'id', nullable: false)]
    public Sucursal $sucursal_recogida;

    #[ORM\ManyToOne(targetEntity: Sucursal::class)]
    #[ORM\JoinColumn(name: 'sucursal_devolucion_id', referencedColumnName: 'id', nullable: true)]
    public ?Sucursal $sucursal_devolucion = null;

    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    public \DateTime $fecha_reserva;

    #[ORM\Column(type: 'datetime')]
    public \DateTime $fecha_recogida;

    #[ORM\Column(type: 'datetime')]
    public \DateTime $fecha_devolucion;

    #[ORM\Column(type: 'string', columnDefinition: "ENUM('Pendiente', 'Confirmada', 'En curso', 'Completada', 'Cancelada')", options: ['default' => 'Pendiente'])]
    public string $estado = 'Pendiente';

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    public bool $seguro = false;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, options: ['default' => 0])]
    public float $costo_seguro = 0;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    public float $costo_total;

    #[ORM\Column(type: 'text', nullable: true)]
    public ?string $observaciones = null;
}