<?php
require_once 'config.php';

// Crear cliente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $sql = "INSERT INTO clientes (nombre, apellido, email, password, telefono, direccion, licencia_conduct, fecha_nacimiento, activo) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt->execute([
        $_POST['nombre'], 
        $_POST['apellido'], 
        $_POST['email'], 
        $hashedPassword,
        $_POST['telefono'], 
        $_POST['direccion'], 
        $_POST['licencia_conduct'], 
        $_POST['fecha_nacimiento'],
        isset($_POST['activo']) ? 1 : 0
    ]);
    header("Location: clientes.php");
    exit;
}

// Actualizar cliente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    $sql = "UPDATE clientes SET nombre=?, apellido=?, email=?, telefono=?, direccion=?, licencia_conduct=?, fecha_nacimiento=?, activo=? 
            WHERE cliente_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['nombre'], 
        $_POST['apellido'], 
        $_POST['email'], 
        $_POST['telefono'], 
        $_POST['direccion'], 
        $_POST['licencia_conduct'], 
        $_POST['fecha_nacimiento'],
        isset($_POST['activo']) ? 1 : 0,
        $_POST['id']
    ]);
    header("Location: clientes.php");
    exit;
}

// Eliminar cliente (actualizado para cambio de estado)
if (isset($_GET['cambiar_estado'])) {
    $sql = "UPDATE clientes SET activo = NOT activo WHERE cliente_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['cambiar_estado']]);
    header("Location: clientes.php");
    exit;
}

// Leer clientes
$clientes = $pdo->query("SELECT * FROM clientes")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Clientes - RentRoad</title>
</head>
<body>
    <h1>Gestión de Clientes</h1>
    
    <form method="post">
        <input type="hidden" name="id" value="<?= isset($_GET['editar']) ? $_GET['editar'] : '' ?>">
        
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido" placeholder="Apellido" required>
        <input type="email" name="email" placeholder="Email" required>
        <?php if (!isset($_GET['editar'])): ?>
            <input type="password" name="password" placeholder="Password" required>
        <?php endif; ?>
        <input type="text" name="telefono" placeholder="Teléfono">
        <input type="text" name="direccion" placeholder="Dirección">
        <input type="text" name="licencia_conduct" placeholder="Licencia de conducir">
        <input type="date" name="fecha_nacimiento" placeholder="Fecha de nacimiento">
        <label>
            <input type="checkbox" name="activo" <?= (isset($_GET['editar']) && $cliente_editar['activo']) ? 'checked' : '' ?>>
            Activo
        </label>
        
        <?php if (isset($_GET['editar'])): ?>
            <button type="submit" name="actualizar">Actualizar</button>
            <a href="clientes.php">Cancelar</a>
        <?php else: ?>
            <button type="submit" name="crear">Crear</button>
        <?php endif; ?>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($clientes as $cliente): ?>
        <tr>
            <td><?= $cliente['cliente_id'] ?></td>
            <td><?= $cliente['nombre'] . ' ' . $cliente['apellido'] ?></td>
            <td><?= $cliente['email'] ?></td>
            <td><?= $cliente['telefono'] ?></td>
            <td><?= $cliente['activo'] ? 'Activo' : 'Inactivo' ?></td>
            <td>
                <a href="clientes.php?editar=<?= $cliente['cliente_id'] ?>">Editar</a>
                <a href="clientes.php?cambiar_estado=<?= $cliente['cliente_id'] ?>" onclick="return confirm('¿Cambiar estado?')"><?= $cliente['activo'] ? 'Desactivar' : 'Activar' ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>