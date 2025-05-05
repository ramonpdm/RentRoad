<?php

namespace App\Seeders;

use App\Entities\Tarifa;
use App\Entities\Vehiculo;
use App\Enums\TipoTarifa;

class TarifaSeeder extends BaseSeeder
{
    public function data(): array
    {
        // Debemos crear al menos una tarifa por cada vehículo
        $vehicles = $this->getRepo(Vehiculo::class)->findAll();

        $fees = [];

        foreach ($vehicles as $vehicle) {
            $fees[] = new Tarifa([
                'vehiculo' => $vehicle,
                'tipo' => TipoTarifa::Economica,
                'costo_base' => 25,
                'costo_seguro' => 0,
                'descripcion' => 'Tarifa base para vehículos de categoría económica.',
            ]);

            $fees[] = new Tarifa([
                'vehiculo' => $vehicle,
                'tipo' => TipoTarifa::Premium,
                'costo_base' => 80,
                'costo_seguro' => 0,
                'descripcion' => 'Tarifa base para vehículos de categoría premium.',
            ]);

            $fees[] = new Tarifa([
                'vehiculo' => $vehicle,
                'tipo' => TipoTarifa::Lujo,
                'costo_base' => 150,
                'costo_seguro' => 0,
                'descripcion' => 'Tarifa base para vehículos de categoría lujo.',
            ]);
        }

        return $fees;
    }
}