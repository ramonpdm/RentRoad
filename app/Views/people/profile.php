<?php include APP_VIEWS_DIR . '/inc/header.php';

use App\Config\Auth;
use App\Entities\Cliente;
use App\Entities\Usuario;

/** @var Cliente|Usuario $user */ ?>

<div class="hero inner-page" style="background-image: url('/public/images/hero_1_a.jpg');">
    <div class="container">
        <div class="row align-items-end ">
            <div class="col-lg-5">
                <div class="intro">
                    <?php if ($user->id === Auth::user()->id && $user->isCustomer() === Auth::user()->isCustomer()): ?>
                        <h1>Bienvenido,
                            <strong class="text-primary"><?= $user->nombre ?></strong>
                        </h1>
                        <div class="custom-breadcrumbs"><a href="/">Inicio</a> <span class="mx-2">/</span>
                            <strong>Perfil</strong>
                        </div>
                    <?php else: ?>
                        <h1>Perfil de <strong class="text-primary"><?= $user->nombre ?></strong></h1>
                        <div class="custom-breadcrumbs"><a href="/">Inicio</a> <span class="mx-2">/</span>
                            <strong><?= $user->isCustomer() ? 'Cliente' : 'Empleado' ?></strong>
                        </div>
                    <?php endif; ?>
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
                <form id="profile-form" method="POST">
                    <input type="hidden" name="id" value="<?= $user->id ?>">
                    <input type="hidden" name="tipo" value="<?= $user->isCustomer() ? 'cliente' : 'empleado' ?>">
                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label for="nombre"><strong>Nombre:</strong></label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="<?= $user->nombre ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellido"><strong>Apellido:</strong></label>
                            <input type="text" id="apellido" name="apellido" class="form-control" value="<?= $user->apellido ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col">
                            <label for="email"><strong>Email:</strong></label>
                            <input type="email" id="email" name="email" class="form-control" value="<?= $user->email ?>" required>
                        </div>
                        <div class="form-group col">
                            <label for="telefono"><strong>Teléfono:</strong></label>
                            <input type="text" id="telefono" name="telefono" class="form-control" value="<?= $user->telefono ?>">
                        </div>
                        <?php if ($user->isCustomer()): ?>
                            <div class="form-group col">
                                <label for="direccion"><strong>Dirección:</strong></label>
                                <textarea id="direccion" name="direccion" class="form-control"><?= $user->direccion ?></textarea>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($user->isAdmin()): ?>
                        <div class="row mb-3">
                            <div class="form-group col-md-6">
                                <label for="sucursal"><strong>Sucursal:</strong></label>
                                <input type="text" id="sucursal" class="form-control disabled" value="<?= $user->sucursal?->nombre ?>" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="role"><strong>Rol:</strong></label>
                                <input type="text" id="role" class="form-control disabled" value="<?= $user->rol->nombre ?>" disabled>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row mb-3">
                        <div class="form-group col-md-6">
                            <label for="fecha_nacimiento"><strong>Fecha de Nacimiento:</strong></label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" value="<?= $user->fecha_nacimiento?->format('Y-m-d') ?>">
                        </div>
                        <?php if ($user->isAdmin()): ?>
                            <div class="form-group col-md-6">
                                <label for="fecha_contratacion"><strong>Fecha de Contratación:</strong></label>
                                <input type="date" id="fecha_contratacion" name="fecha_contratacion" class="form-control" value="<?= $user->fecha_contratacion?->format('Y-m-d') ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('profile-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(form);
            const url = `/api/v1/people/<?= $user->id ?>`;

            fetch(url, {method: 'PUT', body: formData})
                .then(response => {
                    if (response.ok) {
                        alert('Perfil actualizado con éxito.');
                    } else {
                        alert('Error al actualizar el perfil: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
</script>

<?php include APP_VIEWS_DIR . '/inc/footer.php'; ?>
