<?php

namespace App\Controllers\Frontend;

use Throwable;
use App\Config\Auth;
use App\Services\AuthService;
use App\Entities\Cliente;
use App\Entities\Usuario;

class AuthController extends BaseController
{
    public function login(): string
    {
        if (Auth::isLogged())
            return $this->redirect('/vehicles');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $response = [
                'error' => false,
                'message' => 'Inicio de sesión exitoso! Redirigiendo...'
            ];

            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            try {
                $class = $_POST['type'] === 'customer' ? Cliente::class : Usuario::class;
                AuthService::login($email, $password, $class);
            } catch (Throwable $e) {
                $response = [
                    'error' => true,
                    'message' => $e->getMessage()
                ];
            }
        }

        return $this->renderView('auth/login', data: $response ?? []);
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: /login');
    }

    private function redirectBasedOnRole($rolId): void
    {
        switch ($rolId) {
            case ROL_ADMIN:
                header('Location: /admin/dashboard');
                break;
            case ROL_EMPLEADO:
                header('Location: /empleado/dashboard');
                break;
            case ROL_CLIENTE:
                header('Location: /home');
                break;
            default:
                header('Location: /home');
        }
    }

    public function register(): string
    {
        return $this->renderView('auth/register');
    }
}