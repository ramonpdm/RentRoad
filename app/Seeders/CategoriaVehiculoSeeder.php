<?php

namespace App\Seeders;

use App\Entities\CategoriaVehiculo;

class CategoriaVehiculoSeeder extends BaseSeeder
{
    public function data(): array
    {
        return [
            new CategoriaVehiculo(['nombre' => 'Económico', 'descripcion' => 'Vehículos pequeños y económicos ideales para la ciudad.', 'tarifa_base' => 25.00]),
            new CategoriaVehiculo(['nombre' => 'SUV', 'descripcion' => 'Vehículos deportivos utilitarios con mayor espacio y comodidad.', 'tarifa_base' => 50.00]),
            new CategoriaVehiculo(['nombre' => 'Lujo', 'descripcion' => 'Vehículos de alta gama para una experiencia premium.', 'tarifa_base' => 100.00]),
        ];
    }
}