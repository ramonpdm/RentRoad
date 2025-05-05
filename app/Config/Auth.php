<?php

namespace App\Config;

use App\Entities\Cliente;
use App\Entities\Persona;
use App\Entities\Usuario;

class Auth
{
    public static function user(): ?Persona
    {
        $userId = $_SESSION['user']['id'] ?? null;
        $roleName = $_SESSION['user']['rol']['nombre'] ?? null;
        $className = $roleName === null ? Cliente::class : Usuario::class;

        if ($userId === null)
            return null;

        $user = Application::getOrm()->getRepo($className)
            ->find($userId);

        if ($user === null) {
            unset($_SESSION['user']);
            return null;
        } else {
            return $user;
        }
    }

    public static function isLogged(): bool
    {
        return self::user() !== null;
    }

    public static function checkLogin(): void
    {
        if (!self::isLogged()) {
            header('Location: /login');
            exit();
        }
    }

    public static function handle($requiredRoles = []): void
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /login');
            exit();
        }

        if (!empty($requiredRoles) && !in_array($_SESSION['usuario']['rol'], $requiredRoles)) {
            header('Location: /errors/403');
            exit();
        }
    }
}