<?php

namespace App\Services;

use App\Config\Application;
use App\Entities\Usuario;
use App\Exceptions\Exception;

class AuthService
{
    public function __construct()
    {
        throw new \Exception('No se puede instanciar AuthService directamente. Usar solo de manera estática.');
    }

    public static function login($email, $password, $class): void
    {
        $usersRepo = Application::getOrm()->getRepo($class);
        $user = $usersRepo->findOneBy(['email' => $email]);

        if (
            !$user instanceof $class
            || !$user->activo
            || !password_verify($password, $user->password)
        )
            throw new Exception('Usuario y/o contraseña incorrectos');

        $session = [
            'id' => $user->id,
            'nombre' => $user->nombre,
            'apellido' => $user->apellido,
        ];

        if ($user instanceof Usuario) {
            $session['rol'] = [
                'id' => $user->rol->id,
                'nombre' => $user->rol->nombre,
            ];
        }

        $_SESSION['user'] = $session;
    }
}