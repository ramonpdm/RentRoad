<?php

namespace App\Controllers\Backend;

use App\Entities\CategoriaVehiculo;
use App\Entities\Sucursal;
use App\Entities\Vehiculo;
use App\Enums\Combustible;
use App\Enums\Transmision;
use App\Repositories\VehiclesRepo;

class VehiclesController extends APIController
{
    public function findAll(): string
    {
        /** @var VehiclesRepo $repo */
        $repo = $this->getRepo(Vehiculo::class);
        $data = array_map(
            function (Vehiculo $v) {
                return [
                    ...$v->toArray(),
                    'costo' => $v->getCosto(),
                    'costo_seguro' => $v->getCostoSeguro(),
                ];
            },
            $repo->findAll()
        );

        return $this->sendOutput(['data' => $data]);
    }

    public function insert(): string
    {
        $request = $_POST;

        $categoriesRepo = $this->getRepo(CategoriaVehiculo::class);
        $categoria = $categoriesRepo->find($request['categoria_id']);
        $categoria instanceof CategoriaVehiculo or throw new \HttpException(404, 'Categoria no encontrada');

        $branchesRepo = $this->getRepo(Sucursal::class);
        $sucursal = $branchesRepo->find($request['sucursal_id']);
        $sucursal instanceof Sucursal or throw new \HttpException(404, 'Sucursal no encontrada');

        $vehicle = new Vehiculo();
        $vehicle->categoria = $categoria;
        $vehicle->marca = $request['marca'];
        $vehicle->modelo = $request['modelo'];
        $vehicle->ano = $request['año'];
        $vehicle->placa = $request['placa'];
        $vehicle->color = $request['color'];
        $vehicle->kilometraje = $request['kilometraje'];
        $vehicle->capacidad_pasajeros = $request['capacidad_pasajeros'];
        $vehicle->capacidad_maletero = $request['capacidad_maletero'];
        $vehicle->transmision = Transmision::tryFrom($request['transmision']);
        $vehicle->combustible = Combustible::tryFrom($request['combustible']);
        $vehicle->sucursal = $sucursal;
        $vehicle->imagen_url = $request['imagen_url'];

        // Save the vehicle to the database
        $this->getOrm()->persist($vehicle);
        $this->getOrm()->flush();
        return $this->sendOutput(['message' => 'Vehicle created successfully']);
    }

    public function delete($id): string
    {
        /** @var VehiclesRepo $repo */
        $repo = $this->getRepo(Vehiculo::class);
        $vehicle = $repo->find($id);

        if ($vehicle) {
            $this->getOrm()->remove($vehicle);
            $this->getOrm()->flush();
            return $this->sendOutput(['message' => 'Vehicle deleted successfully']);
        } else {
            return $this->sendOutput(['message' => 'Vehicle not found'], 404);
        }
    }
}