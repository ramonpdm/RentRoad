<?php use App\Config\Auth;

include APP_VIEWS_DIR . '/inc/header.php'; ?>
<?php include 'modals/create.php'; ?>
<div class="hero inner-page" style="background-image: url('/public/images/hero_1_a.jpg');">
    <div class="container">
        <div class="row align-items-end ">
            <div class="col-lg-5">

                <div class="intro">
                    <h1><strong>Vehículos</strong></h1>
                    <div class="custom-breadcrumbs"><a href="/">Inicio</a> <span class="mx-2">/</span>
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
                    <?php if (Auth::user()?->isAdmin()): ?>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createVehicleModal">
                            Crear Vehículo
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <input type="search" class="form-control" placeholder="Buscar vehículo..." id="searchVehicleInput">
                    <div class="input-group-append">
                        <button class="btn btn-secondary h-100" type="button" id="searchVehicleButton">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div id="vehicles-list" class="row">
            <!-- JavaScript llenará esto -->
            <div class="col d-flex justify-content-center">
                <span class="spinner-border text-primary">
                    <span class="visually-hidden">Loading...</span>
                </span>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    const filters = {
        marca: null,
        modelo: null,
        ano: null
    }

    document.addEventListener('DOMContentLoaded', async () => {
        setStaticListeners();
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

        filterVehicles();
        setDynamicListeners();
    }

    const renderVehicle = (vehicle) => {
        return `
        <div class="col-md-6 col-lg-4 mb-4">
            <form id="vehicle-form-${vehicle.id}" class="vehicle-form">
                <input type="hidden" name="id" value="${vehicle.id}">
                <input type="hidden" name="marca" value="${vehicle.marca}">
                <input type="hidden" name="modelo" value="${vehicle.modelo}">
                <input type="hidden" name="ano" value="${vehicle.ano}">
                <div class="listing d-block align-items-stretch">
                    <div class="listing-img h-100 mr-4">
                        <img src="${vehicle.imagen_url}" alt="Image" class="img-fluid">
                    </div>
                    <div class="listing-contents h-100">
                        <div class="d-flex justify-content-between">
                            <h3>${vehicle.marca} ${vehicle.modelo} ${vehicle.ano}</h3>
                            ${IS_ADMIN ? `
                                <div class="text-nowrap">
                                    <i class="edit pointer bi bi-pencil-square text-primary"></i>
                                    <i class="delete pointer bi bi-trash3 text-danger"></i>
                                </div>
                            ` : ''}
                        </div>
                        <div class="rent-price">
                            <strong>US$${vehicle.costo}</strong><span class="mx-1">/</span>day
                        </div>
                        <div class="d-block d-md-flex">
                            <table class="table table-borderless m-0">
                                <tbody>
                                    <tr>
                                        <td>Color</td>
                                        <td>${vehicle.color || 'N/A'}</td>
                                    </tr>
                                    <tr>
                                        <td>Transmisión</td>
                                        <td>${vehicle.transmision || 'N/A'}</td>
                                    </tr>
                                    <tr>
                                        <td>Combustible</td>
                                        <td>${vehicle.combustible?.name || 'N/A'}</td>
                                    </tr>
                                    <tr>
                                        <td>Pasajeros</td>
                                        <td>${vehicle.capacidad_pasajeros || 'N/A'}</td>
                                    </tr>
                                    <tr>
                                        <td>Maletero</td>
                                        <td>${vehicle.capacidad_maletero || 'N/A'}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        ${IS_ADMIN === false ? `
                            <hr>
                            <a href="/rent?vehicle=${vehicle.id}" class="btn btn-primary w-100">Rentar</a>
                        ` : ''}
                    </div>
                </div>
            </form>
        </div>
        `
    }

    const filterVehicles = () => {
        const vehicles = document.querySelectorAll('#vehicles-list .vehicle-form');
        const search = filters.search || '';

        vehicles.forEach(form => {
            const vehicleText = form.innerText.toLowerCase();
            const marca = form.querySelector('input[name="marca"]').value.toLowerCase();
            const modelo = form.querySelector('input[name="modelo"]').value.toLowerCase();
            const ano = form.querySelector('input[name="ano"]').value.toLowerCase();

            if (
                vehicleText.includes(search)
                || marca.includes(search)
                || modelo.includes(search)
                || ano.includes(search)
            ) {
                form.parentElement.style.display = 'block';
            } else {
                form.parentElement.style.display = 'none';
            }
        });

        let html = '';

        const visibleResults = Array.from(document.querySelectorAll('#vehicles-list .vehicle-form')).some(form => {
            const parent = form.parentElement;
            return parent.style.display !== 'none';
        });

        if (!visibleResults) {
            if (filters.marca || filters.modelo || filters.ano) {
                html = `
                <div class="col d-flex justify-content-center">
                    <b class="text-danger">No se encontraron vehículos que coincidan con los criterios de búsqueda.</b>
                </div>
                `;
            } else {
                html = `
                <div class="col d-flex justify-content-center">
                    <b class="text-danger">No hay vehículos disponibles.</b>
                </div>`;
            }

            const container = document.getElementById('vehicles-list');
            container.innerHTML = html;
        }
    }

    const setStaticListeners = () => {
        const searchInput = document.getElementById('searchVehicleInput');
        const urlParams = new URLSearchParams(window.location.search);
        const search = urlParams.get('search');

        if (search) {
            searchInput.value = search;
            filters.search = search;
        } else {
            const marca = urlParams.get('marca');
            const modelo = urlParams.get('modelo');
            const ano = urlParams.get('ano');

            Object.assign(filters, {marca, modelo, ano});
            if (marca) searchInput.value += marca + ' ';
            if (modelo) searchInput.value += modelo + ' ';
            if (ano) searchInput.value += ano;
        }

        searchInput.addEventListener('input', (event) => {
            const value = event.target.value.toLowerCase().trim();
            filters.search = value;
            filterVehicles()

            // Replace query parameters
            const url = new URL(window.location.href);
            url.searchParams.set('search', value);
            url.searchParams.delete('marca');
            url.searchParams.delete('modelo');
            url.searchParams.delete('ano');
            window.history.pushState({}, '', url);
        });

        const createVehicleForm = document.getElementById('createVehicleForm');
        createVehicleForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            const formData = new FormData(createVehicleForm);
            await createVehicle(formData);
        });
    }

    const setDynamicListeners = () => {
        const deleteButtons = document.querySelectorAll('.delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', async (event) => {
                if (!confirm('¿Está seguro de que desea eliminar este vehículo?')) {
                    return;
                }

                const form = event.target.closest('form');
                const vehicleId = form.querySelector('input[name="id"]').value;
                await deleteVehicle(vehicleId);
            });
        });
    }

    const createVehicle = async (data) => {
        const response = await fetch('/api/v1/vehicles', {
            method: 'POST',
            body: data
        });

        const vehicle = await response.json();
        if (!response.ok) {
            alert('Error creating vehicle: ' + vehicle.message);
            return;
        }

        $('#createVehicleModal').modal('hide');
        renderVehicles();
    }

    const deleteVehicle = async (vehicleId) => {
        const response = await fetch(`/api/v1/vehicles/${vehicleId}`, {
            method: 'DELETE'
        });
        const json = await response.json();

        alert(json.message || 'Error deleting vehicle');

        if (!response.ok) {
            return;
        }

        renderVehicles();
    }
</script>

<?php include APP_VIEWS_DIR . '/inc/footer.php'; ?>
