<?php

namespace App\Enums;

enum EstadoRenta: string
{
    case Pendiente = 'Pendiente';
    case Confirmada = 'Confirmada';
    case EnCurso = 'En curso';
    case Completada = 'Completada';
    case Cancelada = 'Cancelada';
}