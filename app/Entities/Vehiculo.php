<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
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

    #[ORM\ManyToOne(targetEntity: CategoriaVehiculo::class)]
    #[ORM\JoinColumn(name: 'categoria_id', referencedColumnName: 'id', nullable: false)]
    public CategoriaVehiculo $categoria;

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

    #[ORM\Column(type: 'string', columnDefinition: "ENUM('Gasolina', 'Diesel', 'Híbrido', 'Eléctrico')")]
    public string $combustible;

    #[ORM\ManyToOne(targetEntity: Sucursal::class)]
    #[ORM\JoinColumn(name: 'sucursal_id', referencedColumnName: 'id', nullable: true)]
    public ?Sucursal $sucursal = null;

    #[ORM\Column(type: 'string', options: ['default' => 'Disponible'], columnDefinition: "ENUM('Disponible', 'Alquilado', 'Mantenimiento', 'Fuera de servicio')")]
    public string $estado = 'Disponible';

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    public ?string $imagen_url = null;
}