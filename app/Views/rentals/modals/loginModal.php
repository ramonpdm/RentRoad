<?php $redirectUrl = urlencode($_SERVER['REQUEST_URI']); ?>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true"
     data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <div class="p-4">
                    <h1 class="modal-title fs-5" id="loginModalLabel">
                        ¿Quieres rentar un vehículo?
                        <a href="/login?redirectUrl=<?= $redirectUrl ?>">Inicia sesión</a> o <a href="/register">crea una cuenta</a>
                        para continuar.
                    </h1>
                </div>
                <div class="pb-4">
                    <a href="/login?redirectUrl=<?= $redirectUrl ?>" class="btn btn-primary">Iniciar Sesión</a>
                    <a href="/register?redirectUrl=<?= $redirectUrl ?>" class="btn btn-secondary">Crear Cuenta</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        const element = document.getElementById('loginModal');
        const instance = new bootstrap.Modal(element)
        instance.show()
    });
</script>