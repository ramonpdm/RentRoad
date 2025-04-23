<?php include APP_VIEWS_DIR . '/inc/header.php'; ?>
<div class="site-wrap">
    <div class="hero" style="background-image: url('/public/images/hero_1_a.jpg');">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow-lg p-4">
                        <h2 class="text-center mb-4">Iniciar Sesión</h2>
                        <form action="/login" method="POST">
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Ingresa tu correo" value="<?= $_POST['email'] ?? '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required>
                            </div>
                            <?php if (isset($message, $error)) : ?>
                                <div class="form-group text-center">
                                    <div class="alert <?= $error ? 'alert-danger' : 'alert-success' ?>"><?= $message ?></div>
                                </div>
                            <?php if ($error === false) : ?>
                                <script> setTimeout(() => window.location.href = '/vehicles', 1000);</script>
                            <?php endif ?>
                            <?php endif ?>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                            </div>
                            <div class="text-center">
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
