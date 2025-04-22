<?php
require_once 'config.php';

// Crear sucursal
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $sql = "INSERT INTO sucursales (nombre, direccion, ciudad, telefono, email, aeropuerto_asociado, horario_apertura, horario_cierre, activa) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['nombre'], 
        $_POST['direccion'], 
        $_POST['ciudad'], 
        $_POST['telefono'],
        $_POST['email'], 
        $_POST['aeropuerto_asociado'], 
        $_POST['horario_apertura'],
        $_POST['horario_cierre'],
        isset($_POST['activa']) ? 1 : 0
    ]);
    header("Location: sucursales.php");
    exit;
}

// Actualizar sucursal
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    $sql = "UPDATE sucursales SET nombre=?, direccion=?, ciudad=?, telefono=?, email=?, aeropuerto_asociado=?, horario_apertura=?, horario_cierre=?, activa=? 
            WHERE sucursal_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['nombre'], 
        $_POST['direccion'], 
        $_POST['ciudad'], 
        $_POST['telefono'],
        $_POST['email'], 
        $_POST['aeropuerto_asociado'], 
        $_POST['horario_apertura'],
        $_POST['horario_cierre'],
        isset($_POST['activa']) ? 1 : 0,
        $_POST['id']
    ]);
    header("Location: sucursales.php");
    exit;
}

// Cambiar estado sucursal
if (isset($_GET['cambiar_estado'])) {
    $sql = "UPDATE sucursales SET activa = NOT activa WHERE sucursal_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['cambiar_estado']]);
    header("Location: sucursales.php");
    exit;
}

// Leer sucursales
$sucursales = $pdo->query("SELECT * FROM sucursales")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Sucursales - RentRoad</title>
</head>
<body>
    <h1>Gestión de Sucursales</h1>
    
    <form method="post">
        <input type="hidden" name="id" value="<?= isset($_GET['editar']) ? $_GET['editar'] : '' ?>">
        
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="direccion" placeholder="Dirección" required>
        <input type="text" name="ciudad" placeholder="Ciudad" required>
        <input type="text" name="telefono" placeholder="Teléfono" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="aeropuerto_asociado" placeholder="Aeropuerto asociado">
        <input type="time" name="horario_apertura" placeholder="Horario apertura" required>
        <input type="time" name="horario_cierre" placeholder="Horario cierre" required>
        <label>
            <input type="checkbox" name="activa" <?= (isset($_GET['editar']) && $sucursal_editar['activa']) ? 'checked' : '' ?>>
            Activa
        </label>
        
        <?php if (isset($_GET['editar'])): ?>
            <button type="submit" name="actualizar">Actualizar</button>
            <a href="sucursales.php">Cancelar</a>
        <?php else: ?>
            <button type="submit" name="crear">Crear</button>
        <?php endif; ?>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Ciudad</th>
            <th>Teléfono</th>
            <th>Horario</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($sucursales as $sucursal): ?>
        <tr>
            <td><?= $sucursal['sucursal_id'] ?></td>
            <td><?= $sucursal['nombre'] ?></td>
            <td><?= $sucursal['ciudad'] ?></td>
            <td><?= $sucursal['telefono'] ?></td>
            <td><?= $sucursal['horario_apertura'] . ' - ' . $sucursal['horario_cierre'] ?></td>
            <td><?= $sucursal['activa'] ? 'Activa' : 'Inactiva' ?></td>
            <td>
                <a href="sucursales.php?editar=<?= $sucursal['sucursal_id'] ?>">Editar</a>
                <a href="sucursales.php?cambiar_estado=<?= $sucursal['sucursal_id'] ?>" onclick="return confirm('¿Cambiar estado?')"><?= $sucursal['activa'] ? 'Desactivar' : 'Activar' ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>