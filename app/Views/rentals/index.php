<?php

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

        <div class="row">
            <div class="col-md-12">
                <div>
                    <h2 class="h3 mb-3 text-black">Rentas</h2>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <input type="search" class="form-control" placeholder="Buscar Renta..." id="searchRentalInput">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="button" id="searchRentalButton">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div id="rentas-list" class="row">
            <div class="col">
                <div class="card card-body">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Vehículo</th>
                                <th>Recogida</th>
                                <th>Reserva</th>
                                <th>Estado</th>
                                <th>Seguro</th>
                                <th>Total</th>
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rentals as $renta): ?>
                                <tr>
                                    <td>
                                        <a href="/customers/<?= $renta->cliente->id ?>">
                                            <i class="bi bi-person-circle"></i>
                                            <?= $renta->cliente->getNombreCompleto() ?>
                                        </a>
                                    </td>
                                    <td><i class="bi bi-car-front"></i>
                                        <?= $renta->vehiculo->modelo ?></td>
                                    <td><?= $renta->sucursal_recogida->nombre ?></td>
                                    <td>
                                        <?= $renta->fecha_reserva->format('d/m/Y') ?>
                                        (<?= $renta->getDiasRenta() ?> días)
                                    </td>
                                    <td><?= $renta->estado->value ?></td>
                                    <td><?= $renta->seguro ? '$' . number_format($renta->costo_seguro, 2) : 'No' ?></td>
                                    <td>$<?= number_format($renta->getCostoTotal(), 2) ?></td>
                                    <td><?= $renta->observaciones ?? 'Ninguna' ?></td>
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
