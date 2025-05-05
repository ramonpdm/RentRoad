<?php use App\Config\Auth; ?>
<!doctype html>
<html lang="en">

    <head>
        <title>Inicio - RentRoad</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <link rel="stylesheet" href="/public/fonts/icomoon/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <link rel="stylesheet" href="/public/css/style.css">
        <link rel="stylesheet" href="/public/css/bootstrap.css">
        <link rel="stylesheet" href="/public/css/utils.css">
    </head>

    <body>
        <header class="site-navbar site-navbar-target" role="banner">
            <div class="container">
                <div class="row align-items-center position-relative">
                    <div class="col-3">
                        <div class="site-logo">
                            <a href="/">
                                <img src="/public/images/logo.png" alt="RentRoad logo" style="height: 70px;">
                            </a>
                        </div>
                    </div>

                    <div class="col-9 text-right">
                        <nav class="site-navigation text-right d-none d-lg-block" role="navigation">
                            <ul class="site-menu main-menu text-end">
                                <li class="active"><a href="/" class="nav-link">Inicio</a></li>
                                <li><a href="/vehicles" class="nav-link">Vehículos</a></li>
                                <?php if (Auth::isLogged()): ?>
                                    <?php if (Auth::user()->isAdmin()): ?>
                                        <li><a href="/rentals" class="nav-link">Rentas</a></li>
                                    <?php endif; ?>
                                    <li>
                                        <a href="/profile" class="nav-link active font-weight-bold"><?= Auth::user()->getNombreCompleto() ?></a>
                                    </li>
                                    <li>
                                        <a href="/logout" class="nav-link font-weight-bold text-danger">Cerrar Sessión</a>
                                    </li>
                                    <?php else: ?>
                                    <li>
                                        <a href="/login" class="nav-link active font-weight-bold">Iniciar Sesión</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </header>