<?php

namespace App\Controllers\Frontend;

class AuthController extends BaseController
{
    public function login(): string
    {
        return $this->renderView('auth/login');
    }

    public function register(): string
    {
        return $this->renderView('auth/register');
    }
}