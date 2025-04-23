<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'reservas')]
class Reserva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Usuario::class)]
    #[ORM\JoinColumn(name: 'usuario_id', referencedColumnName: 'id', nullable: false)]
    private Usuario $usuario;

    #[ORM\ManyToOne(targetEntity: Vehiculo::class)]
    #[ORM\JoinColumn(name: 'vehiculo_id', referencedColumnName: 'id', nullable: false)]
    private Vehiculo $vehiculo;

    #[ORM\ManyToOne(targetEntity: Sucursal::class)]
    #[ORM\JoinColumn(name: 'sucursal_recogida_id', referencedColumnName: 'id', nullable: false)]
    private Sucursal $sucursal_recogida;

    #[ORM\ManyToOne(targetEntity: Sucursal::class)]
    #[ORM\JoinColumn(name: 'sucursal_devolucion_id', referencedColumnName: 'id', nullable: true)]
    private ?Sucursal $sucursal_devolucion = null;

    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private \DateTime $fecha_reserva;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $fecha_recogida;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $fecha_devolucion;

    #[ORM\Column(type: 'string', columnDefinition: "ENUM('Pendiente', 'Confirmada', 'En curso', 'Completada', 'Cancelada')", options: ['default' => 'Pendiente'])]
    private string $estado = 'Pendiente';

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $seguro = false;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, options: ['default' => 0])]
    private float $costo_seguro = 0;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $costo_total;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $observaciones = null;

    // Getters and setters...
}