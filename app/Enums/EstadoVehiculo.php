<?php

namespace App\Enums;

enum EstadoVehiculo: string
{
    case Disponible = 'Disponible';
    case Alquilado = 'Alquilado';
    case Mantenimiento = 'Mantenimiento';
    case FueraDeServicio = 'Fuera de servicio';
}