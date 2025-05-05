<?php

namespace App\Seeders;

use App\Entities\Rol;

class RolSeeder extends BaseSeeder
{
    public function data(): array
    {
        return [
            new Rol(['nombre' => 'Administrador']),
            new Rol(['nombre' => 'Agente']),
        ];
    }
}