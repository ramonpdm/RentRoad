<?php

namespace App\Controllers\Frontend;

class VehiclesController extends BaseController
{
    public function index(): string
    {
        return $this->renderView('vehicles/index');
    }

}