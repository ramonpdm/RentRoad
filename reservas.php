<?php
require_once 'config.php';

// Crear reserva
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $sql = "INSERT INTO reservas (cliente_id, vehiculo_id, sucursal_recogida_id, sucursal_devolucion_id, fecha_reserva, fecha_recogida, fecha_devolucion, estado, seguro, costo_seguro, costo_total, observaciones) 
            VALUES (?, ?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['cliente_id'], 
        $_POST['vehiculo_id'], 
        $_POST['sucursal_recogida_id'], 
        $_POST['sucursal_devolucion_id'],
        $_POST['fecha_recogida'], 
        $_POST['fecha_devolucion'], 
        'pendiente',
        isset($_POST['seguro']) ? 1 : 0,
        $_POST['costo_seguro'] ?? 0,
        $_POST['costo_total'],
        $_POST['observaciones']
    ]);
    header("Location: reservas.php");
    exit;
}

// Actualizar reserva
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    $sql = "UPDATE reservas SET cliente_id=?, vehiculo_id=?, sucursal_recogida_id=?, sucursal_devolucion_id=?, fecha_recogida=?, fecha_devolucion=?, estado=?, seguro=?, costo_seguro=?, costo_total=?, observaciones=? 
            WHERE reserva_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['cliente_id'], 
        $_POST['vehiculo_id'], 
        $_POST['sucursal_recogida_id'], 
        $_POST['sucursal_devolucion_id'],
        $_POST['fecha_recogida'], 
        $_POST['fecha_devolucion'], 
        $_POST['estado'],
        isset($_POST['seguro']) ? 1 : 0,
        $_POST['costo_seguro'] ?? 0,
        $_POST['costo_total'],
        $_POST['observaciones'],
        $_POST['id']
    ]);
    header("Location: reservas.php");
    exit;
}

// Cambiar estado reserva
if (isset($_GET['cambiar_estado'])) {
    $estados = ['pendiente', 'confirmada', 'en_curso', 'completada', 'cancelada'];
    $current = $pdo->query("SELECT estado FROM reservas WHERE reserva_id = " . $_GET['cambiar_estado'])->fetchColumn();
    $next = $estados[(array_search($current, $estados) + 1) % count($estados)];
    
    $sql = "UPDATE reservas SET estado=? WHERE reserva_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$next, $_GET['cambiar_estado']]);
    header("Location: reservas.php");
    exit;
}

