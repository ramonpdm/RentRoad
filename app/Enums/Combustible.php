<?php

namespace App\Enums;

enum Combustible: string
{
    case Gasolina = 'Gasolina';
    case Diesel = 'Diesel';
    case Hibrido = 'Híbrido';
    case Electrico = 'Eléctrico';
}