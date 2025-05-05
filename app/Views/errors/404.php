<?php include APP_DIR . '/Views/inc/header.php'; ?>
<style>
    .error-container {
        height: 90vh;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .error-code h1 {
        font-size: 10rem;
    }

    .error-code h3 {
        font-size: 80px;
    }
</style>
<section class="error-container">
    <div class="row">
        <div class="col text-center">
            <?php
            /** @var Throwable $exception */

            // If actual environment is 'development', display PHP errors
            if (isset($exception)) : ?>
                <p class="text-danger">
                    <?= $exception->getMessage() ?>
                </p>
                <pre class="text-muted"><?= $exception->getTraceAsString() ?></pre>
            <?php else: ?>
                <div class="error-code">
                    <h1>404</h1>
                </div>
                <div class="error-description">
                    <h3 class="h2">
                        ¡Parece que estás perdido!
                    </h3>
                    <p>La página que estás buscando no existe o ha sido eliminada.</p>
                    <a href="/" class="btn btn-primary">Volver al Inicio</a>
                </div>

            <?php endif ?>
        </div>
    </div>
</section>
<?php include APP_DIR . '/Views/inc/footer.php'; ?>
