<?php

namespace App\Seeders;

use App\Entities\Cliente;
use App\Entities\Renta;
use App\Entities\Sucursal;
use App\Entities\Vehiculo;
use App\Enums\EstadoRenta;

class RentaSeeder extends BaseSeeder
{
    public function data(): array
    {
        /** @var Vehiculo $vehiculo */
        $vehiculo = $this->getRepo(Vehiculo::class)->find(1);

        return [
            new Renta([
                'cliente' => $this->getRepo(Cliente::class)->find(1),
                'vehiculo' => $vehiculo,
                'sucursal_recogida' => $this->getRepo(Sucursal::class)->find(1),
                'sucursal_devolucion' => $this->getRepo(Sucursal::class)->find(1),
                'fecha_reserva' => new \DateTime(),
                'fecha_recogida' => new \DateTime('+1 day'),
                'fecha_devolucion' => new \DateTime('+7 days'),
                'estado' => EstadoRenta::Pendiente,
                'costo' => $vehiculo->getCosto(),
                'costo_seguro' => $vehiculo->getCostoSeguro(),
                'observaciones' => 'Prueba de renta de vehículo',
            ]),
        ];
    }
}