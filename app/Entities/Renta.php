<?php

namespace App\Entities;

use App\Enums\EstadoRenta;
use Doctrine\ORM\Mapping as ORM;
use App\Traits\Entities\Shared;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'reservas')]
class Renta
{
    use Shared;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public int $id;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    public Cliente $cliente;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    public Vehiculo $vehiculo;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    public Tarifa $tarifa;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    public Sucursal $sucursal_recogida;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: true)]
    public ?Sucursal $sucursal_devolucion = null;

    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    public \DateTime $fecha_reserva;

    #[ORM\Column(type: 'datetime')]
    public \DateTime $fecha_recogida;

    #[ORM\Column(type: 'datetime')]
    public \DateTime $fecha_devolucion;

    #[ORM\Column(enumType: EstadoRenta::class, options: ['default' => EstadoRenta::Pendiente])]
    public EstadoRenta $estado = EstadoRenta::Pendiente;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    public bool $seguro = false;

    #[ORM\Column(type: 'text', nullable: true)]
    public ?string $observaciones = null;

    public function getDiasRenta(): int
    {
        $interval = $this->fecha_recogida->diff($this->fecha_devolucion);
        return (int)$interval->days;
    }

    public function getCostoTotal(): float
    {
        $cost = $this->tarifa->costo_base;

        if ($this->seguro) {
            $cost += $this->tarifa->costo_seguro;
        }

        return $cost * $this->getDiasRenta();
    }
}