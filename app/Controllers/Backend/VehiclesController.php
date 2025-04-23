<?php

namespace App\Controllers\Backend;

use App\Entities\Vehiculo;
use App\Repositories\VehiclesRepo;

class VehiclesController extends APIController
{
    public function findAll(): string
    {
        /** @var VehiclesRepo $repo */
        $repo = $this->getRepo(Vehiculo::class);
        $data = $repo->findAll();
        return $this->sendOutput(['data' => $data]);
    }
}