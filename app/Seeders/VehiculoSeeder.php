<?php

namespace App\Seeders;

use App\Entities\CategoriaVehiculo;
use App\Entities\Sucursal;
use App\Entities\Vehiculo;
use App\Enums\Combustible;
use App\Enums\EstadoVehiculo;
use App\Enums\Transmision;

class VehiculoSeeder extends BaseSeeder
{
    public function data(): array
    {
        $categoriesRepo = $this->entityManager->getRepository(CategoriaVehiculo::class);
        return [
            new Vehiculo([
                'sucursal' => $this->getRepo(Sucursal::class)->find(2),
                'marca' => 'Mazda',
                'modelo' => 'CX-5',
                'ano' => 2025,
                'placa' => 'G12345',
                'color' => 'Negro',
                'kilometraje' => 100,
                'transmision' => Transmision::Automatica,
                'capacidad_pasajeros' => 4,
                'capacidad_maletero' => 400,
                'combustible' => Combustible::Gasolina,
                'estado' => EstadoVehiculo::Disponible,
                'categoria' => $categoriesRepo->find(2),
                'imagen_url' => '/public/images/mazda_cx5.jpg'
            ]),
            new Vehiculo([
                'sucursal' => $this->getRepo(Sucursal::class)->find(1),
                'marca' => 'Ford',
                'modelo' => 'Fiesta',
                'ano' => 2020,
                'placa' => 'ABC123',
                'color' => 'Blanco',
                'kilometraje' => 15000,
                'transmision' => Transmision::Automatica,
                'capacidad_pasajeros' => 5,
                'capacidad_maletero' => 400,
                'combustible' => Combustible::Gasolina,
                'estado' => EstadoVehiculo::Disponible,
                'categoria' => $categoriesRepo->find(1),
                'imagen_url' => '/public/images/car_1.jpg'
            ]),
            new Vehiculo([
                'sucursal' => $this->getRepo(Sucursal::class)->find(1),
                'marca' => 'Porsche',
                'modelo' => 'Panamera',
                'ano' => 2022,
                'placa' => 'DEF456',
                'color' => 'Gris',
                'kilometraje' => 10000,
                'transmision' => Transmision::Automatica,
                'capacidad_pasajeros' => 7,
                'capacidad_maletero' => 600,
                'combustible' => Combustible::Gasolina,
                'estado' => EstadoVehiculo::Disponible,
                'categoria' => $categoriesRepo->find(3),
                'imagen_url' => '/public/images/car_2.jpg'
            ]),
            new Vehiculo([
                'sucursal' => $this->getRepo(Sucursal::class)->find(1),
                'marca' => 'Maserati',
                'modelo' => 'Towing',
                'ano' => 2019,
                'placa' => 'GHI789',
                'color' => 'Blanco',
                'kilometraje' => 5000,
                'transmision' => Transmision::Automatica,
                'capacidad_pasajeros' => 5,
                'capacidad_maletero' => 450,
                'combustible' => Combustible::Gasolina,
                'estado' => EstadoVehiculo::Disponible,
                'categoria' => $categoriesRepo->find(3),
                'imagen_url' => '/public/images/car_3.jpg'
            ]),
        ];
    }
}