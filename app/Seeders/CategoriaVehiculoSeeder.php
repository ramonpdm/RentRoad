<?php

namespace App\Seeders;

use App\Entities\CategoriaVehiculo;

class CategoriaVehiculoSeeder extends BaseSeeder
{
    public function data(): array
    {
        return [
            new CategoriaVehiculo([
                'nombre' => 'Económico',
                'descripcion' => 'Vehículos pequeños y económicos ideales para la ciudad.',
                'costo_base' => 25.00,
                'costo_seguro_base' => 15.00,
            ]),
            new CategoriaVehiculo([
                'nombre' => 'SUV',
                'descripcion' => 'Vehículos deportivos utilitarios con mayor espacio y comodidad.',
                'costo_base' => 50.00,
                'costo_seguro_base' => 35.00,
            ]),
            new CategoriaVehiculo([
                'nombre' => 'Lujo',
                'descripcion' => 'Vehículos de alta gama para una experiencia premium.',
                'costo_base' => 100.00,
                'costo_seguro_base' => 70.00,
            ]),
        ];
    }
}