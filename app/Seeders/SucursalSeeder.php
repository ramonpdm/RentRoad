<?php

namespace App\Seeders;

use DateTime;
use App\Entities\Sucursal;

class SucursalSeeder extends BaseSeeder
{
    public function data(): array
    {
        return [
            new Sucursal([
                'nombre' => 'Sucursal Central',
                'direccion' => 'Av. Principal 123, Centro',
                'ciudad' => 'Ciudad Central',
                'telefono' => '123456789',
                'email' => 'central@rentroad.com',
                'aeropuerto_asociado' => 'SDQ',
                'horario_apertura' => new DateTime('08:00:00'),
                'horario_cierre' => new DateTime('19:00:00'),
            ]),
            new Sucursal([
                'nombre' => 'Sucursal Villa Mella',
                'direccion' => 'Av. Hermanas Mirabal, Sector Blablabla, 54B',
                'ciudad' => 'Santo Domingo Norte',
                'telefono' => '123456789',
                'email' => 'villamella@rentroad.com',
                'aeropuerto_asociado' => 'SDQ',
                'horario_apertura' => new DateTime('08:00:00'),
                'horario_cierre' => new DateTime('16:00:00'),
            ]),
        ];
    }
}