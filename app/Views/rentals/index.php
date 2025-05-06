<?php

use App\Config\Auth;
use App\Entities\Renta;

include APP_VIEWS_DIR . '/inc/header.php';


/** @var Renta[] $rentals */

?>
<div class="hero inner-page" style="background-image: url('/public/images/hero_1_a.jpg');">
    <div class="container">
        <div class="row align-items-end ">
            <div class="col-lg-5">

                <div class="intro">
                    <h1><strong>Rentas</strong></h1>
                    <div class="custom-breadcrumbs"><a href="/">Inicio</a> <span class="mx-2">/</span>
                        <strong>Rentas</strong>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div id="rentas-section" class="site-section bg-light">
    <div class="container">
        <div id="rentas-list" class="row">
            <div class="col">
                <div class="card card-body">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <?php if (Auth::user()->isAdmin()): ?>
                                    <th>Cliente</th>
                                <?php endif ?>
                                <th>Vehículo</th>
                                <th>Recogida</th>
                                <th>Reserva</th>
                                <th>Seguro</th>
                                <th>Total</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rentals as $renta): ?>
                                <tr>
                                    <?php if (Auth::user()->isAdmin()): ?>
                                        <td>
                                            <a href="/customers/<?= $renta->cliente->id ?>">
                                                <i class="bi bi-person-circle"></i>
                                                <?= $renta->cliente->getNombreCompleto() ?>
                                            </a>
                                        </td>
                                    <?php endif ?>
                                    <td><i class="bi bi-car-front"></i>
                                        <?= $renta->vehiculo->getNombre() ?></td>
                                    <td><?= $renta->sucursal_recogida->nombre ?></td>
                                    <td>
                                        <?= $renta->fecha_reserva->format('d/m/Y') ?>
                                    </td>
                                    <td><?= $renta->costo_seguro ? 'US$' . number_format($renta->costo_seguro, 2) : 'No' ?></td>
                                    <td>US$<?= number_format($renta->getCostoTotal(), 2) ?> x <?= $renta->getDiasRenta() ?> días</td>
                                    <td><?= $renta->estado->value ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include APP_VIEWS_DIR . '/inc/footer.php'; ?>
