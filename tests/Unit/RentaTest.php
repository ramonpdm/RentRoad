<?php

declare(strict_types=1);

namespace Tests\Unit;

use DateTime;
use Tests\Utils\TestCase;
use App\Entities\Renta;

class RentaTest extends TestCase
{
    public function testGetDiasRenta(): void
    {
        // Preparar: renta con fechas de recogida y devolución
        $renta = new Renta();
        $renta->fecha_recogida = new DateTime('2025-01-01');
        $renta->fecha_devolucion = new DateTime('2025-01-05');

        // Acto: calcular días de renta
        $dias = $renta->getDiasRenta();

        // Afirmaciones: debe ser un entero y coincidir con 4 días
        $this->assertIsInt($dias);
        $this->assertSame(4, $dias);
    }

    public function testGetCostoTotal(): void
    {
        // Preparar: renta con fechas y costos definidos
        $renta = new Renta();
        $renta->fecha_recogida = new DateTime('2025-02-01');
        $renta->fecha_devolucion = new DateTime('2025-02-04');
        $renta->costo = 100.0;
        $renta->costo_seguro = 25.5;

        // Acto: calcular costo total
        $total = $renta->getCostoTotal();

        // Afirmaciones: tipo y valor esperado
        $esperado = (100.0 * 3) + 25.5;
        $this->assertIsFloat($total);
        $this->assertEquals($esperado, $total);
    }
}
