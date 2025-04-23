<?php include APP_VIEWS_DIR . '/inc/header.php'; ?>
<?php include 'modals/create.php'; ?>
<div class="hero inner-page" style="background-image: url('/public/images/hero_1_a.jpg');">
    <div class="container">
        <div class="row align-items-end ">
            <div class="col-lg-5">

                <div class="intro">
                    <h1><strong>Vehículos</strong></h1>
                    <div class="custom-breadcrumbs"><a href="index.html">Inicio</a> <span class="mx-2">/</span>
                        <strong>Vehículos</strong>
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
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="h3 mb-3 text-black">Vehículos</h2>
                    </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createVehicleModal">
                        Crear Vehículo
                    </button>
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>

        <div id="vehicles-list" class="row">
            <!-- JavaScript llenará esto -->
            <div class="col d-flex justify-content-center">
                <span class="spinner-border text-primary">
                    <span class="sr-only">Loading...</span>
                </span>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    document.addEventListener('DOMContentLoaded', async () => {
        await renderVehicles();
    })

    const getVehicles = async () => fetch('/api/v1/vehicles')
        .then(response => response.json())
        .then(response => response.data);

    const renderVehicles = async () => {
        const data = await getVehicles();
        let html = '';

        data.forEach(vehicle => {
            const vehicleHTML = renderVehicle(vehicle);
            html += vehicleHTML;
        });

        const container = document.getElementById('vehicles-list');
        container.innerHTML = html;
    }

    const renderVehicle = (vehicle) => {
        return `
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="listing d-block  align-items-stretch">
                <div class="listing-img h-100 mr-4">
                    <img src="${vehicle.imagen_url}" alt="Image" class="img-fluid">
                </div>
                <div class="listing-contents h-100">
                    <h3>${vehicle.marca} ${vehicle.modelo}</h3>
                    <div class="rent-price">
                        <strong>$389.00</strong><span class="mx-1">/</span>day
                    </div>
                    <div class="d-block d-md-flex mb-3 border-bottom pb-3">
                        <div class="listing-feature pr-4">
                            <span class="caption">Luggage:</span>
                            <span class="number">8</span>
                        </div>
                        <div class="listing-feature pr-4">
                            <span class="caption">Doors:</span>
                            <span class="number">4</span>
                        </div>
                        <div class="listing-feature pr-4">
                            <span class="caption">Passenger:</span>
                            <span class="number">4</span>
                        </div>
                    </div>
                    <div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos eos at eum, voluptatem quibusdam.</p>
                        <p><a href="/rent" class="btn btn-primary btn-sm">Rent Now</a></p>
                    </div>
                </div>
            </div>
        </div>
        `
    }

</script>

<?php include APP_VIEWS_DIR . '/inc/footer.php'; ?>
