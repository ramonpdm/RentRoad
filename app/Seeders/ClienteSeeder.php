<?php

namespace App\Seeders;

use DateTime;
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
                'fecha_nacimiento' => new DateTime('2002-11-02'),
                'fecha_registro' => new DateTime()->format('Y-m-d H:i:s'),
                'fecha_contratacion' => (new DateTime('2025-01-01')),
                'licencia_conducir' => '100632126',
                'fecha_vencimiento_licencia' => new DateTime(),
            ]),
            new Cliente([
                'nombre' => 'Julio',
                'apellido' => 'De La Rosa',
                'email' => 'julio.delarosa@example.com',
                'password' => password_hash('1234', PASSWORD_BCRYPT),
                'telefono' => '809-123-4567',
                'direccion' => 'Calle Principal #1, Ciudad',
                'fecha_nacimiento' => new DateTime('1990-05-15'),
                'fecha_registro' => new DateTime()->format('Y-m-d H:i:s'),
                'fecha_contratacion' => (new DateTime('2025-01-01')),
                'licencia_conducir' => '100524294',
            ]),
            new Cliente([
                'nombre' => 'Edward',
                'apellido' => 'Cedano',
                'email' => 'edward.cedano@example.com',
                'password' => password_hash('1234', PASSWORD_BCRYPT),
                'telefono' => '809-234-5678',
                'direccion' => 'Calle Secundaria #2, Ciudad',
                'fecha_nacimiento' => new DateTime('1985-08-20'),
                'fecha_registro' => new DateTime()->format('Y-m-d H:i:s'),
                'fecha_contratacion' => (new DateTime('2025-01-01')),
                'licencia_conducir' => '100630954',
            ]),
            new Cliente([
                'nombre' => 'Wilfri',
                'apellido' => 'Perez',
                'email' => 'wilfri.perez@example.com',
                'password' => password_hash('1234', PASSWORD_BCRYPT),
                'telefono' => '809-345-6789',
                'direccion' => 'Avenida Central #3, Ciudad',
                'fecha_nacimiento' => new DateTime('1992-03-10'),
                'fecha_registro' => new DateTime()->format('Y-m-d H:i:s'),
                'fecha_contratacion' => (new DateTime('2025-01-01')),
                'licencia_conducir' => '100659330',
            ]),
            new Cliente([
                'nombre' => 'Yeli',
                'apellido' => 'Morillo',
                'email' => 'yeli.morillo@example.com',
                'password' => password_hash('1234', PASSWORD_BCRYPT),
                'telefono' => '809-456-7890',
                'direccion' => 'Calle Tercera #4, Ciudad',
                'fecha_nacimiento' => new DateTime('1995-07-25'),
                'fecha_registro' => new DateTime()->format('Y-m-d H:i:s'),
                'fecha_contratacion' => (new DateTime('2025-01-01')),
                'licencia_conducir' => 'DC4897',
            ])
        ];
    }
}