<?php

namespace App\Controllers\Frontend;

class AuthController extends BaseController
{
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            try {
                $usuario = $this->authService->authenticate($email, $password);
                
                $_SESSION['usuario'] = [
                    'id' => $usuario->getId(),
                    'email' => $usuario->getEmail(),
                    'rol' => $usuario->getRol()->getId()
                ];
                
                $this->redirectBasedOnRole($usuario->getRol()->getId());
                
            } catch (Exception $e) {
                $this->render('auth/login', ['error' => $e->getMessage()]);
            }
        } else {
            $this->render('auth/login');
        }
    }
    
    private function redirectBasedOnRole($rolId) {
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
        exit();
    }
    
    public function logout() {
        session_destroy();
        header('Location: /login');
        exit();
    }

    public function register(): string
    {
        return $this->renderView('auth/register');
    }
}