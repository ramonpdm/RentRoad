<?php include APP_VIEWS_DIR . '/inc/header.php'; ?>

<?php if (\App\Config\Auth::isLogged() === false) : ?>
    <?php include 'modals/loginModal.php'; ?>
<?php endif ?>

<div class="hero inner-page" style="background-image: url('/public/images/hero_1_a.jpg');">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-5">
                <div class="intro">
                    <h1><strong>Rentar Vehículo</strong></h1>
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
        <h2>Detalles de la Renta</h2>
        <p>Gracias por elegir RentRoad. Por favor, complete el formulario para continuar con la renta del vehículo.</p>
        <form method="post" action="/confirmation">
            <div class="form-group">
                <label for="nombre">Nombre Completo:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fecha_fin">Fecha de Fin:</label>
                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Confirmar Renta</button>
        </form>
    </div>
</div>

<?php include APP_VIEWS_DIR . '/inc/footer.php'; ?>
