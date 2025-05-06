<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use App\Traits\Entities\Shared;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'facturas')]
class Factura
{
    use Shared;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    public Renta $reserva;

    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    public \DateTime $fecha_emision;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    public float $subtotal;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    public float $impuestos;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    public float $total;

    #[ORM\Column(type: 'text', nullable: true)]
    public ?string $descripcion = null;

    #[ORM\Column(type: 'string', options: ['default' => 'Emitida'], columnDefinition: "ENUM('Emitida', 'Anulada', 'Pagada')")]
    public string $estado = 'Emitida';
}