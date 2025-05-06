<?php

namespace App\Controllers\Frontend;

use DateTime;
use App\Config\Auth;
use App\Config\Routes;
use App\Entities\Renta;
use App\Entities\Sucursal;
use App\Entities\Vehiculo;

class RentalsController extends BaseController
{
    protected ?string $entity = Renta::class;

    public function index(): string
    {
        Auth::checkLogin();

        $repo = $this->getRepo();

        if (Auth::user()->isAdmin())
            $rentals = $repo->findAll();
        else
            $rentals = $repo->findBy(['cliente' => Auth::user()]);

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

    public function confirmation(): string
    {
        if (
            Routes::isPOST() === false
            || Auth::isLogged() === false
            || Auth::user()->isCustomer() === false
        ) {
            return $this->renderView(404);
        }

        $customer = Auth::user();
        $vehicleId = $_POST['vehicle_id'] ?? null;
        $fechaInicio = $_POST['fecha_inicio'] ?? null;
        $fechaFin = $_POST['fecha_fin'] ?? null;
        $sucursalRecogida = $_POST['sucursal_recogida_id'] ?? null;
        $sucursalDevolucion = $_POST['sucursal_devolucion_id'] ?? null;

        $vehicle = $this->getRepo(Vehiculo::class)->find($vehicleId);
        $pickupBranch = $this->getRepo(Sucursal::class)->find($sucursalRecogida);
        $returnBranch = $this->getRepo(Sucursal::class)->find($sucursalDevolucion);

        $vehicle instanceof Vehiculo or throw new \Exception('Vehículo no encontrado');
        $pickupBranch instanceof Sucursal or throw new \Exception('Sucursal de recogida no encontrada');
        $returnBranch instanceof Sucursal or throw new \Exception('Sucursal de devolución no encontrada');

        $rental = new Renta([
            'cliente' => $customer,
            'vehiculo' => $vehicle,
            'sucursal_recogida' => $pickupBranch,
            'sucursal_devolucion' => $returnBranch,
            'fecha_reserva' => new DateTime(),
            'fecha_recogida' => new DateTime($fechaInicio),
            'fecha_devolucion' => new DateTime($fechaFin),
            'costo' => $vehicle->getCosto(),
            'costo_seguro' => $vehicle->getCostoSeguro(),
        ]);

        $this->getOrm()->persist($rental);
        $this->getOrm()->flush();

        return $this->renderView('rentals/confirmation');
    }
}