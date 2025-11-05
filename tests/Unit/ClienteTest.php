<?php

declare(strict_types=1);

namespace Tests\Unit;

use DateTime;
use App\Entities\Cliente;
use Tests\Utils\TestCase;

class ClienteTest extends TestCase
{
    public function testLicenciaValida()
    {
        // Preparar: cliente con fecha de vencimiento hoy
        $cliente = new Cliente(['fecha_vencimiento_licencia' => new DateTime('today')]);

        // Afirmaciones: verificar si la licencia es válida
        $result = $cliente->licenciaValida();
        $this->assertIsBool($result);
        $this->assertTrue($result);

        // Preparar: cliente con fecha de vencimiento de ayer
        $cliente = new Cliente(['fecha_vencimiento_licencia' => new DateTime('yesterday')]);

        // Afirmaciones: verificar si la licencia es válida
        $result = $cliente->licenciaValida();
        $this->assertIsBool($result);
        $this->assertFalse($result);
    }
}
