<?php
require_once 'config.php';

// Crear pago
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $sql = "INSERT INTO pagos (reserva_id, metodo_pago, monto, fecha_pago, estado, transaccion_id) 
            VALUES (?, ?, ?, NOW(), ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['reserva_id'], 
        $_POST['metodo_pago'], 
        $_POST['monto'],
        'pendiente',
        $_POST['transaccion_id'] ?? null
    ]);
    header("Location: pagos.php");
    exit;
}

// Actualizar pago
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    $sql = "UPDATE pagos SET reserva_id=?, metodo_pago=?, monto=?, estado=?, transaccion_id=? 
            WHERE pago_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['reserva_id'], 
        $_POST['metodo_pago'], 
        $_POST['monto'],
        $_POST['estado'],
        $_POST['transaccion_id'] ?? null,
        $_POST['id']
    ]);
    header("Location: pagos.php");
    exit;
}

// Cambiar estado pago
if (isset($_GET['cambiar_estado'])) {
    $estados = ['pendiente', 'completado', 'rechazado', 'reembolsado'];
    $current = $pdo->query("SELECT estado FROM pagos WHERE pago_id = " . $_GET['cambiar_estado'])->fetchColumn();
    $next = $estados[(array_search($current, $estados) + 1) % count($estados)];
    
    $sql = "UPDATE pagos SET estado=? WHERE pago_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$next, $_GET['cambiar_estado']]);
    header("Location: pagos.php");
    exit;
}

// Leer pagos
$pagos = $pdo->query("SELECT p.*, r.reserva_id, c.nombre as cliente_nombre, c.apellido as cliente_apellido, f.total as factura_total
                      FROM pagos p
                      JOIN reservas r ON p.reserva_id = r.reserva_id
                      JOIN clientes c ON r.cliente_id = c.cliente_id
                      LEFT JOIN facturas f ON r.reserva_id = f.reserva_id")->fetchAll(PDO::FETCH_ASSOC);

$reservas = $pdo->query("SELECT r.reserva_id, c.nombre, c.apellido, f.total
                         FROM reservas r
                         JOIN clientes c ON r.cliente_id = c.cliente_id
                         JOIN facturas f ON r.reserva_id = f.reserva_id
                         WHERE r.estado = 'completada'")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Pagos - RentRoad</title>
    <script>
        function cargarMontoFactura() {
            const reserva_id = document.getElementById('reserva_id').value;
            if (reserva_id) {
                fetch('obtener_factura.php?reserva_id=' + reserva_id)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('monto').value = data.total;
                    });
            }
        }
    </script>
</head>
<body>
    <h1>Gestión de Pagos</h1>
    
    <form method="post">
        <input type="hidden" name="id" value="<?= isset($_GET['editar']) ? $_GET['editar'] : '' ?>">
        
        <select name="reserva_id" id="reserva_id" required onchange="cargarMontoFactura()">
            <option value="">Seleccionar reserva</option>
            <?php foreach ($reservas as $reserva): ?>
                <option value="<?= $reserva['reserva_id'] ?>" <?= (isset($_GET['editar']) && $pago_editar['reserva_id'] == $reserva['reserva_id']) ? 'selected' : '' ?>>
                    Reserva #<?= $reserva['reserva_id'] ?> - <?= $reserva['nombre'] . ' ' . $reserva['apellido'] ?> (<?= $reserva['total'] ?>)
                </option>
            <?php endforeach; ?>
        </select>
        
        <select name="metodo_pago" required>
            <option value="tarjeta" <?= (isset($_GET['editar']) && $pago_editar['metodo_pago'] == 'tarjeta') ? 'selected' : '' ?>>Tarjeta de crédito/débito</option>
            <option value="efectivo" <?= (isset($_GET['editar']) && $pago_editar['metodo_pago'] == 'efectivo') ? 'selected' : '' ?>>Efectivo</option>
            <option value="transferencia" <?= (isset($_GET['editar']) && $pago_editar['metodo_pago'] == 'transferencia') ? 'selected' : '' ?>>Transferencia bancaria</option>
        </select>
        
        <input type="number" step="0.01" name="monto" id="monto" placeholder="Monto" required>
        <input type="text" name="transaccion_id" placeholder="ID Transacción" value="<?= isset($_GET['editar']) ? $pago_editar['transaccion_id'] : '' ?>">
        
        <?php if (isset($_GET['editar'])): ?>
            <select name="estado" required>
                <option value="pendiente" <?= ($pago_editar['estado'] == 'pendiente') ? 'selected' : '' ?>>Pendiente</option>
                <option value="completado" <?= ($pago_editar['estado'] == 'completado') ? 'selected' : '' ?>>Completado</option>
                <option value="rechazado" <?= ($pago_editar['estado'] == 'rechazado') ? 'selected' : '' ?>>Rechazado</option>
                <option value="reembolsado" <?= ($pago_editar['estado'] == 'reembolsado') ? 'selected' : '' ?>>Reembolsado</option>
            </select>
            <button type="submit" name="actualizar">Actualizar</button>
            <a href="pagos.php">Cancelar</a>
        <?php else: ?>
            <button type="submit" name="crear">Crear</button>
        <?php endif; ?>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Reserva</th>
            <th>Cliente</th>
            <th>Método</th>
            <th>Monto</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($pagos as $pago): ?>
        <tr>
            <td><?= $pago['pago_id'] ?></td>
            <td>Reserva #<?= $pago['reserva_id'] ?></td>
            <td><?= $pago['cliente_nombre'] . ' ' . $pago['cliente_apellido'] ?></td>
            <td><?= ucfirst($pago['metodo_pago']) ?></td>
            <td><?= $pago['monto'] ?> / <?= $pago['factura_total'] ?></td>
            <td><?= date('d/m/Y H:i', strtotime($pago['fecha_pago'])) ?></td>
            <td><?= ucfirst($pago['estado']) ?></td>
            <td>
                <a href="pagos.php?editar=<?= $pago['pago_id'] ?>">Editar</a>
                <a href="pagos.php?cambiar_estado=<?= $pago['pago_id'] ?>" onclick="return confirm('¿Cambiar estado?')">Cambiar estado</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php if (isset($_GET['editar'])): ?>
        <script>
            cargarMontoFactura();
        </script>
    <?php endif; ?>
</body>
</html>