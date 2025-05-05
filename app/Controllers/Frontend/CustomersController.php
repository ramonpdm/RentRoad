<?php

namespace App\Controllers\Frontend;

use App\Config\Auth;
use App\Entities\Cliente;

class CustomersController extends BaseController
{
    public function view($id): string
    {
        Auth::checkLogin();

        if (
            empty($id)
            or !is_numeric($id)
            or Auth::user()->isAdmin() === false
        )
            return $this->renderView(404);

        $repo = $this->getRepo(Cliente::class);
        $customer = $repo->find($id);

        return $this->renderView(
            'people/profile',
            [
                'title' => 'Mi Perfil',
                'user' => $customer
            ]
        );
    }
}