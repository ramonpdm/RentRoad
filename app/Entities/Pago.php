<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'pagos')]
class Pago
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Reserva::class)]
    #[ORM\JoinColumn(name: 'reserva_id', referencedColumnName: 'id', nullable: false)]
    private Reserva $reserva;

    #[ORM\Column(type: 'string', columnDefinition: "ENUM('Tarjeta Crédito', 'Tarjeta Débito', 'Efectivo', 'Transferencia')")]
    private string $metodo_pago;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $monto;

    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private \DateTime $fecha_pago;

    #[ORM\Column(type: 'string', columnDefinition: "ENUM('Pendiente', 'Completado', 'Reembolsado', 'Fallido')", options: ['default' => 'Pendiente'])]
    private string $estado = 'Pendiente';

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $transaccion_id = null;

    // Getters and setters...
}