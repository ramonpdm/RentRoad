<?php

namespace App\Seeders;

use App\Entities\CategoriaVehiculo;
use App\Entities\Sucursal;
use App\Entities\Vehiculo;
use App\Enums\Combustible;
use App\Enums\EstadoVehiculo;

class VehiculoSeeder extends BaseSeeder
{
    public function data(): array
    {
        $categoriesRepo = $this->entityManager->getRepository(CategoriaVehiculo::class);
        return [
            new Vehiculo([
                'sucursal' => $this->getRepo(Sucursal::class)->find(1),
                'marca' => 'Mazda',
                'modelo' => 'CX-5',
                'ano' => 2025,
                'placa' => 'G12345',
                'color' => 'Negro',
                'kilometraje' => 100,
                'transmision' => 'Automático',
                'capacidad_pasajeros' => 4,
                'capacidad_maletero' => 400,
                'combustible' => Combustible::Gasolina,
                'estado' => EstadoVehiculo::Disponible,
                'categoria' => $categoriesRepo->find(1),
                'imagen_url' => '/public/images/mazda_cx5.jpg'
            ]),
            new Vehiculo([
                'sucursal' => $this->getRepo(Sucursal::class)->find(1),
                'marca' => 'Toyota',
                'modelo' => 'Corolla',
                'ano' => 2020,
                'placa' => 'ABC123',
                'color' => 'Blanco',
                'kilometraje' => 15000,
                'transmision' => 'Automático',
                'capacidad_pasajeros' => 5,
                'capacidad_maletero' => 400,
                'combustible' => Combustible::Gasolina,
                'estado' => EstadoVehiculo::Disponible,
                'categoria' => $categoriesRepo->find(1),
                'imagen_url' => '/public/images/car_1.jpg'
            ]),
            new Vehiculo([
                'sucursal' => $this->getRepo(Sucursal::class)->find(1),
                'marca' => 'Ford',
                'modelo' => 'Explorer',
                'ano' => 2021,
                'placa' => 'DEF456',
                'color' => 'Negro',
                'kilometraje' => 10000,
                'transmision' => 'Automático',
                'capacidad_pasajeros' => 7,
                'capacidad_maletero' => 600,
                'combustible' => Combustible::Gasolina,
                'estado' => EstadoVehiculo::Disponible,
                'categoria' => $categoriesRepo->find(2),
                'imagen_url' => '/public/images/car_2.jpg'
            ]),
            new Vehiculo([
                'sucursal' => $this->getRepo(Sucursal::class)->find(1),
                'marca' => 'BMW',
                'modelo' => 'Serie 5',
                'ano' => 2022,
                'placa' => 'GHI789',
                'color' => 'Azul',
                'kilometraje' => 5000,
                'transmision' => 'Automático',
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