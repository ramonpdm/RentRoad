<?php

namespace App\Controllers\Frontend;

use App\Config\Auth;
use App\Entities\Renta;
use App\Entities\Sucursal;
use App\Entities\Vehiculo;

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

    public function rent(): string
    {
        $vehicleId = $_GET['vehicle'] ?? null;

        if ($vehicleId === null) {
            return $this->redirect('/vehicles');
        }

        $vehiclesRepo = $this->getRepo(Vehiculo::class);
        $vehicle = $vehiclesRepo->find($vehicleId);

        if (!$vehicle instanceof Vehiculo) {
            return $this->renderView(404);
        }

        $branches = $this->getRepo(Sucursal::class)->findAll();

        return $this->renderView('rentals/rent', [
            'title' => 'Rentar ' . $vehicle->getNombre(),
            'vehicle' => $vehicle,
            'branches' => $branches,
        ]);
    }
}