<?php

namespace App\Seeders;

use App\Entities\CategoriaVehiculo;
use App\Entities\Vehiculo;

class VehiculoSeeder extends BaseSeeder
{
    const int ORDER = 5;

    public function data(): array
    {
        $categoriesRepo = $this->entityManager->getRepository(CategoriaVehiculo::class);
        return [
            new Vehiculo([
                'marca' => 'Toyota',
                'modelo' => 'Corolla',
                'ano' => 2020,
                'placa' => 'ABC123',
                'color' => 'Blanco',
                'kilometraje' => 15000,
                'transmision' => 'Automático',
                'capacidad_pasajeros' => 5,
                'capacidad_maletero' => 400,
                'combustible' => 'Gasolina',
                'estado' => 'Disponible',
                'tarifa_diaria' => 30.00,
                'categoria' => $categoriesRepo->find(1),
                'imagen_url' => '/public/images/car_1.jpg'
            ]),
            new Vehiculo([
                'marca' => 'Ford',
                'modelo' => 'Explorer',
                'ano' => 2021,
                'placa' => 'DEF456',
                'color' => 'Negro',
                'kilometraje' => 10000,
                'transmision' => 'Automático',
                'capacidad_pasajeros' => 7,
                'capacidad_maletero' => 600,
                'combustible' => 'Gasolina',
                'estado' => 'Disponible',
                'tarifa_diaria' => 60.00,
                'categoria' => $categoriesRepo->find(2),
                'imagen_url' => '/public/images/car_2.jpg'
            ]),
            new Vehiculo([
                'marca' => 'BMW',
                'modelo' => 'Serie 5',
                'ano' => 2022,
                'placa' => 'GHI789',
                'color' => 'Azul',
                'kilometraje' => 5000,
                'transmision' => 'Automático',
                'capacidad_pasajeros' => 5,
                'capacidad_maletero' => 450,
                'combustible' => 'Gasolina',
                'estado' => 'Disponible',
                'tarifa_diaria' => 120.00,
                'categoria' => $categoriesRepo->find(3),
                'imagen_url' => '/public/images/car_3.jpg'
            ]),
        ];
    }
}