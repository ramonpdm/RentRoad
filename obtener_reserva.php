<?php
require_once 'config.php';

$reserva_id = $_GET['reserva_id'];
$stmt = $pdo->prepare("SELECT r.costo_total, v.marca, v.modelo, r.fecha_recogida, r.fecha_devolucion 
                       FROM reservas r
                       JOIN vehiculos v ON r.vehiculo_id = v.vehiculo_id
                       WHERE r.reserva_id = ?");
$stmt->execute([$reserva_id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($data);
?>