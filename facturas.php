<?php
require_once 'config.php';

// Crear factura
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    // Generar número de factura único
    $numero_factura = 'FAC-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
    
    $sql = "INSERT INTO facturas (reserva_id, numero_factura, fecha_emision, subtotal, impuestos, total, descripcion, estado) 
            VALUES (?, ?, NOW(), ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['reserva_id'], 
        $numero_factura,
        $_POST['subtotal'], 
        $_POST['impuestos'],
        $_POST['total'],
        $_POST['descripcion'],
        'pendiente'
    ]);
    header("Location: facturas.php");
    exit;
}

// Actualizar factura
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    $sql = "UPDATE facturas SET reserva_id=?, subtotal=?, impuestos=?, total=?, descripcion=?, estado=? 
            WHERE factura_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['reserva_id'], 
        $_POST['subtotal'], 
        $_POST['impuestos'],
        $_POST['total'],
        $_POST['descripcion'],
        $_POST['estado'],
        $_POST['id']
    ]);
    header("Location: facturas.php");
    exit;
}

// Cambiar estado factura
if (isset($_GET['cambiar_estado'])) {
    $estados = ['pendiente', 'pagada', 'cancelada'];
    $current = $pdo->query("SELECT estado FROM facturas WHERE factura_id = " . $_GET['cambiar_estado'])->fetchColumn();
    $next = $estados[(array_search($current, $estados) + 1) % count($estados)];
    
    $sql = "UPDATE facturas SET estado=? WHERE factura_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$next, $_GET['cambiar_estado']]);
    header("Location: facturas.php");
    exit;
}

// Leer facturas
$facturas = $pdo->query("SELECT f.*, r.reserva_id, c.nombre as cliente_nombre, c.apellido as cliente_apellido
                         FROM facturas f
                         JOIN reservas r ON f.reserva_id = r.reserva_id
                         JOIN clientes c ON r.cliente_id = c.cliente_id")->fetchAll(PDO::FETCH_ASSOC);

$reservas = $pdo->query("SELECT r.reserva_id, c.nombre, c.apellido, r.costo_total
                         FROM reservas r
                         JOIN clientes c ON r.cliente_id = c.cliente_id
                         WHERE r.estado = 'completada' AND NOT EXISTS (SELECT 1 FROM facturas WHERE reserva_id = r.reserva_id)")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Facturas - RentRoad</title>
    <script>
        function calcularImpuestos() {
            const subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
            const impuestos = subtotal * 0.16; // 16% de IVA
            document.getElementById('impuestos').value = impuestos.toFixed(2);
            document.getElementById('total').value = (subtotal + impuestos).toFixed(2);
        }
        
        function cargarDatosReserva() {
            const reserva_id = document.getElementById('reserva_id').value;
            if (reserva_id) {
                fetch('obtener_reserva.php?reserva_id=' + reserva_id)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('subtotal').value = data.costo_total;
                        calcularImpuestos();
                        document.getElementById('descripcion').value = `Factura por alquiler de vehículo ${data.marca} ${data.modelo} del ${data.fecha_inicio} al ${data.fecha_fin}`;
                    });
            }
        }
    </script>
</head>
<body>
    <h1>Gestión de Facturas</h1>
    
    <form method="post">
        <input type="hidden" name="id" value="<?= isset($_GET['editar']) ? $_GET['editar'] : '' ?>">
        
        <select name="reserva_id" id="reserva_id" required onchange="cargarDatosReserva()">
            <option value="">Seleccionar reserva</option>
            <?php foreach ($reservas as $reserva): ?>
                <option value="<?= $reserva['reserva_id'] ?>" <?= (isset($_GET['editar']) && $factura_editar['reserva_id'] == $reserva['reserva_id']) ? 'selected' : '' ?>>
                    Reserva #<?= $reserva['reserva_id'] ?> - <?= $reserva['nombre'] . ' ' . $reserva['apellido'] ?> (<?= $reserva['costo_total'] ?>)
                </option>
            <?php endforeach; ?>
        </select>
        
        <input type="number" step="0.01" name="subtotal" id="subtotal" placeholder="Subtotal" required onchange="calcularImpuestos()">
        <input type="number" step="0.01" name="impuestos" id="impuestos" placeholder="Impuestos" readonly>
        <input type="number" step="0.01" name="total" id="total" placeholder="Total" readonly>
        <textarea name="descripcion" id="descripcion" placeholder="Descripción"><?= isset($_GET['editar']) ? $factura_editar['descripcion'] : '' ?></textarea>
        
        <?php if (isset($_GET['editar'])): ?>
            <select name="estado" required>
                <option value="pendiente" <?= ($factura_editar['estado'] == 'pendiente') ? 'selected' : '' ?>>Pendiente</option>
                <option value="pagada" <?= ($factura_editar['estado'] == 'pagada') ? 'selected' : '' ?>>Pagada</option>
                <option value="cancelada" <?= ($factura_editar['estado'] == 'cancelada') ? 'selected' : '' ?>>Cancelada</option>
            </select>
            <button type="submit" name="actualizar">Actualizar</button>
            <a href="facturas.php">Cancelar</a>
        <?php else: ?>
            <button type="submit" name="crear">Crear</button>
        <?php endif; ?>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Número</th>
            <th>Reserva</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($facturas as $factura): ?>
        <tr>
            <td><?= $factura['factura_id'] ?></td>
            <td><?= $factura['numero_factura'] ?></td>
            <td>Reserva #<?= $factura['reserva_id'] ?></td>
            <td><?= $factura['cliente_nombre'] . ' ' . $factura['cliente_apellido'] ?></td>
            <td><?= date('d/m/Y H:i', strtotime($factura['fecha_emision'])) ?></td>
            <td><?= $factura['total'] ?></td>
            <td><?= ucfirst($factura['estado']) ?></td>
            <td>
                <a href="facturas.php?editar=<?= $factura['factura_id'] ?>">Editar</a>
                <a href="facturas.php?cambiar_estado=<?= $factura['factura_id'] ?>" onclick="return confirm('¿Cambiar estado?')">Cambiar estado</a>
                <a href="generar_pdf.php?id=<?= $factura['factura_id'] ?>" target="_blank">PDF</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php if (isset($_GET['editar'])): ?>
        <script>
            cargarDatosReserva();
        </script>
    <?php endif; ?>
</body>
</html>