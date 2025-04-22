<?php include APP_VIEWS_DIR . '/inc/header.php'; ?>

    <div class="hero" style="background-image: url('/public/images/hero_1_a.jpg');">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-10">
                    <div class="row mb-5">
                        <div class="col-lg-7 intro">
                            <h1>Tu <strong style="color: #007bff">próximo viaje</strong> empieza aquí.</h1>
                        </div>
                    </div>

                    <form class="trip-form">
                        <div class="row align-items-center">
                            <div class="mb-3 mb-md-0 col-md-3">
                                <select name="" id="" class="custom-select form-control">
                                    <option value="">Mazda</option>
                                    <option value="">Honda</option>
                                    <option value="">Hyundai</option>
                                    <option value="">Chevrolet</option>
                                    <option value="">Ford</option>
                                </select>
                            </div>
                            <div class="mb-3 mb-md-0 col-md-3">
                                <div class="form-control-wrap">
                                    <input type="text" id="cf-3" placeholder="Fecha recogida" class="form-control datepicker px-3">
                                    <span class="icon icon-date_range"></span>

                                </div>
                            </div>
                            <div class="mb-3 mb-md-0 col-md-3">
                                <div class="form-control-wrap">
                                    <input type="text" id="cf-4" placeholder="Fecha devolución" class="form-control datepicker px-3">
                                    <span class="icon icon-date_range"></span>
                                </div>
                            </div>
                            <div class="mb-3 mb-md-0 col-md-3">
                                <input type="submit" value="Buscar" class="btn btn-primary btn-block py-3">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <h2 class="section-heading"><strong>¿Cómo funciona?</strong></h2>
            <p class="mb-5">Pasos sencillos para iniciar</p>

            <div class="row mb-5">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="step">
                        <span>1</span>
                        <div class="step-inner">
                            <span class="number text-primary">01.</span>
                            <h3>Selecciona un coche</h3>
                            <p>Elige el coche que mejor se adapte a tus necesidades y preferencias.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="step">
                        <span>2</span>
                        <div class="step-inner">
                            <span class="number text-primary">02.</span>
                            <h3>Rellena el formulario</h3>
                            <p>Completa el formulario con tus datos y las fechas de alquiler.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="step">
                        <span>3</span>
                        <div class="step-inner">
                            <span class="number text-primary">03.</span>
                            <h3>Pago</h3>
                            <p>Realiza el pago de forma segura y rápida para confirmar tu reserva.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 text-center order-lg-2">
                    <div class="img-wrap-1 mb-5">
                        <img src="/public/images/feature_01.png" alt="Image" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-4 ml-auto order-lg-1">
                    <h3 class="mb-4 section-heading">
                        <strong>Aprovecha la temporada de ofertas</strong></h3>
                    <p class="mb-5">Aprovecha nuestras ofertas especiales y disfruta de un viaje inolvidable con RentRoad. ¡Reserva ahora y obtén descuentos exclusivos!</p>
                    <p><a href="#" class="btn btn-primary">Descubre más</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section bg-primary py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-4 mb-md-0">
                    <h2 class="mb-0 text-white">¿Qué estás esperando?</h2>
                    <p class="mb-0 opa-7">No pierdas la oportunidad de vivir una experiencia única con RentRoad.</p>
                </div>
                <div class="col-lg-5 text-md-right">
                    <a href="#" class="btn btn-primary btn-white">Alquila un coche ahora</a>
                </div>
            </div>
        </div>
    </div>

<?php include APP_VIEWS_DIR . '/inc/footer.php'; ?>