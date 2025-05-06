<?php

namespace App\Controllers\Frontend;

use App\Entities\CategoriaVehiculo;
use App\Entities\Sucursal;

class VehiclesController extends BaseController
{
    public function index(): string
    {
        $categories = $this->getRepo(CategoriaVehiculo::class)->findAll();
        $branches = $this->getRepo(Sucursal::class)->findAll();

        return $this->renderView(
            'vehicles/index',
            [
                'title' => 'Vehículos',
                'categories' => $categories,
                'branches' => $branches
            ]
        );
    }
}