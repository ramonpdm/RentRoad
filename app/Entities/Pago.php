<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use App\Traits\Entities\Shared;

#[ORM\Entity]
#[ORM\Table(name: 'pagos')]
class Pago
{
    use Shared;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public int $id;

    #[ORM\ManyToOne(targetEntity: Reserva::class)]
    #[ORM\JoinColumn(name: 'reserva_id', referencedColumnName: 'id', nullable: false)]
    public Reserva $reserva;

    #[ORM\Column(type: 'string', columnDefinition: "ENUM('Tarjeta Crédito', 'Tarjeta Débito', 'Efectivo', 'Transferencia')")]
    public string $metodo_pago;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    public float $monto;

    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    public \DateTime $fecha_pago;

    #[ORM\Column(type: 'string', columnDefinition: "ENUM('Pendiente', 'Completado', 'Reembolsado', 'Fallido')", options: ['default' => 'Pendiente'])]
    public string $estado = 'Pendiente';

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    public ?string $transaccion_id = null;
}