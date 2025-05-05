<?php include APP_VIEWS_DIR . '/inc/header.php'; ?>
<div class="site-wrap">
    <div class="hero" style="background-image: url('/public/images/hero_1_a.jpg');">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow-lg p-4">
                        <h2 class="text-center mb-4">Iniciar Sesión</h2>
                        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Ingresa tu correo" value="<?= $_POST['email'] ?? '' ?>" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="password">Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required>
                            </div>
                            <?php if (isset($message, $error)) : ?>
                                <div class="form-group text-center mt-3">
                                    <div class="alert <?= $error ? 'alert-danger' : 'alert-success' ?>"><?= $message ?></div>
                                </div>
                            <?php if ($error === false) : ?>
                                <script type="application/javascript">
                                    setTimeout(() => {

                                        // If there's a 'redirectUrl' in the query string, redirect to that URL
                                        const urlParams = new URLSearchParams(window.location.search);
                                        const redirectUrl = urlParams.get('redirectUrl');

                                        if (redirectUrl) {
                                            window.location.href = redirectUrl;
                                        } else {
                                            // Otherwise, redirect to the home page
                                            window.location.href = '/';
                                        }
                                    }, 1000);
                                </script>
                            <?php endif ?>
                            <?php endif ?>
                            <div class="d-flex justify-content-center align-items-center m-3">
                                <div class="form-check me-3">
                                    <input type="radio" id="cliente" name="type" value="customer" class="form-check-input" required checked>
                                    <label for="cliente" class="form-check-label">Cliente</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="administrador" name="type" value="administrador" class="form-check-input" required>
                                    <label for="administrador" class="form-check-label">Administrador</label>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-block w-100">Iniciar Sesión</button>
                            </div>
                            <div class="text-center mt-3">
                                <p>¿No tienes una cuenta? <a href="/register">Regístrate aquí</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include APP_VIEWS_DIR . '/inc/footer.php'; ?>
