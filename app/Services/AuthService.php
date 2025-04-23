<?php

namespace App\Services;

use App\Config\Application;
use App\Config\Auth;
use App\Entities\Usuario;
use App\Exceptions\Exception;

class AuthService
{
    public function __construct()
    {
        throw new \Exception('No se puede instanciar AuthService directamente. Usar solo de manera estática.');
    }

    public static function login($email, $password): void
    {
        $usersRepo = Application::getOrm()->getRepo(Usuario::class);
        $user = $usersRepo->findOneBy(['email' => $email]);

        if (
            !$user instanceof Usuario
            || !$user->activo
            || !password_verify($password, $user->password)
        )
            throw new Exception('Usuario y/o contraseña incorrectos');

        $_SESSION['user'] = [
            'id' => $user->id,
            'nombre' => $user->nombre,
            'apellido' => $user->apellido,
        ];
    }
}