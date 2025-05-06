<?php

use App\Entities\Vehiculo;

include APP_VIEWS_DIR . '/inc/header.php';
/** @var Vehiculo $branches */
/** @var Vehiculo $vehicle */ ?>

<?php if (\App\Config\Auth::isLogged() === false) : ?>
    <?php include 'modals/loginModal.php'; ?>
<?php endif ?>

<div class="hero inner-page" style="background-image: url('/public/images/hero_1_a.jpg');">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-5">
                <div class="intro">
                    <h1>Rentar <strong class="text-primary"><?= $vehicle->getNombre() ?></strong></h1>
                    <div class="custom-breadcrumbs">
                        <a href="/">Inicio</a> <span class="mx-2">/</span> <strong>Rentar Vehículo</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="listing d-block align-items-stretch mt-4">
                    <div class="listing-img h-100 mr-4">
                        <img src="<?= $vehicle->imagen_url ?>" alt="Image" class="img-fluid">
                    </div>
                    <div class="listing-contents h-100">
                        <h2><?= $vehicle->getNombre() ?> <?= $vehicle->ano ?></h2>
                        <table class="table table-borderless mb-3">
                            <tbody>
                                <tr>
                                    <td>Color</td>
                                    <td><?= $vehicle->color ?></td>
                                </tr>
                                <tr>
                                    <td>Transmisión</td>
                                    <td><?= $vehicle->transmision ?></td>
                                </tr>
                                <tr>
                                    <td>Combustible</td>
                                    <td><?= $vehicle->combustible->name ?></td>
                                </tr>
                                <tr>
                                    <td>Pasajeros</td>
                                    <td><?= $vehicle->capacidad_pasajeros ?></td>
                                </tr>
                                <tr>
                                    <td>Maletero</td>
                                    <td><?= $vehicle->capacidad_maletero ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col">
                <h2>Detalles de la Renta</h2>
                <p>Gracias por elegir RentRoad. Por favor, complete el formulario para continuar con la renta del vehículo.</p>
                <form method="post" action="/rentals/confirmation">
                    <input type="hidden" name="vehicle_id" value="<?= $vehicle->id ?>">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="tarifa">Tarifa</label>
                            <input id="tarifa" class="form-control" value="US$<?= number_format($vehicle->getCosto(), 2) ?>/día" disabled>
                        </div>
                        <div class="col">
                            <label for="seguro">Seguro</label>
                            <input id="seguro" class="form-control" value="US$<?= number_format($vehicle->getCostoSeguro(), 2) ?>" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="fecha_inicio">Fecha de Inicio:</label>
                            <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="fecha_fin">Fecha de Fin:</label>
                            <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="sucursal_recogida">Sucursal de Recogida:</label>
                            <select id="sucursal_recogida" name="sucursal_recogida_id" class="form-control" required>
                                <option value="" disabled selected>Seleccione una sucursal</option>
                                <?php foreach ($branches as $branch) : ?>
                                    <option value="<?= $branch->id ?>"><?= $branch->nombre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="sucursal_devolucion">Sucursal de Devolución:</label>
                            <select id="sucursal_devolucion" name="sucursal_devolucion_id" class="form-control" required>
                                <option value="" disabled selected>Seleccione una sucursal</option>
                                <?php foreach ($branches as $branch) : ?>
                                    <option value="<?= $branch->id ?>"><?= $branch->nombre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary w-100">Confirmar Renta</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include APP_VIEWS_DIR . '/inc/footer.php'; ?>
