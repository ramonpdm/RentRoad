<?php

namespace App\Seeders;

use App\Entities\Sucursal;

class SucursalSeeder extends BaseSeeder
{
    const int ORDER = 2;

    public function data(): array
    {
        return [
            new Sucursal([
                'nombre' => 'Sucursal Central',
                'direccion' => 'Av. Principal 123, Centro',
                'ciudad' => 'Ciudad Central',
                'telefono' => '123456789',
                'email' => 'contacto@sucursalcentral.com',
                'aeropuerto_asociado' => 'Aeropuerto Internacional',
                'horario_apertura' => new \DateTime('08:00:00'),
                'horario_cierre' => new \DateTime('18:00:00'),
            ]),];
    }
}