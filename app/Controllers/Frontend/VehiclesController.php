<?php

namespace App\Controllers\Frontend;

use App\Entities\CategoriaVehiculo;
use App\Repositories\VehiclesRepo;

class VehiclesController extends BaseController
{
    public function index(): string
    {
        /** @var VehiclesRepo $repo */
        $repo = $this->getRepo(CategoriaVehiculo::class);
        $categories = $repo->findAll();

        return $this->renderView(
            'vehicles/index',
            [
                'title' => 'Vehículos',
                'categories' => $categories
            ]
        );
    }
}