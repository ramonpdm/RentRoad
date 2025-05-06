<?php

namespace App\Controllers\Backend;

use App\Entities\Cliente;

class CustomersController extends APIController
{
    protected ?string $entity = Cliente::class;

    public function delete($id): string
    {
        $customer = $this->getRepo()->find($id);

        if ($customer instanceof Cliente) {
            $customer->activo = false;
            $this->getOrm()->flush();
            return $this->sendOutput(['message' => 'Cliente eliminado correctamente']);
        } else {
            return $this->sendOutput(['message' => 'El cliente no existe'], 404);
        }
    }
}