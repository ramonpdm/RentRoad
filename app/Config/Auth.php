<?php

namespace App\Config;

use App\Entities\Usuario;

class Auth
{
    public static function user(): ?Usuario
    {
        $userId = $_SESSION['user']['id'] ?? null;

        if ($userId === null)
            return null;

        $user = Application::getOrm()->getRepo(Usuario::class)
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