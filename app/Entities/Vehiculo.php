<?php

namespace App\Entities;

use App\Enums\EstadoVehiculo;
use Doctrine\ORM\Mapping as ORM;
use App\Enums\Combustible;
use App\Repositories\VehiclesRepo;
use App\Traits\Entities\Shared;

#[ORM\Entity(repositoryClass: VehiclesRepo::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'vehiculos')]
class Vehiculo
{
    use Shared;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public int $id;

    #[ORM\Column(type: 'string', length: 50)]
    public string $marca;

    #[ORM\Column(type: 'string', length: 50)]
    public string $modelo;

    #[ORM\Column(type: 'integer')]
    public int $ano;

    #[ORM\Column(type: 'string', length: 20, unique: true)]
    public string $placa;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'categoria', nullable: false)]
    public CategoriaVehiculo $categoria;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    public Sucursal $sucursal;

    #[ORM\Column(type: 'string', length: 30, nullable: true)]
    public ?string $color = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    public ?int $kilometraje = null;

    #[ORM\Column(type: 'string', columnDefinition: "ENUM('Automático', 'Manual')")]
    public string $transmision;

    #[ORM\Column(type: 'integer')]
    public int $capacidad_pasajeros;

    #[ORM\Column(type: 'integer', nullable: true)]
    public ?int $capacidad_maletero = null;

    #[ORM\Column(nullable: true, options: ['default' => null])]
    public ?float $costo = null;

    #[ORM\Column(nullable: true, options: ['default' => null])]
    public ?float $costo_seguro = null;

    #[ORM\Column(enumType: Combustible::class, options: ['default' => Combustible::Gasolina])]
    public Combustible $combustible;

    #[ORM\Column(enumType: EstadoVehiculo::class, options: ['default' => EstadoVehiculo::Disponible])]
    public EstadoVehiculo $estado = EstadoVehiculo::Disponible;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    public ?string $imagen_url = null;

    public function getNombre(): string
    {
        return $this->marca . ' ' . $this->modelo;
    }

    public function getCosto(): float
    {
        return $this->costo ?? $this->categoria->costo_base;
    }

    public function getCostoSeguro(): float
    {
        return $this->costo_seguro ?? $this->categoria->costo_seguro_base;
    }

    public function getCostoTotal(): float
    {
        return $this->getCosto() + $this->getCostoSeguro();
    }
}