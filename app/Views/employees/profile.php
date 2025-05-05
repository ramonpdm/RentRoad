<?php include APP_VIEWS_DIR . '/inc/header.php';

use App\Entities\Usuario;

/** @var Usuario $user */ ?>

<div class="hero inner-page" style="background-image: url('/public/images/hero_1_a.jpg');">
    <div class="container">
        <div class="row align-items-end ">
            <div class="col-lg-5">
                <div class="intro">
                    <h1>Bienvenido,
                        <strong style="color: #007bff"><?= $user->nombre ?></strong>
                    </h1>
                    <div class="custom-breadcrumbs"><a href="index.html">Inicio</a> <span class="mx-2">/</span>
                        <strong>Perfil</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="vehicles-section" class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Información del Perfil</h2>
                <form method="post" action="/update-profile">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombre"><strong>Nombre:</strong></label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="<?= $user->nombre ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellido"><strong>Apellido:</strong></label>
                            <input type="text" id="apellido" name="apellido" class="form-control" value="<?= $user->apellido ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email"><strong>Email:</strong></label>
                            <input type="email" id="email" name="email" class="form-control" value="<?= $user->email ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password"><strong>Contraseña:</strong></label>
                            <input type="password" id="password" name="password" class="form-control" value="<?= $user->password ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="telefono"><strong>Teléfono:</strong></label>
                            <input type="text" id="telefono" name="telefono" class="form-control" value="<?= $user->telefono ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="direccion"><strong>Dirección:</strong></label>
                            <textarea id="direccion" name="direccion" class="form-control"><?= $user->direccion ?></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="sucursal"><strong>Sucursal:</strong></label>
                            <input type="text" id="sucursal" class="form-control disabled" value="<?= $user->sucursal?->nombre ?>" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="role"><strong>Rol:</strong></label>
                            <input type="text" id="role" class="form-control disabled" value="<?= $user->rol->nombre ?>" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fecha_nacimiento"><strong>Fecha de Nacimiento:</strong></label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" value="<?= $user->fecha_nacimiento?->format('Y-m-d') ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fecha_contratacion"><strong>Fecha de Contratación:</strong></label>
                            <input type="date" id="fecha_contratacion" name="fecha_contratacion" class="form-control" value="<?= $user->fecha_contratacion?->format('Y-m-d') ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include APP_VIEWS_DIR . '/inc/footer.php'; ?>
