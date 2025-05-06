<?php

namespace App\Controllers\Frontend;

use App\Config\Auth;
use App\Entities\Sucursal;

class BranchesController extends BaseController
{
    protected ?string $entity = Sucursal::class;

    public function index(): string
    {
        if (Auth::isLogged() === false)
            return $this->renderView(404);

        return $this->renderView(
            'branches/index',
            [
                'title' => 'Sucursales',
                'branches' => $this->getRepo()->findAll(),
            ]
        );
    }
}