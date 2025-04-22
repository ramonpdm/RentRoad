<?php
require_once 'config.php';

// Crear vehículo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $sql = "INSERT INTO vehiculos (marca, modelo, año, placa, color, precio_dia, estado, sucursal_id, combustible, transmision, capacidad_pasajeros) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['marca'], 
        $_POST['modelo'], 
        $_POST['año'], 
        $_POST['placa'], 
        $_POST['color'],
        $_POST['precio_dia'], 
        $_POST['estado'], 
        $_POST['sucursal_id'], 
        $_POST['combustible'],
        $_POST['transmision'], 
        $_POST['capacidad_pasajeros']
    ]);
    header("Location: vehiculos.php");
    exit;
}

// Actualizar vehículo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    $sql = "UPDATE vehiculos SET marca=?, modelo=?, año=?, placa=?, color=?, precio_dia=?, estado=?, sucursal_id=?, combustible=?, transmision=?, capacidad_pasajeros=? 
            WHERE vehiculo_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['marca'], 
        $_POST['modelo'], 
        $_POST['año'], 
        $_POST['placa'], 
        $_POST['color'],
        $_POST['precio_dia'], 
        $_POST['estado'], 
        $_POST['sucursal_id'], 
        $_POST['combustible'],
        $_POST['transmision'], 
        $_POST['capacidad_pasajeros'],
        $_POST['id']
    ]);
    header("Location: vehiculos.php");
    exit;
}

// Eliminar vehículo
if (isset($_GET['eliminar'])) {
    $sql = "DELETE FROM vehiculos WHERE vehiculo_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['eliminar']]);
    header("Location: vehiculos.php");
    exit;
}

// Leer vehículos
$vehiculos = $pdo->query("SELECT * FROM vehiculos")->fetchAll(PDO::FETCH_ASSOC);
$sucursales = $pdo->query("SELECT sucursal_id, nombre FROM sucursales")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Vehículos - RentRoad</title>
</head>
<body>
    <h1>Gestión de Vehículos</h1>
    
    <form method="post">
        <input type="hidden" name="id" value="<?= isset($_GET['editar']) ? $_GET['editar'] : '' ?>">
        
        <input type="text" name="marca" placeholder="Marca" required>
        <input type="text" name="modelo" placeholder="Modelo" required>
        <input type="number" name="año" placeholder="Año" required>
        <input type="text" name="placa" placeholder="Placa" required>
        <input type="text" name="color" placeholder="Color" required>
        <input type="number" step="0.01" name="precio_dia" placeholder="Precio por día" required>
        <select name="estado" required>
            <option value="disponible">Disponible</option>
            <option value="alquilado">Alquilado</option>
            <option value="mantenimiento">En mantenimiento</option>
        </select>
        <select name="sucursal_id" required>
            <?php foreach ($sucursales as $sucursal): ?>
                <option value="<?= $sucursal['sucursal_id'] ?>"><?= $sucursal['nombre'] ?></option>
            <?php endforeach; ?>
        </select>
        <select name="combustible" required>
            <option value="gasolina">Gasolina</option>
            <option value="diesel">Diésel</option>
            <option value="electrico">Eléctrico</option>
            <option value="hibrido">Híbrido</option>
        </select>
        <select name="transmision" required>
            <option value="automatico">Automático</option>
            <option value="manual">Manual</option>
        </select>
        <input type="number" name="capacidad_pasajeros" placeholder="Capacidad (personas)" required>
        
        <?php if (isset($_GET['editar'])): ?>
            <button type="submit" name="actualizar">Actualizar</button>
            <a href="vehiculos.php">Cancelar</a>
        <?php else: ?>
            <button type="submit" name="crear">Crear</button>
        <?php endif; ?>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Marca/Modelo</th>
            <th>Año</th>
            <th>Placa</th>
            <th>Precio/día</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($vehiculos as $vehiculo): ?>
        <tr>
            <td><?= $vehiculo['vehiculo_id'] ?></td>
            <td><?= $vehiculo['marca'] . ' ' . $vehiculo['modelo'] ?></td>
            <td><?= $vehiculo['año'] ?></td>
            <td><?= $vehiculo['placa'] ?></td>
            <td><?= $vehiculo['precio_dia'] ?></td>
            <td><?= $vehiculo['estado'] ?></td>
            <td>
                <a href="vehiculos.php?editar=<?= $vehiculo['vehiculo_id'] ?>">Editar</a>
                <a href="vehiculos.php?eliminar=<?= $vehiculo['vehiculo_id'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>