// Leer reservas
$reservas = $pdo->query("SELECT r.*, c.nombre as cliente_nombre, c.apellido as cliente_apellido, 
                         v.marca, v.modelo, s1.nombre as suc_recogida, s2.nombre as suc_devolucion
                         FROM reservas r
                         JOIN clientes c ON r.cliente_id = c.cliente_id
                         JOIN vehiculos v ON r.vehiculo_id = v.vehiculo_id
                         JOIN sucursales s1 ON r.sucursal_recogida_id = s1.sucursal_id
                         JOIN sucursales s2 ON r.sucursal_devolucion_id = s2.sucursal_id")->fetchAll(PDO::FETCH_ASSOC);

$clientes = $pdo->query("SELECT cliente_id, nombre, apellido FROM clientes WHERE activo = 1")->fetchAll(PDO::FETCH_ASSOC);
$vehiculos = $pdo->query("SELECT vehiculo_id, marca, modelo FROM vehiculos WHERE estado = 'disponible'")->fetchAll(PDO::FETCH_ASSOC);
$sucursales = $pdo->query("SELECT sucursal_id, nombre FROM sucursales WHERE activa = 1")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Reservas - RentRoad</title>
    <script>
        function calcularTotal() {
            const dias = Math.ceil((new Date(document.getElementById('fecha_devolucion').value) - new Date(document.getElementById('fecha_recogida').value)) / (1000 * 60 * 60 * 24));
            const precioDia = document.getElementById('precio_dia').value;
            const seguro = document.getElementById('seguro').checked ? document.getElementById('costo_seguro').value : 0;
            
            if (dias > 0 && precioDia > 0) {
                const total = (dias * precioDia) + parseFloat(seguro);
                document.getElementById('costo_total').value = total.toFixed(2);
            }
        }
    </script>
</head>
<body>
    <h1>Gestión de Reservas</h1>
    
    <form method="post">
        <input type="hidden" name="id" value="<?= isset($_GET['editar']) ? $_GET['editar'] : '' ?>">
        
        <select name="cliente_id" required>
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?= $cliente['cliente_id'] ?>" <?= (isset($_GET['editar']) && $reserva_editar['cliente_id'] == $cliente['cliente_id']) ? 'selected' : '' ?>>
                    <?= $cliente['nombre'] . ' ' . $cliente['apellido'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <select name="vehiculo_id" id="vehiculo_id" required onchange="obtenerPrecioDia(this.value)">
            <?php foreach ($vehiculos as $vehiculo): ?>
                <option value="<?= $vehiculo['vehiculo_id'] ?>" <?= (isset($_GET['editar']) && $reserva_editar['vehiculo_id'] == $vehiculo['vehiculo_id']) ? 'selected' : '' ?>>
                    <?= $vehiculo['marca'] . ' ' . $vehiculo['modelo'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" id="precio_dia">
        
        <select name="sucursal_recogida_id" required>
            <?php foreach ($sucursales as $sucursal): ?>
                <option value="<?= $sucursal['sucursal_id'] ?>" <?= (isset($_GET['editar']) && $reserva_editar['sucursal_recogida_id'] == $sucursal['sucursal_id']) ? 'selected' : '' ?>>
                    <?= $sucursal['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <select name="sucursal_devolucion_id" required>
            <?php foreach ($sucursales as $sucursal): ?>
                <option value="<?= $sucursal['sucursal_id'] ?>" <?= (isset($_GET['editar']) && $reserva_editar['sucursal_devolucion_id'] == $sucursal['sucursal_id']) ? 'selected' : '' ?>>
                    <?= $sucursal['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <input type="datetime-local" name="fecha_recogida" id="fecha_recogida" required onchange="calcularTotal()">
        <input type="datetime-local" name="fecha_devolucion" id="fecha_devolucion" required onchange="calcularTotal()">
        
        <label>
            <input type="checkbox" name="seguro" id="seguro" onchange="calcularTotal()" <?= (isset($_GET['editar']) && $reserva_editar['seguro']) ? 'checked' : '' ?>>
            Incluir seguro
        </label>
        <input type="number" step="0.01" name="costo_seguro" id="costo_seguro" placeholder="Costo seguro" value="50.00" onchange="calcularTotal()">
        
        <input type="number" step="0.01" name="costo_total" id="costo_total" placeholder="Costo total" required>
        <textarea name="observaciones" placeholder="Observaciones"><?= isset($_GET['editar']) ? $reserva_editar['observaciones'] : '' ?></textarea>
        
        <?php if (isset($_GET['editar'])): ?>
            <input type="hidden" name="estado" value="<?= $reserva_editar['estado'] ?>">
            <button type="submit" name="actualizar">Actualizar</button>
            <a href="reservas.php">Cancelar</a>
        <?php else: ?>
            <button type="submit" name="crear">Crear</button>
        <?php endif; ?>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Vehículo</th>
            <th>Fechas</th>
            <th>Sucursales</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($reservas as $reserva): ?>
        <tr>
            <td><?= $reserva['reserva_id'] ?></td>
            <td><?= $reserva['cliente_nombre'] . ' ' . $reserva['cliente_apellido'] ?></td>
            <td><?= $reserva['marca'] . ' ' . $reserva['modelo'] ?></td>
            <td>
                <?= date('d/m/Y H:i', strtotime($reserva['fecha_recogida'])) ?><br>
                <?= date('d/m/Y H:i', strtotime($reserva['fecha_devolucion'])) ?>
            </td>
            <td>
                <?= $reserva['suc_recogida'] ?><br>
                <?= $reserva['suc_devolucion'] ?>
            </td>
            <td><?= $reserva['costo_total'] ?></td>
            <td><?= ucfirst($reserva['estado']) ?></td>
            <td>
                <a href="reservas.php?editar=<?= $reserva['reserva_id'] ?>">Editar</a>
                <a href="reservas.php?cambiar_estado=<?= $reserva['reserva_id'] ?>" onclick="return confirm('¿Cambiar estado?')">Cambiar estado</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <script>
        function obtenerPrecioDia(vehiculo_id) {
            fetch('obtener_precio.php?vehiculo_id=' + vehiculo_id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('precio_dia').value = data.precio_dia;
                    calcularTotal();
                });
        }
        
        // Si estamos editando, cargar el precio del vehículo
        <?php if (isset($_GET['editar'])): ?>
            obtenerPrecioDia(<?= $reserva_editar['vehiculo_id'] ?>);
        <?php endif; ?>
    </script>
</body>
</html>