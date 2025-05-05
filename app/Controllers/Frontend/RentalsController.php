<?php

namespace App\Controllers\Frontend;

use App\Config\Auth;
use App\Entities\Renta;

class RentalsController extends BaseController
{
    protected ?string $entity = Renta::class;

    public function index(): string
    {
        Auth::checkLogin();

        if (Auth::user()->isAdmin() === false)
            return $this->renderView(404);

        $repo = $this->getRepo();
        $rentals = $repo->findAll();

        return $this->renderView(
            'rentals/index',
            [
                'title' => 'Rentas',
                'rentals' => $rentals,
            ]
        );
    }
}