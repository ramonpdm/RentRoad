<?php

namespace App\Seeders;

use App\Entities\Cliente;

class ClienteSeeder extends BaseSeeder
{
    public function data(): array
    {
        return [
            new Cliente([
                'nombre' => 'Inoel',
                'apellido' => 'Perdomo',
                'email' => 'inoelperdomo@gmail.com',
                'password' => password_hash('1234', PASSWORD_BCRYPT),
                'telefono' => '809-429-1908',
                'direccion' => '123 Calle Falsa, Ciudad',
                'fecha_nacimiento' => new \DateTime('2002-11-02'),
                'fecha_registro' => (new \DateTime())->format('Y-m-d H:i:s'),
                'fecha_contratacion' => (new \DateTime('2025-01-01')),
            ])
        ];
    }
}