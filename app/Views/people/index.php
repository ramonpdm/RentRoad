<?php

use App\Entities\Cliente;

include APP_VIEWS_DIR . '/inc/header.php';

/** @var Cliente[] $users */ ?>
<div class="hero inner-page" style="background-image: url('/public/images/hero_1_a.jpg');">
    <div class="container">
        <div class="row align-items-end ">
            <div class="col-lg-5">
                <div class="intro">
                    <h1><strong>Clientes</strong></h1>
                    <div class="custom-breadcrumbs"><a href="/">Inicio</a> <span class="mx-2">/</span>
                        <strong>Clientes</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="users-section" class="site-section bg-light">
    <div class="container">

        <div id="users-list" class="row">
            <div class="col">
                <div class="card card-body">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Licencia</th>
                                <th>Fecha Nacimiento</th>
                                <th>Fecha Creación</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td>
                                        <a href="/customers/<?= $user->id ?>">
                                            <i class="bi bi-person"></i> <?= $user->getNombreCompleto() ?>
                                        </a>
                                    </td>
                                    <td><?= $user->email ?></td>
                                    <td><?= $user->telefono ?></td>
                                    <td><?= $user->licencia_conducir ?></td>
                                    <td><?= $user->fecha_nacimiento->format('d/m/Y') ?></td>
                                    <td><?= $user->fecha_creacion->format('d/m/Y') ?></td>
                                    <td>
                                        <?php if ($user->activo): ?>
                                            <span class="badge bg-success">Activo</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inactivo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <i class="bi bi-trash text-danger pointer delete-btn" data-id="<?= $user->id ?>"
                                           data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"></i>
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

<script type="application/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');
                if (confirm('¿Estás seguro de que deseas eliminar este cliente?')) {
                    fetch(`/api/v1/customers/${userId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                        .then(response => {
                            if (response.ok) {
                                location.reload();
                            } else {
                                alert('Error al eliminar el cliente');
                            }
                        });
                }
            });
        });
    });
</script>

<?php include APP_VIEWS_DIR . '/inc/footer.php'; ?>
