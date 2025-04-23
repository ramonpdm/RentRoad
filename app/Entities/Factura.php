<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'facturas')]
class Factura
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Reserva::class)]
    #[ORM\JoinColumn(name: 'reserva_id', referencedColumnName: 'id', nullable: false)]
    private Reserva $reserva;

    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private \DateTime $fecha_emision;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $subtotal;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $impuestos;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $total;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(type: 'string', options: ['default' => 'Emitida'], columnDefinition: "ENUM('Emitida', 'Anulada', 'Pagada')")]
    private string $estado = 'Emitida';
}