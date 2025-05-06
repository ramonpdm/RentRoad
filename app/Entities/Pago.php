<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use App\Traits\Entities\Shared;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'pagos')]
class Pago
{
    use Shared;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    public Renta $reserva;

    #[ORM\Column(columnDefinition: "ENUM('Tarjeta Crédito', 'Tarjeta Débito', 'Efectivo', 'Transferencia')")]
    public string $metodo_pago;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    public float $monto;

    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    public \DateTime $fecha_pago;

    #[ORM\Column(columnDefinition: "ENUM('Pendiente', 'Completado', 'Reembolsado', 'Fallido')", options: ['default' => 'Pendiente'])]
    public string $estado = 'Pendiente';

    #[ORM\Column(length: 100, nullable: true)]
    public ?string $transaccion_id = null;
}