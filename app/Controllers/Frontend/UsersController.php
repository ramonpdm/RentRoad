<?php

namespace App\Controllers\Frontend;

use App\Config\Auth;

class UsersController extends BaseController
{
    public function profile(): string
    {
        Auth::checkLogin();

        return $this->renderView(
            'people/profile',
            [
                'title' => 'Mi Perfil',
                'user' => Auth::user(),
            ]
        );
    }
}