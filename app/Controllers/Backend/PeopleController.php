<?php

namespace App\Controllers\Backend;

use App\Entities\Cliente;
use App\Entities\Usuario;

class PeopleController extends APIController
{
    public function update($id): string
    {
        $request = $_POST;
        $type = $request['tipo'] ?? null;
        $className = $type === 'cliente' ? Cliente::class : Usuario::class;

        $customer = $this->getRepo($className)->find($id);

        if ($customer instanceof $className) {
            $customer->handleUpdate($request);
            $this->getOrm()->flush();
            return $this->sendOutput(['message' => 'Cuenta actualizada correctamente']);
        } else {
            return $this->sendOutput(['message' => 'La cuenta no existe'], 404);
        }
    }
}