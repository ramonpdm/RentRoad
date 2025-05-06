<?php

namespace App\Enums;

enum EstadoRenta: string
{
    case PendientePago = 'Pendiente de Pago';
    case Confirmada = 'Confirmada';
    case EnCurso = 'En curso';
    case Completada = 'Completada';
    case Cancelada = 'Cancelada';
}