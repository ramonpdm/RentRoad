<?php

namespace App\Seeders;

use App\Entities\Rol;
use App\Entities\Sucursal;
use App\Entities\Usuario;

class UsuarioSeeder extends BaseSeeder
{
    const int ORDER = 3;

    public function data(): array
    {
        return [
            new Usuario([
                'nombre' => 'Ramón',
                'apellido' => 'Perdomo',
                'email' => 'inoelperdomo@gmail.com',
                'password' => password_hash('1234', PASSWORD_BCRYPT),
                'telefono' => '809-429-1908',
                'direccion' => '123 Calle Falsa, Ciudad',
                'rol' => $this->getRepo(Rol::class)->find(1),
                'sucursal' => $this->getRepo(Sucursal::class)->find(1),
                'fecha_nacimiento' => new \DateTime('2002-11-02'),
                'fecha_registro' => (new \DateTime())->format('Y-m-d H:i:s'),
                'fecha_contratacion' => (new \DateTime('2025-01-01')),
            ])
        ];
    }
}