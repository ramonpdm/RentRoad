<?php

use App\Entities\Sucursal;

include APP_VIEWS_DIR . '/inc/header.php';

/** @var Sucursal[] $branches */ ?>
<div class="hero inner-page" style="background-image: url('/public/images/hero_1_a.jpg');">
    <div class="container">
        <div class="row align-items-end ">
            <div class="col-lg-5">
                <div class="intro">
                    <h1><strong>Sucursales</strong></h1>
                    <div class="custom-breadcrumbs"><a href="/">Inicio</a> <span class="mx-2">/</span>
                        <strong>Sucursales</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="branches-section" class="site-section bg-light">
    <div class="container">
        <div id="branches-list" class="row">
            <div class="col">
                <div class="card card-body">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Ciudad</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Aeropuerto</th>
                                <th>Horario</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($branches as $branch): ?>
                                <tr>
                                    <td><?= $branch->nombre ?></td>
                                    <td><?= $branch->direccion ?></td>
                                    <td><?= $branch->ciudad ?></td>
                                    <td><?= $branch->telefono ?></td>
                                    <td><?= $branch->email ?></td>
                                    <td><?= $branch->aeropuerto_asociado ?></td>
                                    <td>
                                        <?= $branch->horario_apertura->format('g:i A') ?> - <?= $branch->horario_cierre->format('g:i A') ?>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <i class="bi bi-trash text-danger pointer delete-btn"></i>
                                        </div>
                                    </td>
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
