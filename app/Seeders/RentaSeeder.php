<?php

namespace App\Seeders;

use DateTime;
use App\Entities\Cliente;
use App\Entities\Renta;
use App\Entities\Sucursal;
use App\Entities\Vehiculo;
use App\Enums\EstadoRenta;

class RentaSeeder extends BaseSeeder
{
    public function data(): array
    {
        /** @var Vehiculo $vehiculo1 */
        $vehiculo1 = $this->getRepo(Vehiculo::class)->find(1);
        $vehiculo2 = $this->getRepo(Vehiculo::class)->find(2);

        return [
            new Renta([
                'cliente' => $this->getRepo(Cliente::class)->find(1),
                'vehiculo' => $vehiculo1,
                'sucursal_recogida' => $this->getRepo(Sucursal::class)->find(1),
                'sucursal_devolucion' => $this->getRepo(Sucursal::class)->find(1),
                'fecha_reserva' => new DateTime(),
                'fecha_recogida' => new DateTime('+1 day'),
                'fecha_devolucion' => new DateTime('+7 days'),
                'estado' => EstadoRenta::PendientePago,
                'costo' => $vehiculo1->getCosto(),
                'costo_seguro' => $vehiculo1->getCostoSeguro(),
                'observaciones' => 'Prueba de renta de vehículo',
            ]),
            new Renta([
                'cliente' => $this->getRepo(Cliente::class)->find(2),
                'vehiculo' => $vehiculo2,
                'sucursal_recogida' => $this->getRepo(Sucursal::class)->find(2),
                'sucursal_devolucion' => $this->getRepo(Sucursal::class)->find(1),
                'fecha_reserva' => new DateTime(),
                'fecha_recogida' => new DateTime('+1 day'),
                'fecha_devolucion' => new DateTime('+3 days'),
                'estado' => EstadoRenta::PendientePago,
                'costo' => $vehiculo2->getCosto(),
                'costo_seguro' => $vehiculo2->getCostoSeguro(),
                'observaciones' => 'Prueba de renta de vehículo',
            ]),
        ];
    }
}