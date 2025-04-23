<?php

namespace App\Seeders;

use App\Entities\CategoriaVehiculo;

class CategoriaVehiculoSeeder extends BaseSeeder
{
    protected string $className = CategoriaVehiculo::class;

    public function data(): array
    {
        return [
            ['nombre' => 'Económico', 'descripcion' => 'Vehículos pequeños y económicos ideales para la ciudad.', 'tarifa_base' => 25.00],
            ['nombre' => 'SUV', 'descripcion' => 'Vehículos deportivos utilitarios con mayor espacio y comodidad.', 'tarifa_base' => 50.00],
            ['nombre' => 'Lujo', 'descripcion' => 'Vehículos de alta gama para una experiencia premium.', 'tarifa_base' => 100.00],
        ];
    }
}