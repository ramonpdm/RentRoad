<?php

namespace App\Enums;

enum TipoTarifa: string
{
    case Economica = 'Económica';
    case Premium = 'Premium';
    case Lujo = 'Lujo';
}