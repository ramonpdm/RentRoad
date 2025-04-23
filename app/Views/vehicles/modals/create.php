<?php

use App\Entities\CategoriaVehiculo;

/** @var CategoriaVehiculo[] $categories */ ?>
<div class="modal fade" id="createVehicleModal" tabindex="-1" role="dialog" aria-labelledby="createVehicleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createVehicleModalLabel">Crear Nuevo Vehículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createVehicleForm">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="marca">Marca</label>
                            <input type="text" class="form-control" id="marca" name="marca" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="modelo">Modelo</label>
                            <input type="text" class="form-control" id="modelo" name="modelo" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="año">Año</label>
                            <input type="number" class="form-control" id="año" name="año" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="placa">Placa</label>
                            <input type="text" class="form-control" id="placa" name="placa" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="categoria">Categoría</label>
                            <select class="form-control" id="categoria" name="categoria" required>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category->id ?>"><?= $category->nombre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="color">Color</label>
                            <input type="text" class="form-control" id="color" name="color">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kilometraje">Kilometraje</label>
                            <input type="number" class="form-control" id="kilometraje" name="kilometraje">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="transmision">Transmisión</label>
                            <select class="form-control" id="transmision" name="transmision" required>
                                <option value="Automático">Automático</option>
                                <option value="Manual">Manual</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="capacidad_pasajeros">Capacidad de Pasajeros</label>
                            <input type="number" class="form-control" id="capacidad_pasajeros" name="capacidad_pasajeros" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="capacidad_maletero">Capacidad del Maletero</label>
                            <input type="number" class="form-control" id="capacidad_maletero" name="capacidad_maletero">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="combustible">Combustible</label>
                            <select class="form-control" id="combustible" name="combustible" required>
                                <option value="Gasolina">Gasolina</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Híbrido">Híbrido</option>
                                <option value="Eléctrico">Eléctrico</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sucursal">Sucursal</label>
                            <select class="form-control" id="sucursal" name="sucursal">
                                <!-- Opciones dinámicas -->
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="Disponible">Disponible</option>
                                <option value="Alquilado">Alquilado</option>
                                <option value="Mantenimiento">Mantenimiento</option>
                                <option value="Fuera de servicio">Fuera de servicio</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tarifa_diaria">Tarifa Diaria</label>
                            <input type="number" step="0.01" class="form-control" id="tarifa_diaria" name="tarifa_diaria" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="imagen_url">URL de la Imagen</label>
                        <input type="text" class="form-control" id="imagen_url" name="imagen_url">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>