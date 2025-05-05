<?php

namespace App\Seeders;

use App\Entities\Tarifa;
use App\Entities\Vehiculo;

class TarifaSeeder extends BaseSeeder
{
    public function data(): array
    {
        return [
            new Tarifa([
                'vehiculo' => $this->getRepo(Vehiculo::class)->find(1),
                'costo_base' => 100,
                'costo_seguro' => 0,
                'descripcion' => 'Tarifa base para vehículos de categoría económica.',
            ]),
        ];
    }
}